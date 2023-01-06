<?php

namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlans;
use Illuminate\Http\Request;
use App\Models\Subscription_module;
use App\Models\Subscription_submodule;
use App\Models\VehicleBrand;
use App\Models\VehicleModel;
use App\Models\ManageBookings;
use App\Models\Vehicle;
use App\Models\Organisation;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\User;
use App\Models\CountryMaster;
use App\Models\Transaction;
use App\Models\BookingInvoice;
use App\Models\BookingInvoicedetails;
use App\Models\ReserveFleet;
use App\Models\AcountsPayment;
use App\Models\AmountTransaction;
use App\Models\Fleetdetails;
use App\Models\GeneralLedger;
use App\Models\OpeningBalance;
use App\Models\Fleet;
use App\Models\ShortLink;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Mail\SendMail;
use App\Models\AdminMenu;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SubscriptionPlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageConfigs = ['pageHeader' => false];

        $path = public_path() . '/data/subscriptionplans';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (file_exists($path . '/' . 'subscription-data-list.json')) {
            \File::delete($path . '/' . 'subscription-data-list.json');
        }

        if (!file_exists($path . '/' . 'subscription-data-list.json')) {
            $user = $this->json_list();
            $data = array('data' => $user);
            // dd($data);
            \File::put($path . '/' . 'subscription-data-list.json', collect($data));
        }
        return view('subscriptions.list'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        $countries =  CountryMaster::all();

        $plans = SubscriptionPlans::select('id','plan_name')->get();

        $menus = AdminMenu::with('sub_menu')->get();

        return view('subscriptions.create',compact('countries','plans','menus'));
    }

      private function json_list()
    {
        return SubscriptionPlans::select(
            'subscription_plans.id',
            'subscription_plans.uuid',
            'subscription_plans.plan_name',
            'subscription_plans.add_on_charge',
            'subscription_plans.deposit',
            'subscription_plans.convenience_fees_amount',
            'subscription_plans.payment_gateway_charge',
            'subscription_plans.status_type'  
        )
            ->orderBy('subscription_plans.id', 'desc')      
            ->get();
            
            // dd($return);
        }  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //  dd($request);
        $created_user = getUser();
      //  dd($created_user);
        //    $input = $request->all();
        // $validate = $this->validations($input, "add");
        // if ($validate["error"]) {        
        DB::beginTransaction();
        try {

            $payment_gateway = implode(',', $request->payment_gateway_charge);
            $payement_gateway_amount = implode(',', $request->payement_gateway_amount);
         //   dd($payment_gateway);
            $data = new SubscriptionPlans;
            
            $data->plan_name                    = $request->plan_name;
            $data->add_on_charge                = $request->add_on_charge;
            $data->deposit                      = $request->deposit;
            $data->convenience_fees_type        = $request->convenience_fees_type;
            $data->convenience_fees_amount      = $request->convenience_fees_amount;
            $data->commission_fees_type         = $request->commission_fees_type;
            $data->commission_fees_amount       = $request->commission_fees_amount;
            $data->withdrawal_charges_add       = $request->customColorRadio5;
            $data->withdrawal_charges_amuont    = $request->withdrawal_charges_amuont;
            $data->payment_gateway_charge       = $payment_gateway;
            $data->payement_gateway_amount       = $payement_gateway_amount;
            $data->note                         = $request->description;
            $data->status_type                  =  '1';
            // $data->created_user                 = $created_user;
           
            $data->save();
            // Saving permission module and sub module data,

       
            $menus = $request->menu;
            $smenus = explode(',',$request->smenu);
            $sub_menus = $request->sub_menu;
            foreach($menus as $menu){
    
                $subs_menu                   = new Subscription_module();
                $subs_menu->subcription_id  = $data->id;
                $subs_menu->admin_menu_id    = $menu;
                $subs_menu->save();
            }
    
            foreach($smenus as $key => $smenu){
    
                $subs_sub_menu                       = new Subscription_submodule();
                $subs_sub_menu->subcription_id      = $data->id;
                $subs_sub_menu->subscription_menu_id = $smenu;
                $subs_sub_menu->admin_sub_menu_id    = $sub_menus[$key];
                $subs_sub_menu->save();
            }
    


            DB::commit();
            return ajax_response(true, $data, [], "Subscription Saved Successfully", $this->success);
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        }
    //     return prepareResult(false, [], $validate['errors']->first(), "Error while validating Subscription", $this->unprocessableEntity);
    // }  
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubscriptionPlans  $subscriptionPlans
     * @return \Illuminate\Http\Response
     */
    public function show(SubscriptionPlans $subscriptionPlans)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubscriptionPlans  $subscriptionPlans
     * @return \Illuminate\Http\Response
     */


     public function update($uuid)

     {
         $menus = AdminMenu::with('sub_menu')->get();
         $SubscriptionPlans =SubscriptionPlans::select('subscription_plans.*')->where('uuid','=',$uuid)->first();
         $payment_gateway = explode(',',$SubscriptionPlans->payment_gateway_charge);
         $Subscriptionmenus = Subscription_module::all()->get();
         $Subscriptionsubmenus = Subscription_submodule::where('subcription_id',$SubscriptionPlans->id)->get();
 
         // echo "<pre>";
         // print_r($Subscriptionmenus);die;
         //   dd($Subscriptionsubmenus);
 
         $inserted_menu = array();
         $inserted_subMenu = array();
 
         foreach($Subscriptionmenus as $set_menu){
             $inserted_menu[] = $set_menu->admin_menu_id;
 
         }
         // dd($Subscriptionmenus);
         foreach($Subscriptionsubmenus as $set_sub_menu){
 
             $inserted_subMenu[] = $set_sub_menu->admin_sub_menu_id;
         }
         // dd($inserted_subMenu, $inserted_menu);
         return view('subscriptions.update', compact('SubscriptionPlans','payment_gateway','inserted_menu','inserted_subMenu','Subscriptionmenus','menus'));
 
         // return view('subscriptions.update');
 
 
     }
    public function edit(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {

            $payment_gateway = implode(',', $request->payment_gateway_charge);
            $payement_gateway_amount = implode(',', $request->payement_gateway_amount);
        //    dd($payment_gateway);
            $data =  SubscriptionPlans::find($request->update_id);
            //dd($data);
            $data->plan_name                    = $request->plan_name;
            $data->add_on_charge                = $request->add_on_charge;
            $data->deposit                      = $request->deposit;
            $data->convenience_fees_type        = $request->customColorRadio3;
            $data->convenience_fees_amount      = $request->convenience_fees_amount;
            $data->commission_fees_type         = $request->customColorRadio4;
            $data->commission_fees_amount       = $request->commission_fees_amount;
            $data->withdrawal_charges_add       = $request->customColorRadio5;
            $data->withdrawal_charges_amuont    = $request->withdrawal_charges_amuont;
            $data->payment_gateway_charge       = $payment_gateway;
            $data->payement_gateway_amount       = $payement_gateway_amount;
            $data->note                         = $request->description;
            $data->status_type                  =  '1';
            // $data->created_user                 = $created_user;
           //  dd($data);
            $data->save();

        // Saving permission module and sub module data,

        $menus = $request->menu;
        $smenus = explode(',',$request->smenu);
        $sub_menus = $request->sub_menu;
            // dd($smenus,$menus,$sub_menus);
            DB::table('subscription_modules')->where('subcription_id',$request->update_id)->delete();
            DB::table('subscription_submodules')->where('subcription_id',$request->update_id)->delete();

        foreach($menus as $menu){
            $subs_menu                   = new Subscription_module();
            $subs_menu->subcription_id  = $data->id;
            $subs_menu->admin_menu_id    = $menu;
            $subs_menu->save();
        }

        foreach($smenus as $key => $smenu){

            $subs_sub_menu                       = new Subscription_submodule();
            $subs_sub_menu->subcription_id      = $data->id;
            $subs_sub_menu->subscription_menu_id = $smenu;
            $subs_sub_menu->admin_sub_menu_id    = $sub_menus[$key];
            $subs_sub_menu->save();
        }


            DB::commit();
            return ajax_response(true, $data, [], "Subscription Update Successfully", $this->success);
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubscriptionPlans  $subscriptionPlans
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubscriptionPlans  $subscriptionPlans
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubscriptionPlans $subscriptionPlans)
    {
        //
    }
    public function delete($id)
    {
        $general = SubscriptionPlans::find($id);
        if (is_object($general)) {
         
            $general->delete();
            return prepareResult(true, [], [], "Record delete successfully", $this->success);
        }

        return prepareResult(false, [], [], "Unauthorized access", $this->unauthorized);
    }
}
