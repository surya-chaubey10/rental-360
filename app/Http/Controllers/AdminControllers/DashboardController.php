<?php

namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Models\Company;
use App\Models\Organisation;
use App\Models\User;
use App\Models\Transaction;
use App\Models\VehicleBrand;
use App\Models\CountryMaster;   
use App\Models\CompanyBank;     
use App\Models\AmountTransaction;      
use App\Models\AcountsPayment;       
use App\Models\BookingInvoice;        
use App\Models\Fleet;        
use Illuminate\Support\Facades\Hash;
use App\Models\Booking;         
use App\Models\ManageBookings;            
use App\Models\CompanyKYC;
use App\Models\VehicleModel;
use App\Models\CompanySubscription;
use App\Models\CompanyMoreInformation;
use App\Models\Notifications;
use Illuminate\Http\Request;
use App\Mail\ConfirmMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;  
use App\Models\Vehicle;
use Validator;
use File;  

class DashboardController extends Controller
{
    public function view()
    {
     

        $pageConfigs = ['pageHeader' => false];
        $path = public_path() . '/data/dashboard-model-json';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }
        if (file_exists($path . '/_dashboard-model-list.json')) { 
            \File::delete($path . '/_dashboard-model-list.json');
        }

        if (!file_exists($path . '/_dashboard-model-list.json')) {
            $user = $this->jsonmodelList1();
            $data = array('data' => $user);
            \File::put($path . '/_dashboard-model-list.json', collect($data));
        }
        
        //


        $path1 = public_path() . '/data/dashboard-company-json';

        if (!file_exists($path1)) {
            \File::makeDirectory($path1, 0777, true, true);
        }

        if (file_exists($path1 . '/dashboard-company-list.json')) {
            \File::delete($path1 . '/dashboard-company-list.json');
        }

        if (!file_exists($path1 . '/dashboard-company-list.json')) {
            $user1 = $this->jsonCompanyList();
            $data1 = array('data' => $user1);
            \File::put($path1 . '/dashboard-company-list.json', collect($data1));
        }


                // Creating Treding Model JSON file ==> Start


                if (file_exists($path1 . '/dashboard-trading-list.json')) {
                    \File::delete($path1 . '/dashboard-trading-list.json');
                }

                if (!file_exists($path1 . '/dashboard-trading-list.json')) {
                    $user2 = $this->jsonTredingList();
                    $data3 = array('data' => $user2);
                    \File::put($path1 . '/dashboard-trading-list.json', collect($data3));     
                }

                // Creating Treding Model JSON file ==> End



            $sales = Transaction::sum('cart_amount');
            $customer = User::where('usertype',2)->count('id');
            $product = Fleet::where('is_deleted',0)->count('id');


            //Get Top Merchant----------------------------------------------
            $topmarchants = DB::table('manage_bookings')
                            ->join('organisations', 'organisations.id', '=', 'manage_bookings.organisation_id')
                            ->join('transactions', 'transactions.organisation_id', '=', 'manage_bookings.organisation_id')
                           // ->where('manage_bookings.created_at', 'like', '%' . Carbon::today() . '%')
                            ->select(
                            'organisations.org_name',
                            'manage_bookings.organisation_id'
                        )->distinct()->limit(7)->get();

            //dd($topmarchants);


           //get Trending Models----------------------------------------------------------
            $trendingModels = ManageBookings::with('get_model')->where('manage_bookings.payment_status','=','A')
                                // ->select('manage_bookings.organisation_id','vehicle_models.model_name','manage_bookings.merchant_sku', 'merchant_name','manage_bookings.vehicle_id','manage_bookings.brand_id')
                                 ->distinct()
                                //->whereDate('created_at', '=', Carbon::today())                              
                                // ->groupBy('id')->limit(7)
                                ->get();
                                // $vehicle_model = VehicleModel::select('vehicle_models.id', 'vehicle_models.model_name')->get();

            // dd($trendingModels->get_model);

            // $trendingModels = ManageBookings::all();
            // foreach($trendingModels as $trendingModel)
            // {
            //    $modelName = Vehicle::find($trendingModel->model_id);
            //    dd( $modelName->vehicle_name);
            // }
            
            //feelit --------------------
            $fleets = DB::table('fleets')
                        ->where('is_reserved',1)
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->get();
                        // ->select('fleets.organisation_id')
                        // ->groupBy('id') 
                        // ->get();

            //dd($fleets);


        
        return view('dashboard', ['pageConfigs' => $pageConfigs, 'sales' => $sales , 'customer' => $customer, 'product' => $product , 'topmarchants' => $topmarchants , 'trendingModels' => $trendingModels, 'fleets' => $fleets]);
    }


    private function jsonmodelList1()
    {
            return VehicleModel::select('vehicle_models.model_name','vehicle_models.brand_id','vehicle_models.status')
            
        ->orderBy('vehicle_models.id', 'desc')
        ->get();
        // dd($return);

    }

    private function jsonCompanyList()
    {
        $datas = Organisation::select( 
            'organisations.id',
            'organisations.uuid',
            'organisations.org_name',

            )->withCount('booking')
            ->with('booking','booking.transaction')

        ->where('organisations.id','!=',0)
        ->get();


        $array = [];

        foreach($datas as $key => $data){

            $amount = 0;

            foreach($data->booking as $booking){

                $amount += Transaction::where('booking_id',$booking->id)->sum('cart_amount');
                
            }

            $array[$key]['id']            = $data->id;
            $array[$key]['uuid']          = $data->uuid;
            $array[$key]['org_name']      = $data->org_name;
            $array[$key]['booking']         = $data->booking->count();
            $array[$key]['payment']         = $amount;

        }

        return $array;
        
        
    }


    // Trading list function
    private function jsonTredingList()
    {
        $datas = VehicleModel::select('vehicle_models.id','vehicle_models.uuid','vehicle_models.model_name')->withCount('Bookings')
        ->orderBy('bookings_count','DESC')->get();

        $trendArray = [];

        foreach($datas as $key => $data){

            $trendArray[$key]['name'] = $data->model_name;
            $trendArray[$key]['rental'] = $data->bookings_count;
            $trendArray[$key]['trend'] = $data->bookings_count;
        }

        return $trendArray;
    }
    public function readablechange(Request $request)
    {  
          
            DB::beginTransaction();
            try {
                   $last_ids=$request->readable_id;
                   $data1=0;
                   if($last_ids){
                    foreach($last_ids as $last_ids){
                        
                        $data_changed = Notifications::find($last_ids);
                        $data_changed->superadmin_read = '1';
                        $data_changed->save();
                    }

                    $data= Notifications::select('notifications.*')
                            ->where('read', '0') 
                            ->where('unread', '1') 
                            ->where('user_id', getUser()->id) 
                            ->where('organisation_id', getUser()->organisation_id) 
                            ->orderBy('id', 'DESC') 
                            ->get();
                     $data1=count($data);
                  }    
                DB::commit();
                return ajax_response(true, $data1, [], "Notifications readable Successfully", $this->success);
            } catch (\Exception $e) {
                DB::rollback();
                $message = $e->getMessage();
                return ajax_response(false, [], [], $message, $this->internal_server_error);
            }
        
    }
    
}
