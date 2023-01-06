<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;        
use App\Models\Company;         
use App\Models\Organisation;    
use App\Models\OrganisationMenu;
use App\Models\OrganisationSubMenu;
use App\Models\User;
use App\Models\CountryMaster;   
use App\Models\CompanyBank;     
use App\Models\AmountTransaction;      
use App\Models\Transaction;       
use App\Models\AcountsPayment;       
use App\Models\BookingInvoice;        
use App\Models\Fleet;        
use Illuminate\Support\Facades\Hash;
use App\Models\Booking;         
use App\Models\ManageBookings;            
use App\Models\BookingInvoicedetails;
use App\Models\CompanyKYC;
use App\Models\VehicleModel;    
use App\Models\CompanySubscription; 
use App\Models\GeneralLedger;   
use App\Models\Document;
use App\Models\AdminMenu;
use App\Models\SubscriptionPlans;
use App\Models\CompanyMoreInformation;
use Illuminate\Http\Request;
use App\Mail\ConfirmMail;
use App\Mail\RejectMail;
use App\Mail\BankRejectMail;
use App\Mail\AgreementMail;
use App\Models\Subscription_module;
use App\Models\Subscription_submodule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Http;
use Validator;
use Auth;
use File;  
use Carbon\Carbon;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $pageConfigs = ['pageHeader' => false];

        $path = public_path() . '/data/company-json';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (file_exists($path . '/_company-list.json')) {
            \File::delete($path . '/_company-list.json');
        }

        if (!file_exists($path . '/_company-list.json')) {
            $user = $this->jsonCompanyList();
            $data = array('data' => $user);
            \File::put($path . '/_company-list.json', collect($data));
        }
 
     return view('company.list');   
    }
    private function jsonCompanyList()
    {
        return Organisation::select(
            'organisations.id',
            'organisations.uuid',
            'organisations.org_name',
            'user.email',
            'organisations.org_contact_person',
            'organisations.agreement_status',
            )->with('moreInfo')
            ->join('users as user', function ($join) {
            $join->on('user.organisation_id', '=', 'organisations.id');
          })
          ->where('user.usertype',1)
          ->where('user.deleted_at',null)
          ->orderBy('organisations.id','DESC')
         ->get();      
         }

    private function jsonfleetsList($id)
    {
        
        return Fleet::select('fleets.id', 'fleets.uuid','fleets.image','brand.brand_image','brand.brand_name','model.model_name','fleets.car_service_type','fleets.status') 
            ->leftjoin('vehicle_brands as brand', function ($join) {
            $join->on('brand.id', '=', 'fleets.brand_id');
            })
            ->leftjoin('vehicle_models as model', function ($join) {
            $join->on('model.id', '=', 'fleets.model_id');
            })
           
            ->where('fleets.organisation_id','=',$id)
           // ->where('fleets.id', '=',$id)  
            ->where('fleets.is_deleted','=',0)
            ->orderBy('fleets.id', 'desc')              
            ->get();
         
    }

    private function account_transactionList($id)
    {
        // return  AmountTransaction::select('amount_transactions.*')
        //     ->orderBy('amount_transactions.id', 'desc')
        //     ->where('amount_transactions.organisation_id', '=', $id)
        //     ->get();
        return Transaction::select('transactions.*','booking_invoices.name')
                  ->leftjoin('booking_invoices as booking_invoices', function ($join) {
                      $join->on('booking_invoices.id', '=', 'transactions.invoice_id');
                })
                ->where('transactions.organisation_id', $id)
                ->orderBy('transactions.id', 'desc')
                ->get();
    }

    private function directpaymentrList($id)
    {
        return AcountsPayment::select('acounts_payments.*', 'user.fullname as agentname')
            ->join('users as user', function ($join) {
                $join->on('user.id', '=', 'acounts_payments.created_user');
            })
            ->where('acounts_payments.organisation_id', '=', $id)
           ->get();
    }

    private function jsonInvoiceList($id)
    {
        //  return BookingInvoice::select('booking_invoices.*','amount_transactions.transaction_ref','amount_transactions.type',  'amount_transactions.payment_method','amount_transactions.amount','amount_transactions.id as tran_id')
        //         ->leftjoin('amount_transactions', function ($join) {
        //             $join->on('amount_transactions.invoice_id', '=', 'booking_invoices.id');
        //         })
        //         ->where('booking_invoices.organisation_id', '=', $id) 
        //         ->where('booking_invoices.document_type', 'account')   
        //         ->get();
        return BookingInvoice::select('booking_invoices.*','transaction.id as tran_id','transaction.tran_ref','transaction.tran_type','transaction.payment_method','transaction.cart_amount','transaction.transaction_time','transaction.payment_status','transaction.cart_currency')
            ->leftJoin('transactions as transaction', function ($join) {
                $join->on('transaction.invoice_id', '=', 'booking_invoices.id');
            }) 
        /*  ->where('booking_invoices.document_type', 'account')  */
            ->where('booking_invoices.organisation_id', $id)  
        /*  ->orwhere('booking_invoices.document_type', 'booking')  */
            ->orderBy('booking_invoices.id','desc')   
            ->get();  
        
    }

    private function jsonkycsList($id)
    {
        return CompanyBank::select('company_banks.id','company_banks.bank_name','company_banks.iban_code','company_banks.status')
        ->where('company_banks.organisation_id', '=', $id)
           ->get(); 
          
    }

    private function jsonkycs1List($id)
    {
        return CompanyKYC::select('company_k_y_c_s.*')
        ->where('company_k_y_c_s.organisation_id', '=', $id)
           ->get(); 
          
    }

    private function json_booking_list($id)
    {
        $super= Booking::select('bookings.id','bookings.status','bookings.pickup as pickup','bookings.merchantname as merchantname','vehicle_brands.brand_name','bookings.booking_status','bookings.amount','bookings.driver_id','bookings.dropoff_address as dropoff_address')
        
        ->leftjoin('vehicle_brands', function ($join) {
            $join->on('vehicle_brands.id', '=', 'bookings.bookingMake');
        }) 
        ->where('bookings.organisation_id','=',$id);

            $admin= ManageBookings::select('manage_bookings.id','manage_bookings.driver_id','manage_bookings.status','manage_bookings.booking_status','manage_bookings.amount','vehicle_brands.brand_name','manage_bookings.merchant_name as merchantname','manage_bookings.pickup_address as pickup','manage_bookings.dropoff_address as dropoff_address')
                     
                   ->leftjoin('vehicle_brands', function ($join) {
                    $join->on('vehicle_brands.id', '=', 'manage_bookings.vehicle_id');
                }) 
                    ->union($super) 
                    ->where('manage_bookings.organisation_id','=',$id)
                    ->get(); 
                  
                   return $admin;
          
    }

    public function company_invoice_details($id)
    {
     
        $transaction_details=Transaction::select('booking_invoices.name','booking_invoices.email','booking_invoices.street','booking_invoices.city','booking_invoices.country','booking_invoices.state','booking_invoices.subtotal','booking_invoices.subtotal_discount','booking_invoices.delivery_charge','booking_invoices.grand_total','transactions.*')
            ->leftjoin('booking_invoices as booking_invoices', function ($join) {
                $join->on('transactions.invoice_id', '=', 'booking_invoices.id');
            })
              ->where('transactions.invoice_id', $id)
              ->orderBy('transactions.id', 'desc')
              ->first();
        // dd($transaction_details);
        //   return Transaction::select('booking_invoices.name','transactions.*')
        //   ->leftjoin('booking_invoices as booking_invoices', function ($join) {
        //       $join->on('transactions.invoice_id', '=', 'booking_invoices.id');
        //   })
        //   ->withoutGlobalScope('organisation_id')
        //   ->where('transactions.organisation_id', getUser()->organisation_id)
        //   ->orderBy('transactions.id', 'desc')
        //   ->get();
        
        return json_encode($transaction_details);
         
    }

    public function invoice_details_data($id)
    { 
          
        $invoice_details=BookingInvoicedetails::select('booking_invoicedetails.*','fleets.car_SKU','transactions.tran_ref')
        ->leftjoin('booking_invoices as booking_invoices', function ($join) {
            $join->on('booking_invoices.id', '=', 'booking_invoicedetails.invoice_id');
        }) 
        ->leftjoin('transactions as transactions', function ($join) {
            $join->on('transactions.invoice_id', '=', 'booking_invoices.id');
        }) 
        ->leftjoin('fleets as fleets', function ($join) {
            $join->on('fleets.id', '=', 'booking_invoicedetails.sku');
        }) 
        ->where('transactions.invoice_id','=',$id) 
        ->get();
          
      
        foreach($invoice_details as $key=>$invoice){
            if($key==0){
                $html = "<tr>
                <td class='font-weight-bold  text-left'>".$invoice->car_SKU."</td>
                <td class='font-weight-bold  text-left'>".$invoice->description."</td>
                <td class='font-weight-bold  text-left'>".$invoice->price."</td>
                <td class='font-weight-bold  text-left'>".$invoice->period."</td>
                <td class='font-weight-bold  text-left'>".$invoice->discount."</td>
                <td class='font-weight-bold  text-left'>".$invoice->tax."</td>
                <td class='font-weight-bold  text-left'>".$invoice->total."</td>
                <tr>";
            }else{
            $html .= "<tr>
            <td class='font-weight-bold  text-left'>".$invoice->car_SKU."</td>
            <td class='font-weight-bold  text-left'>".$invoice->description."</td>
            <td class='font-weight-bold  text-left'>".$invoice->price."</td>
            <td class='font-weight-bold  text-left'>".$invoice->period."</td>
            <td class='font-weight-bold  text-left'>".$invoice->discount."</td>
            <td class='font-weight-bold  text-left'>".$invoice->tax."</td>
            <td class='font-weight-bold  text-left'>".$invoice->total."</td>
            <tr>";
            }
           
          }
           $return['html'] = $html; 
         echo json_encode($return);die;

    }

    public function company_transaction_details($id)
    {
        
        $transaction_details=Transaction::select('booking_invoices.name','booking_invoices.email','booking_invoices.street','booking_invoices.city','booking_invoices.country','booking_invoices.state','booking_invoices.subtotal','booking_invoices.subtotal_discount','booking_invoices.delivery_charge','booking_invoices.grand_total','transactions.*')
        ->leftjoin('booking_invoices as booking_invoices', function ($join) {
            $join->on('transactions.invoice_id', '=', 'booking_invoices.id');
        })
          ->where('transactions.invoice_id', $id)
          ->orderBy('transactions.id', 'desc')
          ->first();
        
        return json_encode($transaction_details);
         
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
        
        return view('company.create', compact('countries','plans','menus')); 
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }
    public function view($id)
    {
        $path = public_path() . '/data/superadmin/company/fleets-datatable-json';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (file_exists($path . '/_fleets-list.json')) {
            \File::delete($path . '/_fleets-list.json');
        }

        if (!file_exists($path . '/_fleets-list.json')) {
            $user  = $this->jsonfleetsList($id);
            $data  = array('data' => $user);
            \File::put($path . '/_fleets-list.json', collect($data));
        }

        $path1 = public_path() . '/data/superadmin/company/transaction-json';

        if (!file_exists($path1)) {
            \File::makeDirectory($path1, 0777, true, true);
        }

        if (file_exists($path1 . '/_transaction-list.json')) {
            \File::delete($path1 . '/_transaction-list.json');
        }

        if (!file_exists($path1 . '/_transaction-list.json')) {
            $user1  = $this->account_transactionList($id);
            
            $data1  = array('data' => $user1);
            \File::put($path1 . '/_transaction-list.json', collect($data1));
        }

        $path2 = public_path() . '/data/superadmin/company/payment-json';

        if (!file_exists($path2)) {
            \File::makeDirectory($path2, 0777, true, true);
        }

        if (file_exists($path2 . '/_payment-list.json')) {
            \File::delete($path2 . '/_payment-list.json');
        }

        if (!file_exists($path2 . '/_payment-list.json')) {
            $user2  = $this->directpaymentrList($id);
            $data2  = array('data' => $user2);
            \File::put($path2 . '/_payment-list.json', collect($data2));
        }

        $path3 = public_path() . '/data/superadmin/company/invoice-json';

        if (!file_exists($path3)) {
            \File::makeDirectory($path3, 0777, true, true);
        }

        if (file_exists($path3 . '/_invoice-list.json')) {
            \File::delete($path3 . '/_invoice-list.json');
        }

        if (!file_exists($path3 . '/_invoice-list.json')) {
            $user3  = $this->jsonInvoiceList($id);
            $data3  = array('data' => $user3);
            \File::put($path3 . '/_invoice-list.json', collect($data3));
        }

        $path4 = public_path() . '/data/superadmin/company/kycs-json';

        if (!file_exists($path4)) {
            \File::makeDirectory($path4, 0777, true, true);
        }

        if (file_exists($path4 . '/_kycs-datatable.json')) {
            \File::delete($path4 . '/_kycs-datatable.json');
        }

        if (!file_exists($path4 . '/_kycs-datatable.json')) {
            $user4  = $this->jsonkycsList($id);
            $data4  = array('data' => $user4);
            \File::put($path4 . '/_kycs-datatable.json', collect($data4));
        }

        $path5 = public_path() . '/data/superadmin/company/kycs1-json';

        if (!file_exists($path5)) {
            \File::makeDirectory($path5, 0777, true, true);
        }

        if (file_exists($path5 . '/_kycs1-datatable.json')) {
            \File::delete($path5 . '/_kycs1-datatable.json');
        }

        if (!file_exists($path5 . '/_kycs1-datatable.json')) {
            $user5  = $this->jsonkycs1List($id);
            $data5  = array('data' => $user5);
            \File::put($path5 . '/_kycs1-datatable.json', collect($data5));
        }

        $path6 = public_path() . '/data/superadmin/company/booking-data-json';

        if (!file_exists($path6)) {
            \File::makeDirectory($path6, 0777, true, true);
        }

        if (file_exists($path6 . '/_booking-data-list.json')) {
            \File::delete($path6 . '/_booking-data-list.json');
        }

        if (!file_exists($path6 . '/_booking-data-list.json')) {
            $user6 = $this->json_booking_list($id);
            $data6  = array('data' => $user6);
            \File::put($path6 . '/_booking-data-list.json', collect($data6));
        }

        $path7 = public_path() . '/data/superadmin/company/booking-data-json';

        if (!file_exists($path7)) {
            \File::makeDirectory($path7, 0777, true, true);
        }

        if (file_exists($path7 . '/_booking-data-list.json')) {
            \File::delete($path7 . '/_booking-data-list.json');
        }

        if (!file_exists($path7 . '/_booking-data-list.json')) {
            $user7 = $this->json_booking_list($id);
            $data7  = array('data' => $user7);
            \File::put($path7 . '/_booking-data-list.json', collect($data7));
        }

        $orgs_name= Organisation::select('organisations.*','user.email','user.fullname','country_masters.name','company_more_information.zip','company_more_information.company_profile','company_more_information.branded_pay_1','company_more_information.branded_pay_2','company_more_information.api_key','company_subscriptions.withdrawal_amount','company_subscriptions.payment_gateway','company_more_information.withdraw_limit','company_subscriptions.billing_plan') 
           ->leftjoin('users as user', function ($join) {
              $join->on('user.organisation_id', '=', 'organisations.id');
            })
            ->leftjoin('country_masters as country_masters', function ($join) {
                $join->on('country_masters.id', '=', 'organisations.org_country_id');
              })
              ->leftjoin('company_more_information as company_more_information', function ($join) {
                $join->on('company_more_information.organisation_id', '=', 'organisations.id');
              })
              ->leftjoin('company_subscriptions as company_subscriptions', function ($join) {
                $join->on('company_subscriptions.organisation_id', '=', 'organisations.id');
              })
              ->where('organisations.id','=',$id)
              ->first();
 
                $fleet_size=Fleet::select('id')->where('organisation_id','=',$id)->where('is_deleted','=','0')->count();
                    
                $booking=Fleet::select('id')->where('organisation_id','=',$id)->where('is_deleted','=','0')->where('is_reserved','=','1')->count();

                $available=Fleet::select('id')->where('organisation_id','=',$id)->where('is_deleted','=','0')->where('is_reserved','=','0')->count();
                 
                $revenue=ManageBookings::select(DB::raw('sum(amount) as amounts'))->where('organisation_id','=',$id)->where('deleted_at','=',null)->where('payment_status','=','A')->orwhere('payment_status','=','H')->groupBy('organisation_id')->get();
                 
                $i=0;
                 // Convert Price to Crores or Lakhs or Thousands
                if(isset($revenue[$i]->amounts)){ 
                    $length = strlen($revenue[$i]->amounts);
                    $currency = '';
                    
                    if($length == 3)
                    {
                       
                        $currency = $revenue[0]->amounts;
                        
                    }
                    elseif($length == 4 || $length == 5)
                    {
                        // Thousand
                        $number = $revenue[0]->amounts / 1000;
                        $number = round($number,2);
                        $ext = "K";
                        $currency = $number." ".$ext;
                    }
                    elseif($length == 6 || $length == 7)
                    {
                        // Lakhs
                        $number = $revenue[0]->amounts / 100000;
                        $number = round($number,2);
                        $ext = "Lac";
                        $currency = $number." ".$ext;

                    }
                    elseif($length == 8 || $length == 9)
                    {
                        // Crores
                        $number = $revenue[0]->amounts / 10000000;
                        $number = round($number,2);
                        $ext = "Cr";
                        $currency = $number.' '.$ext;
                    }
                }else{
                    $currency = 0;
                }
                $doc123=Document::select('*')->where('organisation_id',$id)->first();
           
                $countries =  CountryMaster::all();

                $company = Organisation::with(
                    'user',
                    'banks',
                    'kycDetail',
                    'moreInfo',
                    'subscription'
                )
                ->where('id',$id)
                ->first();
                   
                $pending = GeneralLedger::select('Balance')->where('organisation_id',$id)->orderBy('id', 'DESC')->first();
                $last_payout = GeneralLedger::select('debit','Balance')->where('organisation_id',$id)->orderBy('id', 'DESC')->first();
                $gl= GeneralLedger::select('general_ledgers.*')
                ->where('organisation_id',$id)
                ->orderBy('general_ledgers.id', 'desc')
                ->get();
               
                $plans = SubscriptionPlans::select('id','plan_name')->get();
                $doc1 =Document::select('*')->where('organisation_id',$id)->first();
           return view('company.view',compact('orgs_name','gl','last_payout','pending','fleet_size','available','booking','revenue','currency','doc123','countries','company','plans','doc1'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $countries =  CountryMaster::all();

        $company = Organisation::with(
            'user',
            'banks',
            'kycDetail',
            'moreInfo',
            'subscription'
        )
        ->where('uuid',$uuid)
        ->first();

        $payment_gateway_array = explode(',',$company->subscription->payment_gateway);
        $payment_amount_array = explode(',',$company->subscription->payement_gateway_amount);
        $fullname = ($company->user != '' ? explode(" ", $company->user->fullname) : '');


        $padd_array = [];

        foreach($payment_gateway_array as $key => $pga){
            $padd_array[$pga] = (array_key_exists($key, $payment_amount_array)  ? $payment_amount_array[$key] : '');
        }

        $plans = SubscriptionPlans::select('id','plan_name')->get();

        $menus = AdminMenu::with('sub_menu')->get();

        $inserted_menu = array();
        $inserted_subMenu = array();

        foreach($company->org_menu as $set_menu){
            $inserted_menu[] = $set_menu->admin_menu_id; 

        }

        foreach($company->org_sub_menu as $set_sub_menu){
            $inserted_subMenu[] = $set_sub_menu->admin_sub_menu_id;
        }


        return view('company.edit', compact('countries','company','fullname','payment_gateway_array','payment_amount_array','plans','padd_array','menus','inserted_menu','inserted_subMenu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }


    //CHECKING UNIQUE BANK ACCOUNT NUMBER
    public function check_unique_bank_numbers(Request $request)
    {
        // Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'bank_name' => 'required',
            'bic' => 'required',
            'account_name' => 'required',
            'iban' => 'required',
            'account_no' => 'required',
            'currency' => 'required',
            'status' => 'required',
        ]);
        if($validator->fails()) return 'Cyber';


        //CHECKING IBAN ALREADY EXISTS OR NOT
        $checkIBAN = CompanyBank::where(['iban_code' => $request->iban])->first();
        if(!is_null($checkIBAN)) return 'iban';

        return 'true';
    }

    

    //Create Company Process
    public function create_process(Request $request)
    {
      



        // dd($request->payment_gateway_charge);
    DB::beginTransaction();
    try {

        //Company logo store

        if($request->file('company_logo')){
        $validator = Validator::make($request->all(), [
            'company_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($validator->fails()) return 'company_logo';
       }

        $checkEmail = User::where(['email' => $request->admin_email, 'usertype' => 1])->first();
        if(!is_null($checkEmail)) return 'admin_email';
 
        if($request->file('company_logo')){

            $file  = $request->file('company_logo');
            $companyLogo= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('/company/logo'), $companyLogo);

        }

        //organisation (is same as company) store
        $organisation                               = new Organisation;
        $organisation->org_name                     = $request->company_name;
        $organisation->org_city                     = $request->gener_city;
        $organisation->org_state                    = $request->gener_state;
        $organisation->org_country_id               = $request->gener_country;
        // $organisation->org_postal                   = $request->gener_zip;
        $organisation->org_phone                    = $request->org_phone;
        $organisation->org_contact_person           = $request->first_name.' '.$request->last_name;
        $organisation->org_contact_person_number    = $request->admin_phone;
        $organisation->password                     = $request->password; 
        $organisation->org_currency                 = $request->subs_currency;
        $organisation->designation                  = $request->designation;
        $organisation->website                      = $request->website;
        $organisation->org_status                      = 2;
        if($request->file('company_logo')){
        $organisation->org_logo                     = $companyLogo;
        }
        $organisation->save();


        // pre($organisation);

        //user store
        $user = new User;
        $user->organisation_id  =   $organisation->id;
        $user->usertype         =   1;
        $user->fullname         =   $request->first_name.' '.$request->last_name;
        $user->email            =   $request->admin_email;
        $user->password         =   Hash::make($request->password); 
        $user->mobile           =   $request->admin_phone; 
        $user->country_id       =   $request->gener_country;
        $user->save();


        //Owner document store
        if($request->file('own_document1')){

            $file  = $request->file('own_document1');
            $own_document1= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $own_document1);

        }
        if($request->file('own_document2')){

            $file  = $request->file('own_document2');
            $own_document2= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $own_document2);

        }
        if($request->file('own_document3')){

            $file  = $request->file('own_document3');
            $own_document3= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $own_document3);

        }
        if($request->file('own_document4')){

            $file  = $request->file('own_document4');
            $own_document4= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $own_document4);

        }


        //bussiness document store
        if($request->file('bu_document1')){

            $file  = $request->file('bu_document1');
            $bu_document1= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $bu_document1);

        }
        if($request->file('bu_document2')){

            $file  = $request->file('bu_document2');
            $bu_document2= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $bu_document2);

        }
        if($request->file('bu_document3')){

            $file  = $request->file('bu_document3');
            $bu_document3= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $bu_document3);

        }
        if($request->file('bu_document4')){

            $file  = $request->file('bu_document4');
            $bu_document4= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $bu_document4);

        }

        if($request->file('bu_document5')){

            $file  = $request->file('bu_document5');
            $bu_document5= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $bu_document5);

        }


        //other document store
        if($request->file('ot_document1')){

            $file  = $request->file('ot_document1');
            $ot_document1= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $ot_document1);

        }
        if($request->file('ot_document2')){

            $file  = $request->file('ot_document2');
            $ot_document2= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $ot_document2);

        }
        if($request->file('ot_document3')){

            $file  = $request->file('ot_document3');
            $ot_document3= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $ot_document3);

        }
        if($request->file('ot_document4')){

            $file  = $request->file('ot_document4');
            $ot_document4= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $ot_document4);

        }


        $kyc    =   new CompanyKYC;

        $kyc->organisation_id  =   $organisation->id;

        $kyc->tax_document_check_box = $request->tax_document_check_box;


        $docs_status = new Document;

        $docs_status->organisation_id = $organisation->id;


        if($request->file('own_document1')){
        $kyc->ow_document1  =   $own_document1;  
        $docs_status->ow_doc_type1_status = '0';

        }

        $kyc->ow_doc_type1  =   $request->ow_document_type_1;

        if($request->file('own_document2')){
        $kyc->ow_document2  =   $own_document2;
        $docs_status->ow_doc_type2_status = '0';

        }

        $kyc->ow_doc_type2  =   $request->ow_document_type_2;

        if($request->file('own_document3')){
        $kyc->ow_document3  =   $own_document3;
        $docs_status->ow_doc_type3_status = '0';

        }

        $kyc->ow_doc_type3  =   $request->ow_document_type_3;

        if($request->file('own_document4')){
        $kyc->ow_document4  =   $own_document4;
        $docs_status->ow_doc_type4_status = '0';

        }

        $kyc->ow_doc_type4  =   $request->ow_document_type_4;

        if($request->file('bu_document1')){
        $kyc->bu_document1  =   $bu_document1;
        $docs_status->bu_doc_type1_status = '0';

        }

        $kyc->bu_doc_type1  =   $request->bu_document_type_1;

        if($request->file('bu_document2')){
        $kyc->bu_document2  =   $bu_document2;
        $docs_status->bu_doc_type2_status = '0';

        }

        $kyc->bu_doc_type2  =   $request->bu_document_type_2;

        if($request->file('bu_document3')){
        $kyc->bu_document3  =   $bu_document3;
        $docs_status->bu_doc_type3_status = '0';

        }

        $kyc->bu_doc_type3  =   $request->bu_document_type_3;

        if($request->file('bu_document4')){
        $kyc->bu_document4  =   $bu_document4;
        $docs_status->bu_doc_type4_status = '0';

        }

        $kyc->bu_doc_type4  =   $request->bu_document_type_4;

        if($request->file('bu_document5')){
        $kyc->bu_document5  =   $bu_document5;
        $docs_status->bu_doc_type5_status = '0';

        }

        $kyc->bu_doc_type5  =   $request->bu_document_type_5;

        if($request->file('ot_document1')){
        $kyc->ot_document1  =   $ot_document1;
        $docs_status->ot_doc_type1_status = '0';

        }

        $kyc->ot_doc_type1  =   $request->ot_document_type_1;

        if($request->file('ot_document2')){
        $kyc->ot_document2  =   $ot_document2;
        $docs_status->ot_doc_type2_status = '0';

        }
        
        $kyc->ot_doc_type2  =   $request->ot_document_type_2;

        if($request->file('ot_document3')){
        $kyc->ot_document3  =   $ot_document3;
        $docs_status->ot_doc_type3_status = '0';

        }

        $kyc->ot_doc_type3  =   $request->ot_document_type_3;

        if($request->file('ot_document4')){
        $kyc->ot_document4  =   $ot_document4;
        $docs_status->ot_doc_type4_status = '0';

        }

        $kyc->ot_doc_type4  =   $request->ot_document_type_4;


        $kyc->save();

        $docs_status->save();

        
        

        // Creating Banks Here
        if(isset($request->bank_name))
        {
            if($request->bank_name != "")
            {
                $bank_name = explode(',', $request->bank_name);
                $bic = explode(',', $request->bic);
                $account_name = explode(',', $request->account_name);
                $iban = explode(',', $request->iban);
                $account_no = explode(',', $request->account_no);
                $currency = explode(',', $request->b_currency);
                $status = explode(',', $request->b_status);

                for($i = 0; $i < count($bank_name); $i++)
                {
                    $bank = new CompanyBank;
                    $bank->organisation_id = $organisation->id;
                    $bank->bank_name = $bank_name[$i];
                    $bank->bic_code = $bic[$i];
                    $bank->account_name = $account_name[$i];
                    $bank->iban_code = $iban[$i];
                    $bank->account_no = $account_no[$i];
                    $bank->currency_id = $currency[$i];
                    $bank->status = $status[$i];
                    $bank->save();


                }
            }
        }



        //Inserting company more information
        $cmi                    = new CompanyMoreInformation;   
        $cmi->organisation_id   = $organisation->id;
        $cmi->trn_number        = $request->trn_number;
        $cmi->office_address    = $request->office_address;
        $cmi->city              = $request->more_info_city;
        // $cmi->country_id        = $request->more_inf_country;
        $cmi->state             = $request->more_info_state;
        $cmi->zip               = $request->more_info_zip;
        $cmi->profile_image     = $request->more_info_profile_image;
        $cmi->profile_id        = $request->profile_id;
        $cmi->server_key        = $request->server_key;
        $cmi->company_prefix    = $request->company_prefix;
        $cmi->account_type_id   = $request->account_type;
        $cmi->currency_id       = $request->more_info_currency;
        $cmi->company_profile   = $request->company_profile;
        // $cmi->packages_id       = $request->package;
        $cmi->branded_pay_1     = ($request->branded_pay_page == 'true' ? '1' : ($request->branded_pay_page == 'false' ? '0' : '') );
        $cmi->branded_pay_2     = ($request->branded_email == 'true' ? '1' : ($request->branded_email == 'false' ? '0' : '') ); 
        $cmi->withdraw_limit    = (isset($request->withdraw_limit) ? $request->withdraw_limit : 0);
        $cmi->available_limit   = (isset($request->available_limit) ? $request->available_limit : 0);
        $cmi->sender_id         = $request->sender_id_by_name;
        $cmi->api_key           = $request->api_key;
        $cmi->sms_limit         = $request->sms_limit;
        $cmi->save();


        $cs = new CompanySubscription;  
        $cs->organisation_id    =   $organisation->id;
        $cs->billing_plan       =   $request->billing_plan;
        $cs->add_on_charge      =   $request->add_on_charge;
        $cs->diposit            =   $request->deposit;
        $cs->convenience_type   =   $request->convenience_fees_type;
        $cs->convenience_amount =   $request->convenience_amount;
        $cs->commission_type    =   $request->commision_fees_type;
        $cs->commission_amount  =   $request->commission_amount;
        $cs->withdrawal_type    =   $request->withdrawal_charge_add;
        $cs->withdrawal_amount  =   $request->withdrawal_charge_amt;
        $cs->payment_gateway    =   $request->payment_gateway_charge;
        $cs->payement_gateway_amount    =   $request->payement_gateway_amount;
        $cs->first_billing_date       =   $request->first_billing_date;
        $cs->end_billing_date       =   $request->end_billing_date;
        $cs->auto_renewal           =   ($request->auto_renewal == 'on' ? '1' : ($request->auto_renewal == 'false' ? '0' : ''));
        $cs->description        =   $request->description;
        $cs->include_description    =   ($request->desc_in_invoice == 'on' ? '1' : ($request->desc_in_invoice == 'false' ? '0' : ''));
        $cs->currency               =   $request->subs_currency;
        // $cs->vat                =   $request->subs_vat;
        // $cs->other              =   $request->subs_other;
        $cs->term_condition     =   $request->subs_term_cond;

        $cs->payout_setup     =   $request->payout_setup;
        $cs->time_cycle     =   $request->time_cycle;
        $cs->payout_day     =   $request->payout_day;
        
        $cs->save();


        // Saving permission module and sub module data,

        $menus = explode(',',$request->menu);
        $smenus = explode(',',$request->smenu);
        $sub_menus = explode(',',$request->sub_menu);

        foreach($menus as $menu){

            $org_menu                   = new OrganisationMenu;
            $org_menu->organisation_id  = $organisation->id;
            $org_menu->admin_menu_id    = $menu;
            $org_menu->save();
        }

        foreach($smenus as $key => $smenu){

            $org_sub_menu                       = new OrganisationSubMenu;
            $org_sub_menu->organisation_id      = $organisation->id;
            $org_sub_menu->organisation_menu_id = $smenu;
            $org_sub_menu->admin_sub_menu_id    = $sub_menus[$key];
            $org_sub_menu->save();
        }





        Mail::mailer('smtp2')->to($request->admin_email)->send(new ConfirmMail($user));
        
        // Mail::to($request->admin_email)->send(new ConfirmMail($user));

        DB::commit();
        return ajax_response(true, $organisation, [], "Company saved successfully!", $this->success);

    } catch (\Exception $e) {
        DB::rollback();
        $message = $e->getMessage();
        return ajax_response(false, [], [], $message, $this->internal_server_error);
    } catch (\Throwable $e) {
        DB::rollback();
        $message = $e->getMessage();
        return ajax_response(false, [], [], $message, $this->internal_server_error);
    }




    }


    //Edit Company Process
    public function edit_process(Request $request)
    {

    DB::beginTransaction();
    try {

        $organisation = Organisation::find($request->company_id);
        // dd($organisation->org_logo);

        //Company logo store
        if($request->file('company_logo')){
            $validator = Validator::make($request->all(), [
                'company_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if($validator->fails()) return 'company_logo';
           }

        if($request->file('company_logo')){

            if($organisation->org_logo){
                unlink(public_path('/company/logo/') . $organisation->org_logo);
            }

            $file  = $request->file('company_logo');
            $companyLogo= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('/company/logo'), $companyLogo);

        }

        //organisation (is same as company) store
        
        $organisation->org_name                     = $request->company_name;
        $organisation->org_city                     = $request->gener_city;
        $organisation->org_state                    = $request->gener_state;
        $organisation->org_country_id               = $request->gener_country;
        // $organisation->org_postal                   = $request->gener_zip;
        $organisation->org_phone                    = $request->org_phone;
        $organisation->org_contact_person           = $request->first_name.' '.$request->last_name;
        $organisation->org_contact_person_number    = $request->admin_phone;
        $organisation->password                     = $request->password;
        $organisation->org_currency                 = $request->subs_currency;
        $organisation->designation                  = $request->designation;
        $organisation->website                      = $request->website;
        $organisation->org_status                      = 2;
        if($request->file('company_logo')){
        $organisation->org_logo                     = $companyLogo;
        }
        $organisation->save();


        //user store
        $user = User::where('organisation_id',$request->company_id)->first();
        $user->organisation_id  =   $organisation->id;
        $user->usertype         =   1;
        $user->fullname         =   $request->first_name.' '.$request->last_name;
        $user->email            =   $request->admin_email;
        $user->password         =   Hash::make($request->password);
        $user->mobile           =   $request->admin_phone; 
        $user->country_id       =   $request->gener_country;
        $user->save();



        // KYC document store and its status code
        $kyc =CompanyKYC::where('organisation_id',$request->company_id)->first();
// dd($kyc);
        $kyc->tax_document_check_box = $request->tax_document_check_box;


        $docs_status =Document::where('organisation_id',$request->company_id)->first();


        //Owner document store
        if($request->file('own_document1')){

            if($kyc->ow_document1 != null)
            {
                unlink(public_path('/company/docs/') . $kyc->ow_document1);
            }
            
            $file  = $request->file('own_document1');
            $own_document1= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $own_document1);

        }
        if($request->file('own_document2')){

            if($kyc->ow_document2 != null)
            {
                unlink(public_path('/company/docs/') . $kyc->ow_document2);
            }

            $file  = $request->file('own_document2');
            $own_document2= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $own_document2);

        }
        if($request->file('own_document3')){

            if($kyc->ow_document3 != null)
            {
                unlink(public_path('/company/docs/') . $kyc->ow_document3);
            }


            $file  = $request->file('own_document3');
            $own_document3= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $own_document3);

        }
        if($request->file('own_document4')){

            if($kyc->ow_document4 != null)
            {
                unlink(public_path('/company/docs/') . $kyc->ow_document4);
            }

            $file  = $request->file('own_document4');
            $own_document4= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $own_document4);

        }




        //bussiness document store
        if($request->file('bu_document1')){

            if($kyc->bu_document1 != null)
            {
                unlink(public_path('/company/docs/') . $kyc->bu_document1);
            }

            $file  = $request->file('bu_document1');
            $bu_document1= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $bu_document1);

        }
        if($request->file('bu_document2')){

            if($kyc->bu_document2 != null)
            {
                unlink(public_path('/company/docs/') . $kyc->bu_document2);
            }

            $file  = $request->file('bu_document2');
            $bu_document2= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $bu_document2);

        }
        if($request->file('bu_document3')){

            if($kyc->bu_document3 != null)
            {
                unlink(public_path('/company/docs/') . $kyc->bu_document3);
            }

            $file  = $request->file('bu_document3');
            $bu_document3= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $bu_document3);

        }
        if($request->file('bu_document4')){

            if($kyc->bu_document4 != null)
            {
                unlink(public_path('/company/docs/') . $kyc->bu_document4);
            }

            $file  = $request->file('bu_document4');
            $bu_document4= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $bu_document4);

        }

        if($request->file('bu_document5')){

            if($kyc->bu_document5 != null)
            {
                unlink(public_path('/company/docs/') . $kyc->bu_document5);
            }

            $file  = $request->file('bu_document5');
            $bu_document5= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $bu_document5);

        }


        //other document store
        if($request->file('ot_document1')){

            if($kyc->ot_document1 != null)
            {
                unlink(public_path('/company/docs/') . $kyc->ot_document1);
            }

            $file  = $request->file('ot_document1');
            $ot_document1= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $ot_document1);

        }
        if($request->file('ot_document2')){

            if($kyc->ot_document2 != null)
            {
                unlink(public_path('/company/docs/') . $kyc->ot_document2);
            }

            $file  = $request->file('ot_document2');
            $ot_document2= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $ot_document2);

        }
        if($request->file('ot_document3')){

            if($kyc->ot_document3 != null)
            {
                unlink(public_path('/company/docs/') . $kyc->ot_document3);
            }

            $file  = $request->file('ot_document3');
            $ot_document3= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $ot_document3);

        }
        if($request->file('ot_document4')){

            if($kyc->ot_document4 != null)
            {
                unlink(public_path('/company/docs/') . $kyc->ot_document4);
            }

            $file  = $request->file('ot_document4');
            $ot_document4= date('YmdHi').rand ( 10000 , 99999 ).$file->getClientOriginalName();
            $file-> move(public_path('/company/docs'), $ot_document4);

        }



        $kyc->organisation_id  =   $organisation->id;

        if($request->file('own_document1')){
        $kyc->ow_document1  =   $own_document1;  
        $kyc->ow_doc_type1  =   $request->ow_document_type_1;
        $docs_status->ow_doc_type1_status = '0';


        }

        

        if($request->file('own_document2')){
        $kyc->ow_document2  =   $own_document2;
        $kyc->ow_doc_type2  =   $request->ow_document_type_2;
        $docs_status->ow_doc_type2_status = '0';


        }

        

        if($request->file('own_document3')){
        $kyc->ow_document3  =   $own_document3;
        $kyc->ow_doc_type3  =   $request->ow_document_type_3;
        $docs_status->ow_doc_type3_status = '0';

        }

        

        if($request->file('own_document4')){
        $kyc->ow_document4  =   $own_document4;
        $kyc->ow_doc_type4  =   $request->ow_document_type_4;
        $docs_status->ow_doc_type4_status = '0';


        }

        

        if($request->file('bu_document1')){
        $kyc->bu_document1  =   $bu_document1;
        $kyc->bu_doc_type1  =   $request->bu_document_type_1;
        $docs_status->bu_doc_type1_status = '0';


        }

        

        if($request->file('bu_document2')){
        $kyc->bu_document2  =   $bu_document2;
        $kyc->bu_doc_type2  =   $request->bu_document_type_2;
        $docs_status->bu_doc_type2_status = '0';


        }

        

        if($request->file('bu_document3')){
        $kyc->bu_document3  =   $bu_document3;
        $kyc->bu_doc_type3  =   $request->bu_document_type_3;
        $docs_status->bu_doc_type3_status = '0';


        }

        

        if($request->file('bu_document4')){
        $kyc->bu_document4  =   $bu_document4;
        $kyc->bu_doc_type4  =   $request->bu_document_type_4;
        $docs_status->bu_doc_type4_status = '0';

        }

        if($request->file('bu_document5')){
            $kyc->bu_document5  =   $bu_document5;
            $kyc->bu_doc_type5  =   $request->bu_document_type_5;
            $docs_status->bu_doc_type5_status = '0';

        }

        if($request->file('ot_document1')){
        $kyc->ot_document1  =   $ot_document1;
        $kyc->ot_doc_type1  =   $request->ot_document_type_1;
        $docs_status->ot_doc_type1_status = '0';

        }

        

        if($request->file('ot_document2')){
        $kyc->ot_document2  =   $ot_document2;
        $kyc->ot_doc_type2  =   $request->ot_document_type_2;
        $docs_status->ot_doc_type2_status = '0';

        }
        
        

        if($request->file('ot_document3')){
        $kyc->ot_document3  =   $ot_document3;
        $kyc->ot_doc_type3  =   $request->ot_document_type_3;
        $docs_status->ot_doc_type3_status = '0';


        }

        

        if($request->file('ot_document4')){
        $kyc->ot_document4  =   $ot_document4;
        $kyc->ot_doc_type4  =   $request->ot_document_type_4;
        $docs_status->ot_doc_type4_status = '0';


        }        

        $kyc->save();

        $docs_status->save();


        // Creating Banks Here
        if(isset($request->bank_name))
        {
            if($request->bank_name != "")
            {
                CompanyBank::where('organisation_id',$request->company_id)->delete();
                $bank_name = explode(',', $request->bank_name);
                $bic = explode(',', $request->bic);
                $account_name = explode(',', $request->account_name);
                $iban = explode(',', $request->iban);
                $account_no = explode(',', $request->account_no);
                $currency = explode(',', $request->b_currency);
                $status = explode(',', $request->b_status);

                for($i = 0; $i < count($bank_name); $i++)
                {
                    $bank = new CompanyBank;
                    $bank->organisation_id = $organisation->id;
                    $bank->bank_name = $bank_name[$i];
                    $bank->bic_code = $bic[$i];
                    $bank->account_name = $account_name[$i];
                    $bank->iban_code = $iban[$i];
                    $bank->account_no = $account_no[$i];
                    $bank->currency_id = $currency[$i];
                    $bank->status = $status[$i];
                    $bank->save();


                }
            }
        }



        //Inserting company more information
        $cmi                    =CompanyMoreInformation::where('organisation_id',$request->company_id)->first();;   
        $cmi->organisation_id   = $organisation->id;
        $cmi->trn_number        = $request->trn_number;
        $cmi->office_address    = $request->office_address;
        $cmi->city              = $request->more_info_city;
        // $cmi->country_id        = $request->more_inf_country;
        $cmi->state             = $request->more_info_state;
        $cmi->zip               = $request->more_info_zip;
        $cmi->profile_image     = $request->more_info_profile_image;
        $cmi->profile_id        = $request->profile_id;
        $cmi->server_key        = $request->server_key;
        $cmi->company_prefix    = $request->company_prefix;
        $cmi->account_type_id   = $request->account_type;
        $cmi->currency_id       = $request->more_info_currency;
        $cmi->company_profile   = $request->company_profile;
        // $cmi->packages_id       = $request->package;
        $cmi->branded_pay_1     = ($request->branded_pay_page == 'true' ? '1' : ($request->branded_pay_page == 'false' ? '0' : '') );
        $cmi->branded_pay_2     = ($request->branded_email == 'true' ? '1' : ($request->branded_email == 'false' ? '0' : '') ); 
        $cmi->withdraw_limit    = (isset($request->withdraw_limit) ? $request->withdraw_limit : 0);
        $cmi->available_limit   = (isset($request->available_limit) ? $request->available_limit : 0);
        $cmi->sender_id         = $request->sender_id_by_name;
        $cmi->api_key           = $request->api_key;
        $cmi->sms_limit         = $request->sms_limit;
        $cmi->save();
    

        $cs = CompanySubscription::where('organisation_id',$request->company_id)->first();;  
        $cs->organisation_id        =   $organisation->id;
        $cs->billing_plan           =   $request->billing_plan;
        $cs->add_on_charge          =   $request->add_on_charge;
        $cs->diposit                =   $request->deposit;
        $cs->convenience_type       =   $request->convenience_fees_type;
        $cs->convenience_amount     =   $request->convenience_amount;
        $cs->commission_type        =   $request->commision_fees_type;
        $cs->commission_amount      =   $request->commission_amount;
        $cs->withdrawal_type        =   $request->withdrawal_charge_add;
        $cs->withdrawal_amount      =   $request->withdrawal_charge_amt;
        $cs->payment_gateway        =   $request->payment_gateway_charge;
        $cs->payement_gateway_amount    =   $request->payement_gateway_amount;
        $cs->first_billing_date     =   $request->first_billing_date;
        $cs->end_billing_date       =   $request->end_billing_date;
        $cs->auto_renewal           =   ($request->auto_renewal == 'on' ? '1' : ($request->auto_renewal == 'false' ? '0' : ''));
        $cs->description            =   $request->description;
        $cs->include_description    =   ($request->desc_in_invoice == 'on' ? '1' : ($request->desc_in_invoice == 'false' ? '0' : ''));
        $cs->currency               =   $request->subs_currency;
        // $cs->vat                    =   $request->subs_vat;
        // $cs->other                  =   $request->subs_other;
        $cs->term_condition         =   $request->subs_term_cond;

        $cs->payout_setup     =   $request->payout_setup;
        $cs->time_cycle     =   $request->time_cycle;
        $cs->payout_day     =   $request->payout_day;

        $cs->save();


        // Saving permission module and sub module data,

        $menus = explode(',',$request->menu);
        $smenus = explode(',',$request->smenu);
        $sub_menus = explode(',',$request->sub_menu);

        // OrganisationMenu::where('organisation_id',$request->company_id)->delete();
        DB::table('organisation_menus')->where('organisation_id',$request->company_id)->delete();
        // OrganisationSubMenu::where('organisation_id',$request->company_id)->delete();
        DB::table('organisation_sub_menus')->where('organisation_id',$request->company_id)->delete();

        foreach($menus as $menu){

            $org_menu                   = new OrganisationMenu;
            $org_menu->organisation_id  = $organisation->id;
            $org_menu->admin_menu_id    = $menu;
            $org_menu->save();
        }

        foreach($smenus as $key => $smenu){

            $org_sub_menu                       = new OrganisationSubMenu;
            $org_sub_menu->organisation_id      = $organisation->id;
            $org_sub_menu->organisation_menu_id = $smenu;
            $org_sub_menu->admin_sub_menu_id    = $sub_menus[$key];
            $org_sub_menu->save();
        }


        DB::commit();
        return ajax_response(true, $organisation, [], "Company updated successfully!", $this->success);

    } catch (\Exception $e) {
        DB::rollback();
        $message = $e->getMessage();
        return ajax_response(false, [], [], $message, $this->internal_server_error);
    } catch (\Throwable $e) {
        DB::rollback();
        $message = $e->getMessage();
        return ajax_response(false, [], [], $message, $this->internal_server_error);
    }




    }


    public function documentDelete(Request $request) {

        $data = CompanyKYC::where('id',$request->id)->first();

        if($request->document_name == 'ow_document1')
        {
            unlink(public_path('/company/docs/') . $data->ow_document1);
            $data->ow_document1= null;
            $data->ow_doc_type1= null;

        }
        elseif($request->document_name == 'ow_document2')
        {
            unlink(public_path('/company/docs/') . $data->ow_document2);
            $data->ow_document2= null;
            $data->ow_doc_type2= null;
        }
        elseif($request->document_name == 'ow_document3')
        {
            unlink(public_path('/company/docs/') . $data->ow_document3);
            $data->ow_document3= null;
            $data->ow_doc_type3= null;
        }
        elseif($request->document_name == 'ow_document4')
        {
            unlink(public_path('/company/docs/') . $data->ow_document4); 
            $data->ow_document4= null;
            $data->ow_doc_type4= null;
        }
        elseif($request->document_name == 'bu_document1')
        {
            unlink(public_path('/company/docs/') . $data->bu_document1);
            $data->bu_document1= null;
            $data->bu_doc_type1= null;
        }
        elseif($request->document_name == 'bu_document2')
        {
            unlink(public_path('/company/docs/') . $data->bu_document2);
            $data->bu_document2= null;
            $data->bu_doc_type2= null;
        }
        elseif($request->document_name == 'bu_document3')
        {
            unlink(public_path('/company/docs/') . $data->bu_document3);
            $data->bu_document3= null;
            $data->bu_doc_type3= null;
        }
        elseif($request->document_name == 'bu_document4')
        {
            unlink(public_path('/company/docs/') . $data->bu_document4);
            $data->bu_document4= null;
            $data->bu_doc_type4= null;
        }
        elseif($request->document_name == 'bu_document5')
        {
            unlink(public_path('/company/docs/') . $data->bu_document5);
            $data->bu_document5= null;
            $data->bu_doc_type5= null;
        }
        elseif($request->document_name == 'ot_document1')
        {
            unlink(public_path('/company/docs/') . $data->ot_document1);
            $data->ot_document1= null;
            $data->ot_doc_type1= null;
        }
        elseif($request->document_name == 'ot_document2')
        {
            unlink(public_path('/company/docs/') . $data->ot_document2);
            $data->ot_document2= null;
            $data->ot_doc_type2= null;
        }
        elseif($request->document_name == 'ot_document3')
        {
            unlink(public_path('/company/docs/') . $data->ot_document3);
            $data->ot_document3= null;
            $data->ot_doc_type3= null;
        }
        elseif($request->document_name == 'ot_document4')
        {
            unlink(public_path('/company/docs/') . $data->ot_document4);
            $data->ot_document4= null;
            $data->ot_doc_type4= null;
        }

        $data->save();
        return 'true';


    }

    public function delete($id)
    {

        $now = Carbon::now();

        $org = Organisation::where('id', $id)->delete();    
        $user = DB::table('users')->where('organisation_id', $id)->update(['deleted_at' => $now]);      
        $compBank = DB::table('company_banks')->where('organisation_id', $id)->update(['deleted_at' => $now]);

        $compKYC = DB::table('company_k_y_c_s')->where('organisation_id', $id)->update(['deleted_at' => $now]);
        $compMI = DB::table('company_more_information')->where('organisation_id', $id)->update(['deleted_at' => $now]);
        $compSubs = DB::table('company_subscriptions')->where('organisation_id', $id)->update(['deleted_at' => $now]);

        return ajax_response(true, [], [], "Company Deleted Successfully", $this->success);
    }

    //Edit Bank
    public function update_bank(Request $request)
    {
        //Validating the rquest params for better security
        // $validator = Validator::make($request->all(), [
        //     'bank_name' => 'required',
        //     'bic' => 'required',
        //     'account_name' => 'required',
        //     'iban' => 'required',
        //     'account_no' => 'required',
        //     'currency' => 'required',
        //     'status' => 'required',
        // ]);
        // if($validator->fails()) return 'Cyber';


        //CHECKING IBAN ALREADY EXISTS OR NOT
        // $checkIBAN = Bank::where(['iban' => $request->iban])->first();
        // if(!is_null($checkIBAN))
        // {
        //     if($checkIBAN->id != $request->id) return 'iban';
        // }

        //Updating bank here
        $bank = CompanyBank::find($request->id);
        $bank->bank_name = $request->bank_name;
        $bank->bic_code = $request->bic;
        $bank->account_name = $request->account_name;
        $bank->iban_code = $request->iban;
        $bank->account_no = $request->account_no;
        $bank->currency_id = $request->currency;
        $bank->status = $request->status;

        $bank->update();

        return "true";
    }


    public function delete_bank(Request $request)
    {
        CompanyBank::where('id', $request->id)->delete();

        return 'true';
    }

    public function reason_mail($data_id,$checked,$id,$reason)
    {
       
        $doc1 = Document::select('*')->where('organisation_id',$id)->first();
      
        if(!$doc1){
           $doc1  =new Document;

        }

        DB::beginTransaction();
        try {
            if($checked==1)
             {
                  $doc1->ow_doc_type1_reason     =$reason;
                  $doc1->ow_doc_type1_status         =$data_id;
             }
             elseif($checked==2)
             {
                  $doc1->ow_doc_type2_reason     =$reason;
                  $doc1->ow_doc_type2_status         =$data_id;
             }
             elseif($checked==3)
             {
                  $doc1->ow_doc_type3_reason     =$reason;
                  $doc1->ow_doc_type3_status         =$data_id;
             }
             elseif($checked==4)
             {
                  $doc1->ow_doc_type4_reason     =$reason;
                  $doc1->ow_doc_type4_status         =$data_id;
             } 
             
             $doc1->save();
 
             $datas =Document::select('*')->where('organisation_id',$id)->first();

            // $datas =Document::select('documents.*','company_k_y_c_s.ow_doc_type1','company_k_y_c_s.ow_doc_type2','company_k_y_c_s.ow_doc_type3','company_k_y_c_s.ow_doc_type4')
            //  ->leftjoin('company_k_y_c_s as company_k_y_c_s', function ($join) {
            //     $join->on('company_k_y_c_s.organisation_id', '=', 'documents.organisation_id');
            //  })
            //  ->where('documents.organisation_id',$id)->first();
            
           
            //  if($checked==1)
            //  {
            //     if($datas->ow_doc_type1 == 1){
            //         $type='Passport ID';
            //   }
            //  }
            //  elseif($checked==2)
            //  {
            //     if($datas->ow_doc_type1 == 2){
            //         $type='Resident ID'; 
            //   }
            //  }
            //  elseif($checked==3)
            //  {
            //     if($datas->ow_doc_type1 == 3){
            //         $type='License ID'; 
            //    }
            //  }
            //  elseif($checked==4)
            //  {
            //     if($datas->ow_doc_type1 == 4){
            //         $type='Other'; 
                    
            //     }
               
            //  } 

           
             $get_customer = User::where('organisation_id', $datas->organisation_id)->first();
           
            $data = array(
                'dear'         => 'Dear',
                'msg'          => 'Your document was rejected due to',
                'resean'       =>  $reason,
                'dot'          =>  '.',
                'name'         =>  $get_customer->fullname,
                'email'        =>  $get_customer->email,
                'mobile'       =>  $get_customer->mobile,
                
            );
             Mail::mailer('smtp2')->to($get_customer->email)->send(new RejectMail($data));
           
            // Mail::to($get_customer->email)->send(new RejectMail($data));
            
            DB::commit();
               return ajax_response(true, $doc1, [], "  Saved Successfully", $this->success);
 
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        } catch (\Throwable $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        }
    }

    public function aprroved_store($data_id,$checked,$id,$value,$date)
    {
            
        $doc1       =Document::select('*')->where('organisation_id',$id)->first();
       
        if(!$doc1){
           $doc1       =new Document;
         
        }
          

        DB::beginTransaction();
        try {
            if($date!="null"){
            if($checked==1){ 
                  $doc1->ow_doc_type1_status         =$data_id;
                  $doc1->ow_doc_type1_expiry         =$value;
                  $doc1->ow_doc_type1_expiry_date    =$date;
             }elseif($checked==2){
                  $doc1->ow_doc_type2_status         =$data_id;
                  $doc1->ow_doc_type2_expiry         =$value;
                  $doc1->ow_doc_type2_expiry_date    =$date;
             }elseif($checked==3){
                  $doc1->ow_doc_type3_status         =$data_id;
                  $doc1->ow_doc_type3_expiry         =$value;
                  $doc1->ow_doc_type3_expiry_date    =$date;
                 
             }elseif($checked==4){
                  $doc1->ow_doc_type4_status         =$data_id;
                  $doc1->ow_doc_type4_expiry         =$value;
                  $doc1->ow_doc_type4_expiry_date    =$date;
                  
              }
            }else{
                if($checked==1){ 
                    $doc1->ow_doc_type1_status         =$data_id;
                    $doc1->ow_doc_type1_expiry         =$value;
                    $doc1->ow_doc_type1_expiry_date    =null;
               }elseif($checked==2){
                    $doc1->ow_doc_type2_status         =$data_id;
                    $doc1->ow_doc_type2_expiry         =$value;
                    $doc1->ow_doc_type2_expiry_date    =null;
               }elseif($checked==3){
                    $doc1->ow_doc_type3_status         =$data_id;
                    $doc1->ow_doc_type3_expiry         =$value;
                    $doc1->ow_doc_type3_expiry_date    =null;
                   
               }elseif($checked==4){
                    $doc1->ow_doc_type4_status         =$data_id;
                    $doc1->ow_doc_type4_expiry         =$value;
                    $doc1->ow_doc_type4_expiry_date    =null;
                    
                }
            }
              //dd($doc1);  
           $doc1->save();
 
            DB::commit();
               return ajax_response(true, $doc1, [], "  Saved Successfully", $this->success);
 
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        } catch (\Throwable $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        }
    }

    public function reason_mail1($data_id,$checked,$id,$reason)
    {
       
        $doc1 = Document::select('*')->where('organisation_id',$id)->first();
      
        if(!$doc1){
           $doc1  =new Document;

        }

        DB::beginTransaction();
        try {
            if($checked==1)
             {
                  $doc1->bu_doc_type1_reason     =$reason;
                  $doc1->bu_doc_type1_status         =$data_id;

             }
             elseif($checked==2)
             {
                  $doc1->bu_doc_type2_reason     =$reason;
                  $doc1->bu_doc_type2_status         =$data_id;

             }
             elseif($checked==3)
             {
                  $doc1->bu_doc_type3_reason     =$reason;
                  $doc1->bu_doc_type3_status         =$data_id;

             }
             elseif($checked==4)
             {
                  $doc1->bu_doc_type4_reason     =$reason;
                  $doc1->bu_doc_type4_status         =$data_id;

             }
             elseif($checked==5)
             {
                  $doc1->bu_doc_type5_reason     =$reason;
                  $doc1->bu_doc_type5_status         =$data_id;

             } 
             
             $doc1->save();
 
             $datas =Document::select('*')->where('organisation_id',$id)->first();
 
             $get_customer = User::where('organisation_id', $datas->organisation_id)->first();
           
            $data = array(
                'dear'         => 'Dear',
                'msg'          => 'Your document was rejected due to',
                'resean'       =>  $reason,
                'dot'          =>  '.',
                'name'         =>  $get_customer->fullname,
                'email'        =>  $get_customer->email,
                'mobile'       =>  $get_customer->mobile,
                
            );
            Mail::mailer('smtp2')->to($get_customer->email)->send(new RejectMail($data));
           
            // Mail::to($get_customer->email)->send(new RejectMail($data));
            
            DB::commit();
               return ajax_response(true, $doc1, [], "  Saved Successfully", $this->success);
 
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        } catch (\Throwable $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        }
    }


    public function rejected_store($data_id,$checked,$id,$value,$date)
    {
        
        $doc1       =Document::select('*')->where('organisation_id',$id)->first();
        
        if(!$doc1){
           $doc1       =new Document;

        }

        DB::beginTransaction();
        try {
            if($date!='null'){
                if($checked==1)
                {
                      $doc1->bu_doc_type1_status         =$data_id;
                      $doc1->bu_doc_type1_expiry         =$value;
                      $doc1->bu_doc_type1_expiry_date    =$date;
                 }
                 elseif($checked==2)
                 {
                      $doc1->bu_doc_type2_status         =$data_id;
                      $doc1->bu_doc_type2_expiry         =$value; 
                      $doc1->bu_doc_type2_expiry_date    =$date;
                 }
                 elseif($checked==3)
                 {
                      $doc1->bu_doc_type3_status         =$data_id;
                      $doc1->bu_doc_type3_expiry         =$value;
                      $doc1->bu_doc_type3_expiry_date    =$date;
                 }
                 elseif($checked==4)
                 {
                      $doc1->bu_doc_type4_status         =$data_id;
                      $doc1->bu_doc_type4_expiry         =$value;
                      $doc1->bu_doc_type4_expiry_date    =$date;
                 }
                 elseif($checked==5)
                 {
                      $doc1->bu_doc_type5_status         =$data_id;
                      $doc1->bu_doc_type5_expiry         =$value;
                      $doc1->bu_doc_type5_expiry_date    =$date;
                 }
            }
            else{
            if($checked==1)
            {
                  $doc1->bu_doc_type1_status         =$data_id;
                  $doc1->bu_doc_type1_expiry         =$value;
                  $doc1->bu_doc_type1_expiry_date    =null;
             }
             elseif($checked==2)
             {
                  $doc1->bu_doc_type2_status         =$data_id;
                  $doc1->bu_doc_type2_expiry         =$value; 
                  $doc1->bu_doc_type2_expiry_date    =null;
             }
             elseif($checked==3)
             {
                  $doc1->bu_doc_type3_status         =$data_id;
                  $doc1->bu_doc_type3_expiry         =$value;
                  $doc1->bu_doc_type3_expiry_date    =null;
             }
             elseif($checked==4)
             {
                  $doc1->bu_doc_type4_status         =$data_id;
                  $doc1->bu_doc_type4_expiry         =$value;
                  $doc1->bu_doc_type4_expiry_date    =null;
             }
             elseif($checked==5)
             {
                  $doc1->bu_doc_type5_status         =$data_id;
                  $doc1->bu_doc_type5_expiry         =$value;
                  $doc1->bu_doc_type5_expiry_date    =null;
             }
            }
           $doc1->save();
 
            DB::commit();
               return ajax_response(true, $doc1, [], "  Saved Successfully", $this->success);
 
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        } catch (\Throwable $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        }
    }

    public function reason_mail2($data_id,$checked,$id,$reason)
    {
       
        $doc1 = Document::select('*')->where('organisation_id',$id)->first();
      
        if(!$doc1){
           $doc1  =new Document;

        }

        DB::beginTransaction();
        try {
            if($checked==1)
             {
                  $doc1->ot_doc_type1_reason         =$reason;
                  $doc1->ot_doc_type1_status         =$data_id;

             }
             elseif($checked==2)
             {
                  $doc1->ot_doc_type2_reason         =$reason;
                  $doc1->ot_doc_type2_status         =$data_id;

             }
             elseif($checked==3)
             {
                  $doc1->ot_doc_type3_reason         =$reason;
                  $doc1->ot_doc_type3_status         =$data_id;

             }
             elseif($checked==4)
             {
                  $doc1->ot_doc_type4_reason         =$reason;
                  $doc1->ot_doc_type4_status         =$data_id;

             } 
             
             $doc1->save();
 
             $datas =Document::select('*')->where('organisation_id',$id)->first();
             
             $get_customer = User::where('organisation_id', $datas->organisation_id)->first();
            
            $data = array(
                'dear'         => 'Dear',
                'msg'          => 'Your document was rejected due to',
                'resean'       =>  $reason,
                'dot'          =>  '.',
                'name'         =>  $get_customer->fullname,
                'email'        =>  $get_customer->email,
                'mobile'       =>  $get_customer->mobile,
                
            );
            Mail::mailer('smtp2')->to($get_customer->email)->send(new RejectMail($data));
             
            // Mail::to($get_customer->email)->send(new RejectMail($data));
            
            DB::commit();
               return ajax_response(true, $doc1, [], "  Saved Successfully", $this->success);
 
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        } catch (\Throwable $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        }
    }

    public function aprrov_store($data_id,$checked,$id,$value,$date)
    {
       
        $doc1       =Document::select('*')->where('organisation_id',$id)->first();
      
        if(!$doc1){
           $doc1       =new Document;

        }

        DB::beginTransaction();
        try {
             if($date!='null'){
                if($checked==1){
                    $doc1->ot_doc_type1_status         =$data_id;
                    $doc1->ot_doc_type1_expiry         =$value;
                    $doc1->ot_doc_type1_expiry_date    =$date;
                  
               }elseif($checked==2){
                    $doc1->ot_doc_type2_status         =$data_id;
                    $doc1->ot_doc_type2_expiry         =$value;
                    $doc1->ot_doc_type2_expiry_date    =$date;
                    
               }elseif($checked==3){
                    $doc1->ot_doc_type3_status         =$data_id;
                    $doc1->ot_doc_type3_expiry         =$value;
                    $doc1->ot_doc_type3_expiry_date    =$date;
               }elseif($checked==4){
                    $doc1->ot_doc_type4_status         =$data_id;
                    $doc1->ot_doc_type4_expiry         =$value;
                    $doc1->ot_doc_type4_expiry_date    =$date;
                }
             }
             else{
            if($checked==1){
                  $doc1->ot_doc_type1_status         =$data_id;
                  $doc1->ot_doc_type1_expiry         =$value;
                  $doc1->ot_doc_type1_expiry_date    =null;
                
             }elseif($checked==2){
                  $doc1->ot_doc_type2_status         =$data_id;
                  $doc1->ot_doc_type2_expiry         =$value;
                  $doc1->ot_doc_type2_expiry_date    =null;
                  
             }elseif($checked==3){
                  $doc1->ot_doc_type3_status         =$data_id;
                  $doc1->ot_doc_type3_expiry         =$value;
                  $doc1->ot_doc_type3_expiry_date    =null;
             }elseif($checked==4){
                  $doc1->ot_doc_type4_status         =$data_id;
                  $doc1->ot_doc_type4_expiry         =$value;
                  $doc1->ot_doc_type4_expiry_date    =null;
              }
            }
           $doc1->save();
 
            DB::commit();
               return ajax_response(true, $doc1, [], "  Saved Successfully", $this->success);
 
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        } catch (\Throwable $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        }
    }

    public function bank_check_store($bank,$id)
    {
       
         $bank_id       =CompanyBank::select('*')->where('id',$id)->first();
        
        if(!$bank_id){
           $bank_id       =new CompanyBank;

        }

        DB::beginTransaction();
        try {
            if($bank==1){
                  $bank_id->status    =$bank;
             }elseif($bank==2){
                  $bank_id->status    =$bank;
             }   
            
           $bank_id->save();
 
            DB::commit();
               return ajax_response(true, $bank_id, [], "  Saved Successfully", $this->success);
 
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        } catch (\Throwable $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        }
    }

    public function bank_check_store_reason($bank,$id,$reason)
    {
        
        $bank_id =CompanyBank::select('*')->where('id',$id)->first();
     
        if(!$bank_id){
            $bank_id       =new CompanyBank;

        }  

        DB::beginTransaction();
        try {
             
                $bank_id->reason  =   $reason;
                $bank_id->status  =   $bank;
            
                $bank_id->save();

                $datas =CompanyBank::select('*')->where('id',$bank_id->id)->first();
            
                $get_customer = User::where('organisation_id',$datas->organisation_id)->first();
                   
                $data = array(
                     'dear'         => 'Dear',
                     'msg'          => 'Your bank rejected due to',
                     'resean'       =>  $reason,
                     'dot'          =>  '.',
                     'name'         =>  $get_customer->fullname,
                     'email'        =>  $get_customer->email,
                     'mobile'       =>  $get_customer->mobile,
                     'bank_name'       =>  $datas->bank_name,
                     'account_name'       =>  $datas->account_name,
                     'account_no'       =>  $datas->account_no,
                     
                 );  
               Mail::mailer('smtp2')->to($get_customer->email)->send(new BankRejectMail($data));
                
                //  Mail::to($get_customer->email)->send(new BankRejectMail($data));
 
            DB::commit();
               return ajax_response(true, $bank_id, [], "  Saved Successfully", $this->success);
 
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        } catch (\Throwable $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        }
    }


    public function subscription_plan_details($id){

        $alldata[] = "";
        $data = SubscriptionPlans::find($id);
        $Subscriptionmenus = Subscription_module::where('subcription_id',$data->id)->get();
        $Subscriptionsubmenus = Subscription_submodule::where('subcription_id',$data->id)->get();
        $menus = AdminMenu::with('sub_menu')->get();
        $inserted_menu = array();
        $inserted_subMenu = array();

        foreach($Subscriptionmenus as $set_menu){
            $inserted_menu[] = $set_menu->admin_menu_id;

        }
       
        foreach($Subscriptionsubmenus as $set_sub_menu){

            $inserted_subMenu[] = $set_sub_menu->admin_sub_menu_id;
        }
        $alldata[] = ["menus"=>$menus ,"data"=>$data,"inserted_menu"=>$inserted_menu,"inserted_subMenu"=>$inserted_subMenu];

       return json_encode($alldata);
    }


    public function virtual_contract($company_id) {

        

        $company = Organisation::select('*')->with('kycDetailStatus')->where('uuid',$company_id)->first();

        return view('virtual-contract.contract', compact('company'));

        // $totalDoc=0;
        // $noAction=0;
        // $approve=0;
        // $rejected=0;


        // if($company->kycDetailStatus->ow_doc_type1_status != null){ 
        //     $totalDoc++; 

        //     if($company->kycDetailStatus->ow_doc_type1_status == 0){ $noAction++; }

        //     if($company->kycDetailStatus->ow_doc_type1_status == 1){ $approve++; }
                    
        //     if($company->kycDetailStatus->ow_doc_type1_status == 2){ $rejected++; }

        // }

        // if($company->kycDetailStatus->ow_doc_type2_status != null){ 
        //     $totalDoc++; 

        //     if($company->kycDetailStatus->ow_doc_type2_status == 0){ $noAction++; }

        //     if($company->kycDetailStatus->ow_doc_type2_status == 1){ $approve++; }
                    
        //     if($company->kycDetailStatus->ow_doc_type2_status == 2){ $rejected++; }

        // }

        // if($company->kycDetailStatus->ow_doc_type3_status != null){ 
        //     $totalDoc++; 

        //     if($company->kycDetailStatus->ow_doc_type3_status == 0){ $noAction++; }

        //     if($company->kycDetailStatus->ow_doc_type3_status == 1){ $approve++; }
                    
        //     if($company->kycDetailStatus->ow_doc_type3_status == 2){ $rejected++; }

        // }

        // if($company->kycDetailStatus->ow_doc_type4_status != null){ 
        //     $totalDoc++; 

        //     if($company->kycDetailStatus->ow_doc_type4_status == 0){ $noAction++; }

        //     if($company->kycDetailStatus->ow_doc_type4_status == 1){ $approve++; }
                    
        //     if($company->kycDetailStatus->ow_doc_type4_status == 2){ $rejected++; }

        // }

        // if($company->kycDetailStatus->bu_doc_type1_status != null){ 
        //     $totalDoc++; 

        //     if($company->kycDetailStatus->bu_doc_type1_status == 0){ $noAction++; }

        //     if($company->kycDetailStatus->bu_doc_type1_status == 1){ $approve++; }
                    
        //     if($company->kycDetailStatus->bu_doc_type1_status == 2){ $rejected++; }

        // }

        // if($company->kycDetailStatus->bu_doc_type2_status != null){ 
        //     $totalDoc++; 

        //     if($company->kycDetailStatus->bu_doc_type2_status == 0){ $noAction++; }

        //     if($company->kycDetailStatus->bu_doc_type2_status == 1){ $approve++; }
                    
        //     if($company->kycDetailStatus->bu_doc_type2_status == 2){ $rejected++; }

        // }

        // if($company->kycDetailStatus->bu_doc_type3_status != null){ 
        //     $totalDoc++; 

        //     if($company->kycDetailStatus->bu_doc_type3_status == 0){ $noAction++; }

        //     if($company->kycDetailStatus->bu_doc_type3_status == 1){ $approve++; }
                    
        //     if($company->kycDetailStatus->bu_doc_type3_status == 2){ $rejected++; }

        // }

        // if($company->kycDetailStatus->bu_doc_type4_status != null){ 
        //     $totalDoc++; 

        //     if($company->kycDetailStatus->bu_doc_type4_status == 0){ $noAction++; }

        //     if($company->kycDetailStatus->bu_doc_type4_status == 1){ $approve++; }
                    
        //     if($company->kycDetailStatus->bu_doc_type4_status == 2){ $rejected++; }

        // }

        // if($company->kycDetailStatus->bu_doc_type5_status != null){ 
        //     $totalDoc++; 

        //     if($company->kycDetailStatus->bu_doc_type5_status == 0){ $noAction++; }

        //     if($company->kycDetailStatus->bu_doc_type5_status == 1){ $approve++; }
                    
        //     if($company->kycDetailStatus->bu_doc_type5_status == 2){ $rejected++; }

        // }

        // if($company->kycDetailStatus->ot_doc_type1_status != null){ 
        //     $totalDoc++; 

        //     if($company->kycDetailStatus->ot_doc_type1_status == 0){ $noAction++; }

        //     if($company->kycDetailStatus->ot_doc_type1_status == 1){ $approve++; }
                    
        //     if($company->kycDetailStatus->ot_doc_type1_status == 2){ $rejected++; }

        // }

        // if($company->kycDetailStatus->ot_doc_type2_status != null){ 
        //     $totalDoc++; 

        //     if($company->kycDetailStatus->ot_doc_type2_status == 0){ $noAction++; }

        //     if($company->kycDetailStatus->ot_doc_type2_status == 1){ $approve++; }
                    
        //     if($company->kycDetailStatus->ot_doc_type2_status == 2){ $rejected++; }

        // }

        // if($company->kycDetailStatus->ot_doc_type3_status != null){ 
        //     $totalDoc++; 

        //     if($company->kycDetailStatus->ot_doc_type3_status == 0){ $noAction++; }

        //     if($company->kycDetailStatus->ot_doc_type3_status == 1){ $approve++; }
                    
        //     if($company->kycDetailStatus->ot_doc_type3_status == 2){ $rejected++; }

        // }

        // if($company->kycDetailStatus->ot_doc_type4_status != null){ 
        //     $totalDoc++; 

        //     if($company->kycDetailStatus->ot_doc_type4_status == 0){ $noAction++; }

        //     if($company->kycDetailStatus->ot_doc_type4_status == 1){ $approve++; }
                    
        //     if($company->kycDetailStatus->ot_doc_type4_status == 2){ $rejected++; }

        // }

        // dd($totalDoc 3, $noAction 1, $approve 0, $rejected 2);


        // if($totalDoc == $approve) {

        //     return view('virtual-contract.contract', compact('company'));

        // }


        // if($rejected > 0) {

        //     return redirect(route('company-list'))->with('status',$rejected.' document for this company is rejected.');

        // } 
        
        // if($noAction > 0) {

        //     return redirect(route('company-list'))->with('status', $approve.' document is not approve yet.');

        // } 
        

        



    }


    public function otpsend($company_id)
    {
        // $company_id_decoded = base64_decode($request->get('company_id'));
        $company = Organisation::select('*')->with('moreInfo')->where('id',$company_id)->first();
        $phoneVerificationCode = rand(1000,9999);
        $company->agreement_otp = $phoneVerificationCode;
        $company->save();


        $phone = $company->org_contact_person_number;

        if(str_contains($company->org_contact_person_number, ' ')){

            $phone = str_replace(' ', '', $company->org_contact_person_number);

        }

        $messageText = "Your verification code for Rental360 is: " . $phoneVerificationCode;

        $smsApiKey = $company->moreInfo->api_key;


        $data=Http::get("http://www.elitbuzz-me.com/sms/smsapi?api_key=$smsApiKey&type=text&contacts=$phone&senderid=MyRide&msg=$messageText");
        
    }


    public function virtual_contract_store(Request $request) {
        
        $company = Organisation::find($request->company_id);

        if($request->agree_option == 'E-Signature'){
            if($request->signed == ""){
                return 1;  //Please write signature
            }

            $folderPath = public_path('/company/docs/signature_image/');
            $image_parts = explode(";base64,", $request->signed);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $signature = uniqid() . '.'.$image_type;
            $file = $folderPath . $signature;
            file_put_contents($file, $image_base64);

            $company->is_mobile_verified = 0;
            $company->mobile_otp = NULL;
            $company->agreement_otp = NULL;
            $company->agreement_status = 1;
            $company->signature = $signature;
            $company->org_status = 1;
            $company->ip_address = $request->ip();
            $company->save();

            return 2; //You have successfully agreed to our virtual agreement
        }else{
            if($request->otp == ""){
                return 3; //Please enter OTP
            }
            if($request->otp == $company->agreement_otp) {
                $company->is_mobile_verified = 1;
                $company->mobile_otp = NULL;
                $company->agreement_otp = NULL;
                $company->agreement_status = 1;
                $company->org_status = 1;
                $company->ip_address = $request->ip();
                $company->save();
                return 4; //You have successfully agreed to our virtual agreement
            } else {
                return 5; //You have entered an invalid OTP
            }
        }

    }


    public function aggrement_mail($uuid){

        $data = Organisation::select('*')->with('adminUser')->where('organisations.uuid',$uuid)->first();

            Mail::mailer('smtp2')->to($data->adminUser->email)->send(new AgreementMail($data));

            // Mail::to($data->adminUser->email)->send(new AgreementMail($data));

            return 'true';

    }

    public function mail_aggrement_link($uuid){

        $company = Organisation::select('*')->with('kycDetailStatus')->where('uuid',$uuid)->first();

        return view('mailvirtualcontract.contract', compact('company'));

    }

    // public function is_expiry($value,$date,$id,$checked)
    // {
        
    //     $doc1 =Document::select('*')->where('organisation_id',$id)->first();
       
    //     if(!$doc1){
    //        $doc1       =new Document;
         
    //     }
      
    //     DB::beginTransaction();
    //     try {
       
    //         if ($checked==1) {
    //             $doc1->ow_doc_type1_expiry         =$value;
    //             $doc1->ow_doc_type1_expiry_date    =$date;
    //         } elseif ($checked==2) {
    //             $doc1->ow_doc_type2_expiry         =$value;
    //             $doc1->ow_doc_type2_expiry_date    =$date;
    //         } elseif ($checked==3) {
    //             $doc1->ow_doc_type3_expiry         =$value;
    //             $doc1->ow_doc_type3_expiry_date    =$date;
    //         } elseif ($checked==4) {
    //             $doc1->ow_doc_type4_expiry         =$value;
    //             $doc1->ow_doc_type4_expiry_date    =$date;
    //         }
       
    //        $doc1->save();
 
    //         DB::commit();
    //            return ajax_response(true, $doc1, [], "  Saved Successfully", $this->success);
 
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         $message = $e->getMessage();
    //         return ajax_response(false, [], [], $message, $this->internal_server_error);
    //     } catch (\Throwable $e) {
    //         DB::rollback();
    //         $message = $e->getMessage();
    //         return ajax_response(false, [], [], $message, $this->internal_server_error);
    //     }
    // }

}
