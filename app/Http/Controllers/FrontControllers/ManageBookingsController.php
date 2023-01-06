<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Models\ManageBookings;
use App\Models\Customer;
use App\Models\User;
use App\Models\CountryMaster;   
use App\Models\Transaction;
use App\Models\BookingInvoice;
use App\Models\BookingInvoicedetails;
use App\Models\VehicleBrand;
use App\Models\Promotion;
use App\Models\Vehicle;
use App\Models\ReserveFleet;
use App\Models\AcountsPayment;
use App\Models\AmountTransaction;
use App\Models\Fleetdetails;
use App\Models\GeneralLedger;
use App\Models\OpeningBalance;
use App\Models\Organisation;
use App\Models\Notifications;
use App\Models\CompanyActivity;
use App\Models\Fleet;
use App\Mail\BookingMail;
use App\Models\VehicleModel;
use App\Models\ShortLink;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
// use Session;

class ManageBookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     /*   $org= org_details();
       pre($org->subscription->withdrawal_amount); */
        $pageConfigs = ['pageHeader' => false];

        $path = public_path() . '/data/manage-booking-json';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (file_exists($path . '/' . getUser()->organisation_id . '_manage-booking-list.json')) {
            \File::delete($path . '/' . getUser()->organisation_id . '_manage-booking-list.json');
        }

        if (!file_exists($path . '/' . getUser()->organisation_id . '_manage-booking-list.json')) {
            $user = $this->jsonCustomerList($request);

            $data = array('data' => $user);
            \File::put($path . '/' . getUser()->organisation_id . '_manage-booking-list.json', collect($data));
        }

        $path_set = public_path() . '/data/booking-calender-json';
 
        if (!file_exists($path_set)) {
            \File::makeDirectory($path_set, 0777, true, true);
        }

        if (file_exists($path_set . '/' . getUser()->organisation_id . '_booking-calender-list.json')) {
            \File::delete($path_set . '/' . getUser()->organisation_id . '_booking-calender-list.json');
        }

        if (!file_exists($path_set . '/' . getUser()->organisation_id . '_booking-calender-list.json')) {
            $user_set = $this->jsonCustomerList($request);
        
            $details = new Collection();
            foreach ($user_set as $key => $data) {

                $details->push([
                    "id"                 => $data->id,
                    "url"                => "",
                    "title"              => $data->name,
                    "start"              => $data->pickup_date_time,
                    "end"                => $data->dropoff_date_time,
                    "allDay"             =>  false,
                    "extendedProps"      => array('calendar' => "Bussiness"),

                ]);
            }


            $data_set = $details;

            \File::put($path_set . '/' . getUser()->organisation_id . '_booking-calender-list.json', collect($data_set));
        }

        $invoice_data   = BookingInvoice::where('is_adjust_invoice','=','0')->where('organisation_id', getUser()->organisation_id)->get();
       
        $orgs_name= Organisation::select('organisations.id','country_masters.name') 
          ->leftjoin('country_masters as country_masters', function ($join) {
             $join->on('country_masters.id', '=', 'organisations.org_country_id');
          })
        
           ->where('organisations.id','=',getUser()->organisation_id)
           ->first();

        return view('booking.managebooking.list', compact('invoice_data','orgs_name'));
    }


    private function jsonCustomerList($orders_query)
    {
        return ManageBookings::select(
            'manage_bookings.id',
            'manage_bookings.is_created_invoice',
            'manage_bookings.is_send_invoice',
            'manage_bookings.booking_code',
            'manage_bookings.driver_id',
            'manage_bookings.pickup_date_time',
            'manage_bookings.dropoff_date_time',
            'manage_bookings.pickup_address', 
            'manage_bookings.dropoff_address',
            'manage_bookings.uuid',
            'manage_bookings.payment_status  as  pay_status', 
            'manage_bookings.booking_status',
            'manage_bookings.payment_mode',
            'manage_bookings.amount',
            DB::raw("(SELECT SUM(cart_amount) FROM transactions WHERE transactions.booking_id=manage_bookings.id) as totalDeductions"),
            'manage_bookings.number_of_tavellers',
            'user.fullname as name',
            'user.mobile as mobile',
            'vehicle_brands.brand_name as vehicle',  
            'vehicle_models.model_name as model',  
            //'booking_invoices.uuid as invoice_uuid',
            'booking_invoices.short_link as short_link'
        )
            ->leftjoin('users as user', function ($join) {
                $join->on('user.id', '=', 'manage_bookings.customer_id');
            })
            ->leftjoin('vehicle_brands', function ($join) {
                $join->on('vehicle_brands.id', '=', 'manage_bookings.brand_id');  
            })
            ->leftjoin('vehicle_models', function ($join) {
                $join->on('vehicle_models.id', '=', 'manage_bookings.model_id');  
            })
            // ->leftjoin('transactions', function ($join) {
            //     $join->on('transactions.booking_id', '=', 'manage_bookings.id');
            // })
            ->leftjoin('booking_invoices', function ($join) {
                $join->on('booking_invoices.booking_id', '=', 'manage_bookings.id')->where('booking_invoices.document_type', '=', 'booking');
            })
            ->where('manage_bookings.organisation_id', getUser()->organisation_id)
            ->where('user.usertype', 2)
            ->where('booking_invoices.deleted_at', '=', null)
            ->orderBy('manage_bookings.id', 'desc')
            ->get();
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = User::select('id', 'fullname')->where('usertype',2)->where('deleted_at', '=', null)->get();
        $vehicle = VehicleBrand::select('vehicle_brands.id', 'vehicle_brands.brand_name')
                    ->leftjoin('fleets', function ($join) {
                        $join->on('fleets.brand_id', '=', 'vehicle_brands.id');
                    })
                    ->where('fleets.organisation_id', getUser()->organisation_id)
                    ->groupBy('fleets.brand_id')
                    ->get();
        $vehicleopen = VehicleBrand::select('id', 'brand_name')->get();
        $fleet = Fleet::select('id', 'car_SKU')->where('deleted_at', '=', null)->get();

        return view('booking.managebooking.create', compact('customer', 'vehicle', 'fleet','vehicleopen'));
    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function getting_merchant_sku($merchant_sku)
    {

        $org = getUser();

        $data_id = DB::table('fleets')->select('*')->where('car_SKU', $merchant_sku)->where('is_reserved', '=', '0')->where('organisation_id', '!=', $org->organisation_id)->where('deleted_at', '=', null)->first();

        $data['id']  = $data_id->id;
        $data['brand']  = $data_id->brand_id;
        $data['model']  = $data_id->model_id;
        // $data_model  = $data_id->model_id;  

        return ajax_response(true, $data, [], "Fleet Available", $this->success);
    }
    
    public function store(Request $request)
    {
             
          $created_user = getUser();
       
          $input = $request->all();
          $validate = $this->validations($input, "add");
        if ($validate["error"]) {

            return prepareResult(false, [], $validate['errors']->first(), "Error while validating booking", $this->unprocessableEntity);
        }
        
        DB::beginTransaction();
        try {
            
             $get_user = User::select('*')->where('mobile',$request->phone)->where('usertype','=',2)->first();
            if(!is_object($get_user)){

                        $new_user = new User;         
                        $new_user->fullname            = $request->select_customer_n;
                        $new_user->email               = $request->email;
                        $new_user->usertype            = 2;
                        $new_user->mobile              =  $request->phone;
                        $new_user->created_user        =  $created_user->id;
                        $new_user->api_token           = \Str::random(35);
                        $new_user->password            = \Hash::make('123456');
                        $new_user->save();
            
                        $new_customer = new Customer;
                        $new_customer->user_id             =  $new_user->id;
                        $new_customer->created_user        =  $created_user->id; 
                        $new_customer->save();
                   
               }else{
                    $new_user = User::find($get_user->id);
                    $new_user->fullname            = $request->select_customer_n;
                    $new_user->email               = $request->email;
                    $new_user->save();
                } 
                
                $data = new ManageBookings;
                $data->customer_id                  = $new_user->id;
                $data->pickup_date_time             = $request->pickup_date_time;
                $data->dropoff_date_time            = $request->drop_off_date_time;
                $data->pickup_time                  = $request->pickup_time;
                $data->dropoff_time                 = $request->drop_off_time;

            if ($request->inlineRadioOptions == '2') {
                $data->vehicle_id                   = $request->merchant_sku_id;
                $data->merchant_sku                 = $request->merchant_sku;
                $data->brand_id                     = $request->merchant_sku_brand;
                $data->model_id                     = $request->merchant_sku_model;
                $data->open_market_comment          = $request->open_comment;
            } else {
                $data->vehicle_id                   = $request->select_sku;
                $data->merchant_sku                 = $request->sku;
                $data->brand_id                     = $request->select_vehicle;
                $data->model_id                     = $request->select_model;
            }
                $data->driver_id                    = $request->select_driver;
                $data->number_of_tavellers          = $request->no_of_traveller;
                $data->pickup_address               = $request->origin;
                $data->dropoff_address              = $request->destination;
                $data->note                         = $request->note;
                $data->dispatch_type                = $request->inlineRadioOptions;
                $data->merchant_name                = $request->merchantName;
                $data->merchant_phone               = $request->merchantPhone;
                $data->payment_mode                 = $request->payment_mode;
                $data->organisation_id              = getUser()->organisation_id;
                $data->created_user                 = $created_user->id;
                $data->save();
            
            if($data){
                $notifications = new Notifications;
                $notifications->messages          = "Booking created by ".getUser()->fullname; 
                $notifications->read              = '0';
                $notifications->unread            = '1';
                $notifications->user_id           = getUser()->id;
                $notifications->organisation_id   = getUser()->organisation_id;
                $notifications->save();

                $adminactivity = new CompanyActivity;
                $adminactivity->messages          = 'Booking created by '.getUser()->fullname;
                $adminactivity->created_user           = getUser()->id;
                $adminactivity->organisation_id   = getUser()->organisation_id;
                $adminactivity->save();
               
           }
           
           $maildata= ManageBookings::with('customer')->where('manage_bookings.id',$data->id)->first();
        
           Mail::mailer('smtp2')->to($new_user->email)->send(new BookingMail($maildata));
            
            DB::commit();
             return ajax_response(true, $data, [], "Booking Saved Successfully", $this->success);
        }
         catch (\Exception $e)
          {
             DB::rollback();
             $message = $e->getMessage();
             return ajax_response(false, [], [], $message, $this->internal_server_error);
         }
    }
    public function createInvoice($uuid)
    {

                $uuid = $uuid;

                $booked             = ManageBookings::select('*')->where('uuid', $uuid)->first();
                $customer           = User::select('*')->where('id', $booked->customer_id)->first();
                $customer_details   = Customer::select('*')->where('user_id', $booked->customer_id)->first();
                $country            = CountryMaster::select('id', 'name')->get();
                $brand              = VehicleBrand::select('id', 'brand_name', 'description')->where('id', $booked->brand_id)->first();
                $brand_vehicle      = Vehicle::select('*')->where('id', $booked->model_id)->first();
                $sku                = Fleet::with('fleetDetails')->where('id', '=', $booked->vehicle_id)->get();
            
                $fleet_pricing = array();
                $fleet_pricing['hourly'] = 0;
                $fleet_pricing['daily'] = 0;
                $fleet_pricing['weekly'] = 0;
                $fleet_pricing['monthly'] = 0;
                $fleet_pricing['custom'] = 0;

                $fleet_vat['hourly'] = 0;
                $fleet_vat['daily'] = 0;
                $fleet_vat['weekly'] = 0;
                $fleet_vat['monthly'] = 0;
                $fleet_vat['custom'] = 0;

        foreach ($sku as $key => $sku_details)
         {
            if ($sku_details->fleetDetails)
             {
                foreach ($sku_details->fleetDetails as $key => $details)
                 {
                    if ($details->material == 1) 
                    {
                        $fleet_pricing['hourly'] = $details->unit_price;
                        $fleet_vat['hourly'] = $details->vat;
                    }
                    if ($details->material == 2)
                     {
                        $fleet_pricing['daily'] = $details->unit_price;
                        $fleet_vat['daily'] = $details->vat;
                    }
                    if ($details->material == 3) 
                    {
                        $fleet_pricing['weekly'] = $details->unit_price;
                        $fleet_vat['weekly'] = $details->vat;
                    }
                    if ($details->material == 4)
                     {
                        $fleet_pricing['monthly'] = $details->unit_price;
                        $fleet_vat['monthly'] = $details->vat;
                    }
                    if ($details->material == 5)
                     {
                        $fleet_pricing['custom'] = $details->unit_price;
                        $fleet_vat['custom'] = $details->vat;
                    }
                }
            }
        }


            $price = 0;
            $unitprice=0;
            $total=0;
            $vat=0;
            $period=0;

            $diffHour = (Carbon::parse($booked->dropoff_date_time))->diffInHours(Carbon::parse($booked->pickup_date_time));

        if ($diffHour > 24)
         {
            $diffDays = (int)($diffHour / 24);
            $diffHour = ($diffHour % 24);


            if ($diffDays >= 30)
             {
                $month = (int)($diffDays / 30);
                $remaining = $diffDays - 30;
                if($remaining>0)
                {
                    
                    $month_price  =  $fleet_pricing['monthly']*$month;
                    $price  = $fleet_pricing['monthly'] + $month_price;
                    $period=$month+1;

                }
                else
                {
                    $price  = $fleet_pricing['monthly']*$month;
                    $period = $month;
                }
                $total = $price + ($price * $fleet_vat['monthly']) / 100;
                $vat = $fleet_vat['monthly'];
                $unitprice=$fleet_pricing['monthly'];

            }
             else if ($diffDays >= 7)
              {

                $week = (int)($diffDays / 7);
                $remaining = ($diffDays % 7);
                if($remaining > 0)
                    {
                        $week_price  =  $fleet_pricing['weekly']*$week;
                       // $day         =  $fleet_pricing['daily']*$remaining;
                        $price       = $week_price+$fleet_pricing['weekly'];
                        $period=$week+1;

                    }
                    else
                    {
                        $price  = $fleet_pricing['weekly']*$week;
                        $period=$week;
                    }
                        $total = $price + ($price * $fleet_vat['weekly']) / 100;
                        $vat = $fleet_vat['weekly'];
                        $unitprice=$fleet_pricing['weekly'];
            }
             else if ($diffDays >= 1)
              {

                if($diffHour>0)
                {
                    $day    =  $fleet_pricing['daily']*$diffDays;
                    $price  =  $day+$fleet_pricing['daily'];
                    $period=$diffDays+1;
                }
                else
                {
                    $price  = $fleet_pricing['daily']*$diffDays;
                    $period=$diffDays;
                }
                    $total = $price + ($price * $fleet_vat['daily']) / 100;
                    $vat = $fleet_vat['daily'];
                    $unitprice=$fleet_pricing['daily'];
            }
        }
         else
          {
                $diffDays = 1;
                $period=1;
                $price    = $fleet_pricing['daily'] * $period;
                $unitprice = $fleet_pricing['daily'];  

                $total = $price + ($price * $fleet_vat['daily']) / 100;
                $vat = $fleet_vat['daily'];
          }

        /* End coded by pankaj */
         /* End coded by Akash */
           $invoice_code=BookingInvoice::select('id')->orderBy('id', 'DESC')->first();
           $code_data=0;
           $code=1000;
           if(isset($invoice_code)){
                $code_data =$code.''.$invoice_code->id;
                $code_data++;
                
           }else{
                 $code_data=$code.''.'1';
                
           }
          /* End coded by Akash */

        return view('booking.managebooking.createInvoice', compact('customer','vat','total','period','unitprice','uuid', 'customer_details', 'country', 'booked', 'brand', 'brand_vehicle', 'diffDays', 'diffHour', 'sku', 'price','code_data'));
    }

    public function editInvoice($uuid)
    {
        $uuid = $uuid;
        $booked             = ManageBookings::select('*')->where('uuid', $uuid)->first();
        $invoiceHeader      = BookingInvoice::select('booking_invoices.*','promotions.promotion_code')->where('booking_id', $booked->id)
                                ->leftjoin('promotions as promotions', function ($join) {
                                    $join->on('promotions.id', '=', 'booking_invoices.promotion_id');
                                })->first();

        if(!$invoiceHeader){
            return \Redirect::route('create_invoice', [$uuid]);
        }
       
        $invoiceDetail      = BookingInvoicedetails::select('*')->where('invoice_id', $invoiceHeader->id)->get();
        $customer           = User::select('*')->where('id', $booked->customer_id)->first();
        $customer_details   = Customer::select('*')->where('user_id', $booked->customer_id)->first();
        $country            = CountryMaster::select('id', 'name')->get();
        $brand              = VehicleBrand::select('id', 'brand_name', 'description')->where('id', $booked->brand_id)->first();
        $brand_vehicle      = Vehicle::select('*')->where('id', $booked->model_id)->first();
        $sku               = Fleet::with('fleetDetails')->where('id', '=', $booked->vehicle_id)->get();

        $fleet_pricing = array();
        $fleet_pricing['hourly'] = 0;
        $fleet_pricing['daily'] = 0;
        $fleet_pricing['weekly'] = 0;
        $fleet_pricing['monthly'] = 0;
        $fleet_pricing['custom'] = 0;
        $fleet_vat['hourly'] = 0;
        $fleet_vat['daily'] = 0;
        $fleet_vat['weekly'] = 0;
        $fleet_vat['monthly'] = 0;
        $fleet_vat['custom'] = 0;

        foreach ($sku as $key => $sku_details) {
            if ($sku_details->fleetDetails) {
                foreach ($sku_details->fleetDetails as $key => $details) {
                    if ($details->material == 1) {
                        $fleet_pricing['hourly'] = $details->unit_price;
                        $fleet_vat['hourly'] = $details->vat;
                    }
                    if ($details->material == 2) {
                        $fleet_pricing['daily'] = $details->unit_price;
                        $fleet_vat['daily'] = $details->vat;
                    }
                    if ($details->material == 3) {
                        $fleet_pricing['weekly'] = $details->unit_price;
                        $fleet_vat['weekly'] = $details->vat;
                    }
                    if ($details->material == 4) {
                        $fleet_pricing['monthly'] = $details->unit_price;
                        $fleet_vat['monthly'] = $details->vat;
                    }
                    if ($details->material == 5) {
                        $fleet_pricing['custom'] = $details->unit_price;
                        $fleet_vat['custom'] = $details->vat;
                    }
                }
            }
        }
        
        $price = 0;
        $unitprice=0;
        $total=0;
        $vat=0;
        $period=0;

        $diffHour = (Carbon::parse($booked->dropoff_date_time))->diffInHours(Carbon::parse($booked->pickup_date_time));

        if ($diffHour > 24) {
            $diffDays = (int)($diffHour / 24);
            $diffHour = ($diffHour % 24);


            if ($diffDays >= 30) {
                $month = (int)($diffDays / 30);
                $remaining = $diffDays - 30;
                if($remaining>0)
                {
                    
                    $month_price  =  $fleet_pricing['monthly']*$month;
                    $price  = $fleet_pricing['monthly'] + $month_price;
                    $period=$month+1;

                }else{
                    $price  = $fleet_pricing['monthly']*$month;
                    $period = $month;
                }
                $total = $price + ($price * $fleet_vat['monthly']) / 100;
                $vat = $fleet_vat['monthly'];
                $unitprice=$fleet_pricing['monthly'];

            } else if ($diffDays >= 7) {

                $week = (int)($diffDays / 7);
                $remaining = ($diffDays % 7);
                if($remaining > 0)
                    {
                        $week_price  =  $fleet_pricing['weekly']*$week;
                       // $day         =  $fleet_pricing['daily']*$remaining;
                        $price       = $week_price+$fleet_pricing['weekly'];
                        $period=$week+1;

                    }else{
                        $price  = $fleet_pricing['weekly']*$week;
                        $period=$week;
                    }
                    $total = $price + ($price * $fleet_vat['weekly']) / 100;
                    $vat = $fleet_vat['weekly'];
                    $unitprice=$fleet_pricing['weekly'];
            } else if ($diffDays >= 1) {

                if($diffHour>0)
                {
                    $day    =  $fleet_pricing['daily']*$diffDays;
                    $price  =  $day+$fleet_pricing['daily'];
                    $period=$diffDays+1;
                }else{
                    $price  = $fleet_pricing['daily']*$diffDays;
                    $period=$diffDays;
                }
                $total = $price + ($price * $fleet_vat['daily']) / 100;
                $vat = $fleet_vat['daily'];
                $unitprice=$fleet_pricing['daily'];
            }
        } else {
            $diffDays = 1;
            $period=1;
            $price    = $fleet_pricing['daily'] * $period;
            $unitprice = $fleet_pricing['daily'];  

            $total = $price + ($price * $fleet_vat['daily']) / 100;
            $vat = $fleet_vat['daily'];
        }

        return view('booking.managebooking.editInvoice', compact('customer','vat','total','period','unitprice','uuid', 'customer_details', 'country', 'booked', 'brand', 'brand_vehicle', 'diffDays', 'diffHour', 'sku', 'price', 'invoiceDetail', 'invoiceHeader'));
    }

    public function storeInvoice(Request $request)
    {
        $type = "Invoice";
        $created_user = getUser();
        $booking_id  = ManageBookings::select('*')->where('uuid', $request->booking_id)->first();

        $input = $request->all();
        $validate = $this->validationsInvoice($input, "add");

        if ($validate["error"]) {

            return prepareResult(false, [], $validate['errors']->first(), "Error while validating Invoice", $this->unprocessableEntity);
        }
         
        DB::beginTransaction();
        try {
            
          $inb =  BookingInvoice::where('booking_id', $booking_id->id)->where('booking_invoices.document_type','booking')->first();
         
             if(isset($inb->id) && ($request->document_type=='booking')){
                  BookingInvoice::where('booking_id', $booking_id->id)->where('booking_invoices.document_type', 'booking')->get();  
              }
                $booking = new BookingInvoice;
                $booking->booking_id             =  $booking_id->id;
                $booking->name                   =  $request->full_name;
                $booking->email                  =  $request->email;
                $booking->currency_type          =  $request->currency_type;
                $booking->transaction_type       =  $request->transaction_type;
                $booking->customer_ref           =  $request->customer_refrence;
                $booking->invoice_ref            =  $request->invoice_refrence;
                $booking->phone                  =  $request->phone;
                $booking->street                 =  $request->street;
                $booking->city                   =  $request->city;
                $booking->country                =  $request->country;
                $booking->state                  =  $request->state;
                // $booking->zip                    =  $request->zip;
                $booking->inv_description        =  $request->inv_description;
                $booking->subtotal               =  $request->subTotal;
                $booking->subtotal_discount      =  $request->footer_discount;
                $booking->promotion_id           =  $request->promotion_id;
                $booking->promotion_value        =  $request->footer_promotion;
                $booking->delivery_charge        =  $request->deliveryCharge;
                $booking->grand_total            =  $request->grandTotal;
                $booking->create_user            = $created_user->id;
                $booking->organisation_id        = getUser()->organisation_id;
                $booking->document_type          = $request->document_type;
                $invoice_saved = $booking->save();
             

            if ($request->grandTotal)
             {
                ManageBookings::where('id', $booking_id->id)->update(array('amount' => $request->grandTotal));
             }

                $mb = BookingInvoice::where('booking_id', $booking_id->id)->orderBy('id', 'DESC')->first();
            if ($request->transaction_type==2 || $request->transaction_type==3) {
                $short_link = new ShortLink;
                $short_link->user_id    = ($mb) ? $mb->customer_id : null;
                $short_link->other_id   = $booking->id;
                $short_link->short_code = (string) \Str::random(8);
                $short_link->type       = "Invoice";
                $short_link->save();

            if ($mb) {
                $mb->short_link = url('/', $short_link->short_code);
                $mb->save();
            }
          }
            if ($request->document_type == 'account' && $request->extend_date_time != null) {

                $booking_id =  ManageBookings::find($request->bookingid);
                $booking_id->extend_date = $request->extend_date_time;
                $booking_id->extend_time = $request->extend_time;
                $booking_id->save();
            }

            if (count($request->sku) > 0) {
                
                if(isset($inb->id) && ($request->document_type=='booking')){
                    BookingInvoicedetails::where('sku',$request->sku)->delete();  
                 }
 
                foreach ($request['sku'] as $key => $n) {
                   
                    $bookingDetails = new BookingInvoicedetails;
                    $bookingDetails->sku            = $request->sku[$key]; 
                    $bookingDetails->invoice_id     = $booking->id;
                    $bookingDetails->description    = $request->description[$key];
                    $bookingDetails->price          = $request->unit_price[$key];
                    $bookingDetails->period         = $request->quantity[$key];
                    $bookingDetails->discount       = $request->discount[$key];
                    $bookingDetails->tax            = $request->tax[$key];
                    $bookingDetails->total          = $request->total[$key];
                    $bookingDetails->create_user    = $created_user->id;
                    $bookingDetails->save();
                }
            }

            if ($invoice_saved) {
                ManageBookings::where('id', $booking_id->id)->update(array('is_created_invoice' => 1));
            }

            $adminactivity = new CompanyActivity;
            $adminactivity->messages          = 'Invoice created by '.getUser()->fullname;
            $adminactivity->created_user           = getUser()->id;
            $adminactivity->organisation_id   = getUser()->organisation_id;
            $adminactivity->save();

            $datas =ManageBookings::select('manage_bookings.*', 'booking_invoices.grand_total', 'booking_invoices.short_link', 'booking_invoices.email')
            ->leftjoin('booking_invoices', 'manage_bookings.id', '=', 'booking_invoices.booking_id')
            ->where('manage_bookings.id', $booking->booking_id)->first();
         
            if($datas->email!=""){
               
            $get_customer = User::where('id', $datas->customer_id)->first();
          
            $data = array(
                'dear'         => 'Dear',
                'msg'          => 'Please find below your payment link:',
                'amount_msg'   => 'Total Amount is :',
                'name'      =>  $get_customer->fullname,
                'email'      =>  $get_customer->email,
                'mobile'      =>  $get_customer->mobile,
                'amount'      =>  $datas->grand_total,
                'short_link'      =>  $datas->short_link,
            );
             
            //  Mail::mailer('smtp')->to($get_customer->email)->send(new SendMail($data));
             Mail::mailer('smtp1')->to($get_customer->email)->send(new SendMail($data));  
            //  Mail::mailer('smtp2')->to($get_customer->email)->send(new SendMail($data)); 
            }

            DB::commit();
            return ajax_response(true, $booking, [], "Invoice Saved Successfully", $this->success);
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        }
    }

    public function updateInvoice(Request $request)
    {
        $type = "Invoice";
        $booking_id  = ManageBookings::select('*')->where('uuid', $request->booking_id)->first();
        $created_user = getUser();
        $input = $request->all();
        $validate = $this->validationsInvoice($input, "add");

        if ($validate["error"])
         {

             return prepareResult(false, [], $validate['errors']->first(), "Error while validating Invoice", $this->unprocessableEntity);
         }

        DB::beginTransaction();
        try {
        
                $booking = BookingInvoice::where('id', $request->invoice_id)->first();

                $booking->booking_id             =  $booking_id->id;
                $booking->name                   =  $request->full_name;
                $booking->email                  =  $request->email;
                $booking->currency_type          =  $request->currency_type;
                $booking->transaction_type       =  $request->transaction_type;
                $booking->customer_ref           =  $request->customer_refrence;
                $booking->invoice_ref            =  $request->invoice_refrence;
                $booking->phone                  =  $request->phone;
                $booking->street                 =  $request->street;
                $booking->city                   =  $request->city;
                $booking->country                =  $request->country;
                $booking->state                  =  $request->state;
                $booking->zip                    =  $request->zip;
                $booking->inv_description        =  $request->inv_description;
                $booking->subtotal               =  $request->subTotal;
                $booking->subtotal_discount      =  $request->footer_discount;
                $booking->promotion_id           =  $request->promotion_id;
                $booking->promotion_value        =  $request->footer_promotion;
                $booking->delivery_charge        =  $request->deliveryCharge;
                $booking->grand_total            =  $request->grandTotal;
                $booking->updated_user           =  $created_user->id;
                $booking->document_type          =  $request->document_type;
                $booking->save();
         
            if ($request->grandTotal)
             {
                ManageBookings::where('id', $booking_id->id)->update(array('amount' => $request->grandTotal));
             }

            
             $booked = BookingInvoice::where('booking_id', $booking_id->id)->first();

            if ($request->transaction_type==2 || $request->transaction_type==3)
             {
                $short_link = new ShortLink;
                $short_link->user_id    =  ($booked) ? $booked->customer_id : null;
                $short_link->other_id   = $booking->id;
                $short_link->short_code = (string) \Str::random(8);
                $short_link->type       = "Invoice";
                $short_link->save();

            if ($booked)
             {
                $booked->short_link = url('/', $short_link->short_code);
                $booked->save();
             }
           } 

              $invoice_details = BookingInvoicedetails::where('invoice_id', $booking->id)->delete(); 
             
            if (count($request->sku) > 0)
             {
                foreach ($request['sku'] as $key => $n)
                 {

                    $bookingDetails = new BookingInvoicedetails;

                    $bookingDetails->sku            = $request->sku[$key];
                    $bookingDetails->invoice_id     = $request->invoice_id;
                    $bookingDetails->description    = $request->description[$key];
                    $bookingDetails->price          = $request->unit_price[$key];
                    $bookingDetails->period         = $request->quantity[$key];
                    $bookingDetails->discount       = $request->discount[$key];
                    $bookingDetails->tax            = $request->tax[$key];
                    $bookingDetails->total          = $request->total[$key]; 
                    $bookingDetails->updated_user   = $created_user->id;
                    $bookingDetails->save();
                }
             }

             $adminactivity = new CompanyActivity;
             $adminactivity->messages          = 'Invoice created by '.getUser()->fullname;
             $adminactivity->created_user           = getUser()->id;
             $adminactivity->organisation_id   = getUser()->organisation_id;
             $adminactivity->save();

             $datas =ManageBookings::select('manage_bookings.*', 'booking_invoices.grand_total', 'booking_invoices.short_link', 'booking_invoices.email')
             ->leftjoin('booking_invoices', 'manage_bookings.id', '=', 'booking_invoices.booking_id')
             ->where('manage_bookings.id', $booking->booking_id)->first();
          
             if($datas->email!=""){
                
             $get_customer = User::where('id', $datas->customer_id)->first();
            
             $data = array(
                 'dear'         => 'Dear',
                 'msg'          => 'Please find below your payment link:',
                 'amount_msg'   => 'Total Amount is :',
                 'name'      =>  $get_customer->fullname,
                 'email'      =>  $get_customer->email,
                 'mobile'      =>  $get_customer->mobile,
                 'amount'      =>  $datas->grand_total,
                 'short_link'      =>  $datas->short_link,
             );
             
            // Mail::mailer('smtp')->to($get_customer->email)->send(new SendMail($data));
            Mail::mailer('smtp1')->to($get_customer->email)->send(new SendMail($data));  
            // Mail::mailer('smtp2')->to($get_customer->email)->send(new SendMail($data)); 
             }

            DB::commit();
            return ajax_response(true, $booking, [], "Invoice Update Successfully", $this->success);
        } 
        catch (\Exception $e)
         {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManageBookings  $manageBookings
     * @return \Illuminate\Http\Response
     */
    public function show(ManageBookings $manageBookings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManageBookings  $manageBookings
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {

        $get_data = ManageBookings::select('manage_bookings.*')
            ->leftjoin('customers', 'manage_bookings.customer_id', '=', 'customers.id')
            ->leftjoin('vehicles', 'manage_bookings.vehicle_id', '=', 'vehicles.id')
            ->where('manage_bookings.uuid', $uuid)->first();
 
        $customer = User::select('id', 'fullname')->where('usertype', 2)->get();
       // $vehicle = VehicleBrand::select('id', 'brand_name')->where('id', $get_data->brand_id)->first();
        $model = VehicleModel::select('id', 'model_name')->get();
        $fleet = Fleet::select('id', 'car_SKU')->get();

        $vehicle = VehicleBrand::select('vehicle_brands.id', 'vehicle_brands.brand_name')
                    ->leftjoin('fleets', function ($join) {
                        $join->on('fleets.brand_id', '=', 'vehicle_brands.id');
                    })
                    ->where('fleets.organisation_id', getUser()->organisation_id)
                    ->groupBy('fleets.brand_id') 
                    ->get();

        $vehicleopen = VehicleBrand::select('id', 'brand_name')->get();
      //   $fleet = Fleet::select('id', 'car_SKU')->where('deleted_at', '=', null)->get();
       
        if ($get_data->customer_id != '' || $get_data->customer_id != null) 
         {
            $customer_details = User::select('*')->where('usertype', 2)->where('id', $get_data->customer_id)->get();
         }
         else
          {
            $customer_details = null;
          }

         return view('booking.managebooking.edit', compact('customer', 'vehicle', 'get_data', 'model', 'customer_details', 'fleet','vehicleopen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManageBookings  $manageBookings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageBookings $manageBookings)
    {
        //  dd($request);
            $created_user = getUser();
            $input = $request->all();
            $validate = $this->validations($input, "add");
        if ($validate["error"]) {

            return prepareResult(false, [], $validate['errors']->first(), "Error while validating booking", $this->unprocessableEntity);
        }

        DB::beginTransaction();
        try {
                $data =  ManageBookings::find($request->updated_id);
              
                $data->pickup_date_time             = $request->pickup_date_time;
                $data->dropoff_date_time            = $request->drop_off_date_time;
                $data->driver_id                    = $request->select_driver;
                $data->number_of_tavellers          = $request->no_of_traveller;
                $data->pickup_address               = $request->origin;
                $data->dropoff_address              = $request->destination;
                $data->note                         = $request->note;
                $data->updated_user                 = $created_user->id;
                $data->payment_mode                 = $request->payment_mode;
                if ($request->inlineRadioOptions == '2') {
                    $data->vehicle_id                   = $request->merchant_sku_id;
                    $data->merchant_sku                   = $request->merchant_sku;
                    $data->brand_id                     = $request->merchant_sku_brand;
                    $data->model_id                     = $request->merchant_sku_model;
                    $data->open_market_comment          = $request->open_comment;

                } else {
                    $data->vehicle_id                   = $request->select_sku;
                    $data->merchant_sku                   = $request->sku;
                    $data->brand_id                     = $request->select_vehicle;
                    $data->model_id                     = $request->select_model;
                }
                $data->save();

            if($data)
             {
                $notifications = new Notifications;
                $notifications->messages          = "Booking updated by ".getUser()->fullname; 
                $notifications->read              = '0';
                $notifications->unread            = '1';
                $notifications->user_id           = getUser()->id;
                $notifications->organisation_id   = getUser()->organisation_id;
                $notifications->save();
             }

             $adminactivity = new CompanyActivity;
             $adminactivity->messages          = 'Booking updated by '.getUser()->fullname;
             $adminactivity->created_user           = getUser()->id;
             $adminactivity->organisation_id   = getUser()->organisation_id;
             $adminactivity->save();

            DB::commit();
            return ajax_response(true, $data, [], "Booking Updated Successfully", $this->success);
        }
         catch (\Exception $e)
          {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManageBookings  $manageBookings
     * @return \Illuminate\Http\Response
     */

    public function cancel_booking($uuid)
    {
        ManageBookings::where('uuid', $uuid)->limit(1)->update(array('booking_status' => 3));

                $adminactivity = new CompanyActivity;
                $adminactivity->messages          = 'Booking cancel by '.getUser()->fullname;
                $adminactivity->created_user           = getUser()->id;
                $adminactivity->organisation_id   = getUser()->organisation_id;
                $adminactivity->save();

        return redirect('/manage-booking-list');
    }
    public function destroy($uuid)
    {
        $Bookings = ManageBookings::where('uuid', $uuid)->first();
        if (is_object($Bookings))
         {
            $Bookings->delete();

            $Bookings_inv_header = BookingInvoice::where('booking_id', $uuid)->first();

            $Bookings_inv_header->delete();
            $Bookings_inv_details = BookingInvoicedetails::where('invoice_id', $Bookings_inv_header->invoice_id)->get();
            foreach ($Bookings_inv_details as $Bookings_inv_detailss)
             {
                $Bookings_inv_detailss->delete();
             }

                 $adminactivity = new CompanyActivity;
                $adminactivity->messages          = 'Booking deleted by '.getUser()->fullname;
                $adminactivity->created_user           = getUser()->id;
                $adminactivity->organisation_id   = getUser()->organisation_id;
                $adminactivity->save();
        }
        return ajax_response(true, [], [], "Booking Deleted Successfully", $this->success);
    }


    public function get_model($brand, $model)
    {
        // dd($brand, $model);
        $return = array();
        $getdata = VehicleModel::select('vehicle_models.model_name', 'vehicle_models.id')
        ->leftjoin('fleets', function ($join) {
            $join->on('fleets.model_id', '=', 'vehicle_models.id');
        })
        ->where('fleets.organisation_id', getUser()->organisation_id)
        ->groupBy('fleets.model_id')

        ->where('vehicle_models.brand_id', '=', $brand)
        ->where('vehicle_models.status', '=', '1')
        ->get();

        

        $return['status'] = false;
        $return['html'] = '<option class="opt_v1" ></option>';
        if (count($getdata) > 0)
         {
            $select = "";
            foreach ($getdata as $model_name1)
             {
                $select="";
                if ($model_name1->id == $model)
                 {
                    $select = "selected";
                }

                $return['html'] .= '<option class="opt_v1" ' . $select . ' value="' . $model_name1->id . '">' . $model_name1->model_name;
                $return['html'] .= "</option>";
            }
            $return['status'] = true;
        }
         return response()->json($return);
    }
    public function get_marchantmodel($brand, $model)
    {
        // dd($brand, $model);
        $return = array();
        $getdata = VehicleModel::select('vehicle_models.model_name', 'vehicle_models.id')
        ->where('vehicle_models.brand_id', '=', $brand)
        ->where('vehicle_models.status', '=', '1')
        ->get();

        $return['status'] = false;
        $return['html'] = '<option class="opt_v1" ></option>';
        if (count($getdata) > 0)
         {
            $select = "";
            foreach ($getdata as $model_name1)
             {
                $select="";
                if ($model_name1->id == $model)
                 {
                    $select = "selected";
                }

                $return['html'] .= '<option class="opt_v1" ' . $select . ' value="' . $model_name1->id . '">' . $model_name1->model_name;
                $return['html'] .= "</option>";
            }
            $return['status'] = true;
        }
         return response()->json($return);
    }
    public function get_available_fleet($model, $fleet_id, $from, $to)
    {
       // dd($model, $fleet_id, $from, $to);
        $return = array();
        $getdata = Fleet::select('car_SKU', 'id', 'is_reserved','car_number')
        ->where('model_id', '=', $model)->where('status', '=', '1')->where('organisation_id',getUser()->organisation_id)->get();

        $final = array();
        $reserved = array();
        $from_reserved = array();

        foreach ($getdata as $key => $data)
         {
            if ($data->is_reserved == 1) 
            {

                $reserved[] = $data->id;
            } 
            else
             {
 
                $final[$key]['id'] = $data->id;
                $final[$key]['car_SKU'] = $data->car_SKU;
               // $final[$key]['car_number'] = $data->car_number;
             }
         }

       
         
        foreach ($reserved as $key => $data) 
        {
                  
            $reserve_from_from = ReserveFleet::Where('fleet_id', $data)->whereDate('from_date', '=', $from)->orderBy('from_date', 'DESC')
            ->first();
            $getdata = Fleet::select('car_SKU', 'id', 'is_reserved','car_number')
            ->where('id', '=',  $data)->where('status', '=', '1')->where('organisation_id',getUser()->organisation_id)->first();

            if(is_object($reserve_from_from)){
                 break;
            }

            $reserve_from_middle = ReserveFleet::Where('fleet_id', $data)->whereDate('from_date', '<', $from)->whereDate('to_date', '>', $from)->orderBy('from_date', 'DESC')
            ->first();
            if(is_object($reserve_from_middle)){
                 break;
            }
         
            $reserve_from = ReserveFleet::Where('fleet_id', $data)->whereDate('to_date', '<', $from)->orderBy('from_date', 'DESC')
            ->first();
            
            if(is_object($reserve_from)){
                
                $reserve_to = ReserveFleet::Where('fleet_id', $data)->whereDate('from_date', '>', $from)->first();
                if(is_object($reserve_to)){
                        if($reserve_to->from_date>$to){
                                $from_reserved[$key]['id'] = $reserve_to->fleet_id;
                                $from_reserved[$key]['car_SKU'] = $getdata->car_SKU;

                        }else{

                            break;
                            
                        }
               }else{
                                $from_reserved[$key]['id'] = $reserve_from->fleet_id;
                                $from_reserved[$key]['car_SKU'] = $getdata->car_SKU;
                    
                   }

            }else{

                $pre_from = ReserveFleet::Where('fleet_id', $data)->whereDate('from_date', '>', $to)->orderBy('from_date', 'DESC')
                ->first();

                if(is_object($pre_from)){
                    $from_reserved[$key]['id'] = $pre_from->fleet_id;
                    $from_reserved[$key]['car_SKU'] = $getdata->car_SKU;
                  
               }


            }

        }
        $s= array_unique($from_reserved, SORT_REGULAR); 
        $available_fleet = array_merge($final, $from_reserved);
        
        $getdatas = Fleet::select('car_SKU', 'id', 'is_reserved','car_number')
        ->where('id', '=', $fleet_id)->where('status', '=', '1')->get();

        $return['status'] = false;
        $return['html'] = '<option class="opt_v1" value=""></option>';
        
        if (count($getdatas) > 0) 
        {
            $select = "";
            foreach ($getdatas as $d) 
            {
                if ($d->id == $fleet_id)
                 {
                    $select = "selected";
                }
               
               // dd($fleet_id);
                $return['html'] .= '<option class="opt_v1" ' . $select . ' value="' . $d->id . '">' . $d['car_SKU'];
                $return['html'] .= "</option>";
            }
            $return['status'] = true;
        }
        if (count($available_fleet) > 0) 
        {
            $select = "";
            foreach ($available_fleet as $model_name) 
            {
                if ($model_name['id'] == $model)
                 {
                    $select = "selected";
                }
                $return['html'] .= '<option class="opt_v1" ' . $select . ' value="' . $model_name['id'] . '">' . $model_name['car_SKU'];
                $return['html'] .= "</option>";
            }
            $return['status'] = true;
        }
        return response()->json($return);
    }

    public function get_vehicles($model_ids, $vehicle_id)
    {

        $return = array();
        $getdata = Fleet::select('id')->where('model_id', '=', $model_ids)->get();

        $return['status'] = false;
        $return['html'] = '<option class="opt_v1" ></option>';
        if (count($getdata) > 0) {
            $select = "";
            foreach ($getdata as $model_name) {
                if ($model_name->id == $model) {
                    $select = "selected";
                }
                $return['html'] .= '<option class="opt_v1" ' . $select . ' value="' . $model_name->id . '">' . $model_name->id;
                $return['html'] .= "</option>";
            }
            $return['status'] = true;
        }
        return response()->json($return);
    }

    public function customer_data($id)
    {
  
        $get_customer = User::where('id', $id)->where('deleted_at', '=', null)->first();

        echo json_encode($get_customer);
        die;
    }
    public function preview($uuid)
    {
        $get_data = BookingInvoice::select('booking_invoices.*', 'booking_invoicedetails.invoice_id', 'booking_invoicedetails.sku', 'booking_invoicedetails.description', 'booking_invoicedetails.price', 'booking_invoicedetails.period', 'booking_invoicedetails.discount', 'booking_invoicedetails.tax', 'booking_invoicedetails.total', 'booking_invoicedetails.agent', 'booking_invoicedetails.note', 'manage_bookings.customer_id', 'manage_bookings.pickup_date_time', 'manage_bookings.dropoff_date_time', 'manage_bookings.vehicle_id', 'manage_bookings.model_id', 'manage_bookings.driver_id', 'manage_bookings.number_of_tavellers', 'manage_bookings.pickup_address', 'manage_bookings.dropoff_address', 'manage_bookings.amount', 'manage_bookings.created_at as date', 'manage_bookings.id as booking_code', 'users.fullname', 'users.email as customer_email', 'users.mobile', 'customers.address1', 'customers.address2', 'customers.city as customer_city', 'customers.postcode', 'organisations.org_street1', 'organisations.org_street2', 'organisations.org_city', 'organisations.org_state', 'organisations.org_postal', 'organisations.org_phone', 'organisations.org_contact_person_number', 'organisations.org_name')
            ->leftjoin('booking_invoicedetails', 'booking_invoices.id', '=', 'booking_invoicedetails.invoice_id')
            ->leftjoin('manage_bookings', 'booking_invoices.booking_id', '=', 'manage_bookings.id')
            ->leftjoin('users', 'manage_bookings.customer_id', '=', 'users.id')
            ->leftjoin('customers', 'manage_bookings.customer_id', '=', 'customers.user_id')
            ->leftjoin('organisations', 'customers.organisation_id', '=', 'organisations.id')
            ->where('booking_invoices.uuid', $uuid)->first();

        $get_details = BookingInvoice::select('booking_invoicedetails.*')
            ->leftjoin('booking_invoicedetails', 'booking_invoices.id', '=', 'booking_invoicedetails.invoice_id')
            ->where('booking_invoices.uuid', $uuid)->where('booking_invoicedetails.deleted_at', '=', null)->get();

        //  $get_data1 = ManageBookings::select('*')->with(
        //     'invoice',
        //     'invoice.invoicedetails'
        // )->get();

        return view('booking.managebooking.invoice-preview', compact('get_data', 'get_details'));
    }

    public function inv_note_store(Request $request, $uuid)
    {
         
        DB::beginTransaction();
        try {
            $created_user = getUser();
            $type = "Invoice";
            $mb = ManageBookings::where('id', $uuid)->first();
         
            $invoice = BookingInvoice::where('booking_id', $mb->id)->orderBy('id','DESC')->first();
            
            $current_timestamp = Carbon::now()->timestamp;
            
            if($invoice->transaction_type==4) {   
                
                $trans = new Transaction;

           if ($type == "Invoice")
            {
                $trans->booking_id			= ($mb->id ) ? $mb->id  : 0;
                $trans->invoice_id 			= $invoice->id;
                $trans->user_id				= ($mb->customer_id) ? $mb->customer_id : 0;
            } 
           else
            {
                $trans->invoice_id 			= $invoice->id;
                $trans->user_id				= auth()->guard('web')->user()->id;
               
            }
           if($invoice->transaction_type)
            {
                $tt='Cash';
            }

                $trans->tran_type			= $tt;
                $trans->cart_id				= 'CART';
                $trans->cart_amount			= $invoice->grand_total;
                $trans->tran_ref			    = 'CA'.''.$current_timestamp;
                $trans->cart_currency		= $invoice->currency_type;
                $trans->payment_status		= 'A';
                $trans->response_code 		= '';
                $trans->transferable_amount = 0;
                $trans->account_type  		= 1;
                $trans->transaction_time 	= now();
                $trans->organisation_id     = getUser()->organisation_id;
                
                $trans->save();
           
           if ($mb)
            {
                $mb->payment_status = $trans->payment_status;
                $mb->save();
            }
             
               //creadit store  
                $general_ledger = new GeneralLedger;
                $general_ledger->organisation_id         = getUser()->organisation_id ;
                $general_ledger->credit                  = $invoice->grand_total;
                $general_ledger->amount                  = $invoice->grand_total;
                $general_ledger->trans_ref               = $trans->tran_ref;
                $general_ledger->transaction_id          = $trans->id;
                $general_ledger->is_transfer             = 2;
                $general_ledger->cash_collected          = 1;
                $general_ledger->type                    = 4;
              /* Need to add calculation from company */
            
                $general = GeneralLedger::select('Balance')->orderBy('id', 'DESC') ->where('organisation_id', getUser()->organisation_id) ->first();
            
            if (is_object($general))
             {
                $general_ledger->Balance = $general->Balance + $invoice->grand_total;
             }
            else
             {
                $general_ledger->Balance  = $invoice->grand_total;
             }
                 
                $general_ledger->save();

              //debit store
                $general_ledgers = new GeneralLedger;
                $general_ledgers->organisation_id         = getUser()->organisation_id ;
                $general_ledgers->debit                   = $invoice->grand_total;
                $general_ledgers->amount                  = $invoice->grand_total;
                $general_ledgers->trans_ref               = $trans->tran_ref;
                $general_ledgers->transaction_id          = $trans->id;
                $general_ledgers->is_transfer             =  2 ;
                $general_ledgers->cash_collected          =  1 ;
                $general_ledgers->type                    =  4 ;
              /* Need to add calculation from company */
            
                $generals = GeneralLedger::select('Balance')->orderBy('id', 'DESC')->where('organisation_id', getUser()->organisation_id) ->first();
            
            if (is_object($generals))
             {
                $general_ledgers->Balance = $generals->Balance - $invoice->grand_total;
             }
            else
             {
                $general_ledgers->Balance  = $invoice->grand_total;
             }
              
                $general_ledgers->save();
           
           
           if($mb->id && $mb->dispatch_type==1)
            {
                  Fleet::where('id', $mb->vehicle_id)
                     ->update([
                       'is_reserved' => '1',
                    ]);
                    if ($invoice->document_type=='account') { 

                        $Bookingss =  ManageBookings::find($invoice->booking_id); 
                        $Bookingss->extend_date = $request->extend_date_time;
                        $Bookingss->extend_time = $request->extend_time;
                        $Bookingss->save();

                        $reversed = ReserveFleet::where('booking_id',$invoice->booking_id)->first(); 
                       if(isset($reversed)){
                        $reversed->to_date                      = $Bookingss ->extend_date;
                        $reversed->save();
                       }else{
                        $reversed = new ReserveFleet;
                        $reversed->from_date                    = $mb->pickup_date_time;
                        $reversed->to_date                      = $mb->dropoff_date_time;
                    
                        $reversed->fleet_id                     = $mb->vehicle_id;
                        $reversed->brand_id                     = $mb->brand_id;
                        $reversed->model_id                     = $mb->model_id;
                        $reversed->car_SKU                      = $mb->merchant_sku;
                     
                        $reversed->booking_id                   = $mb->id;
                        $reversed->created_user                 = $created_user->id;
                        $reversed->save();
                       }
                         
                    }else{

                   $reversed = new ReserveFleet;
                   $reversed->from_date                    = $mb->pickup_date_time;
                   $reversed->to_date                      = $mb->dropoff_date_time;
               if ($mb->dispatch_type == '2')
                {
                   $reversed->fleet_id                     = $mb->vehicle_id;
                   $reversed->brand_id                     = $mb->brand_id;
                   $reversed->model_id                     = $mb->model_id;
                   $reversed->car_SKU                      = $mb->merchant_sku;
                }
               else
                {  
                   $reversed->fleet_id                     = $mb->vehicle_id;
                   $reversed->brand_id                     = $mb->brand_id;
                   $reversed->model_id                     = $mb->model_id;
                   $reversed->car_SKU                      = $mb->merchant_sku;
                }
                   $reversed->booking_id                   = $mb->id;
                   $reversed->created_user                 = $created_user->id;
                   $reversed->save();
                }
               
               }
                
               $adminactivity = new CompanyActivity;
                $adminactivity->messages          = 'Transaction saved successfully';
                $adminactivity->created_user           = getUser()->id;
                $adminactivity->organisation_id   = getUser()->organisation_id;
                $adminactivity->save();


               DB::commit();
               return ajax_response(true, $trans, [], "Transaction Saved Successfully", $this->success);
              }
             
          
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        }

        ManageBookings::where('id', $uuid)->limit(1)->update(array('invoice_preview_note' => $request->name, 'is_send_invoice' => 1));

        $datas =ManageBookings::select('manage_bookings.*', 'booking_invoices.grand_total', 'booking_invoices.short_link')
            ->leftjoin('booking_invoices', 'manage_bookings.id', '=', 'booking_invoices.booking_id')
            ->where('manage_bookings.id', $uuid)->first();


        $get_customer = User::where('id', $datas->customer_id)->first();
 
        $data = array(
            'dear'         => 'Dear',
            'msg'          => 'Please find below your payment link:',
            'amount_msg'   => 'Total Amount is :',
            'name'      =>  $get_customer->fullname,
            'email'      =>  $get_customer->email,
            'mobile'      =>  $get_customer->mobile,
            'amount'      =>  $datas->grand_total,
            'short_link'      =>  $datas->short_link,
        );
        
        Mail::mailer('smtp')->to($get_customer->email)->send(new SendMail($data));
        // Mail::mailer('smtp1')->to($get_customer->email)->send(new SendMail($data));  
        // Mail::mailer('smtp2')->to($get_customer->email)->send(new SendMail($data));  
    }
    public function popupmail_trigger($uuid)
    {
        $datas =  ManageBookings::select('manage_bookings.*', 'booking_invoices.grand_total', 'booking_invoices.short_link')
            ->leftjoin('booking_invoices', 'manage_bookings.id', '=', 'booking_invoices.booking_id')
            ->where('manage_bookings.id', $uuid)->first();

        $get_customer = User::where('id', $datas->customer_id)->first();

        $data = array(

            'dear'         => 'Dear',
            'msg'          => 'Please find below your payment link:',
            'amount_msg'   => 'Total Amount is :',
            'name'      =>  $get_customer->fullname,
            'email'      =>  $get_customer->email,
            'mobile'      =>  $get_customer->mobile,
            'amount'      =>  $datas->grand_total,
            'short_link'      =>  $datas->short_link,

        );

         Mail::mailer('smtp')->to($get_customer->email)->send(new SendMail($data));
        //  Mail::mailer('smtp1')->to($get_customer->email)->send(new SendMail($data));  
        //  Mail::mailer('smtp2')->to($get_customer->email)->send(new SendMail($data)); 
        return 'true';
    }

    public function popup()
    {
        return view('booking.managebooking.popupinvoice');
    }

    public function tabinvoice($uuid)
    {
        $get_data = ManageBookings::select('manage_bookings.*', 'organisations.org_street1', 'organisations.org_street2', 'organisations.org_city', 'organisations.org_state', 'organisations.org_postal', 'organisations.org_phone', 'organisations.org_contact_person_number', 'organisations.org_name', 'users.fullname', 'users.mobile', 'customers.address1', 'customers.address2', 'customers.city as customer_city', 'customers.postcode', 'customers.state', 'users.email as customer_email')
            ->leftjoin('users', 'manage_bookings.customer_id', '=', 'users.id')
            ->leftjoin('customers', 'manage_bookings.customer_id', '=', 'customers.user_id')
            ->leftjoin('vehicles', 'manage_bookings.vehicle_id', '=', 'vehicles.id')
            ->leftjoin('organisations', 'customers.organisation_id', '=', 'organisations.id')
            ->where('manage_bookings.id', $uuid)->first();

            
        $customer   = User::select('id', 'fullname')->where('usertype', 2)->get();
        $vehicle    = VehicleBrand::select('id', 'brand_name')->where('id', $get_data->brand_id)->first();
        $model      = VehicleModel::select('id', 'model_name')->where('id', $get_data->model_id)->first();
        $fleet      = Fleet::select('id', 'car_SKU')->where('id', $get_data->vehicle_id)->first();

        if ($get_data->customer_id != '' || $get_data->customer_id != null) {
            $customer_details = User::select('*')->where('usertype', 2)->where('id', $get_data->customer_id)->get();
        } else {
            $customer_details = null;
        }
        
        $all_transactionhistory = Transaction::with('invoicetran','invoicedetaistran')
                 ->where('transactions.booking_id', $uuid)
                 ->get();
  
        $amount = BookingInvoice::select('booking_invoices.*')
            ->leftjoin('booking_invoicedetails', 'booking_invoices.id', '=', 'booking_invoicedetails.invoice_id')
            ->where('booking_invoices.booking_id', $uuid)->first();

            if($amount){

                    $transaction_history = BookingInvoice::with('invoicedetails','transaction')
                    ->where('booking_invoices.booking_id', $uuid)->get();
                    
                    $get_details = BookingInvoice::with('invoicedetails')->where('booking_invoices.booking_id', $uuid)->where('booking_invoices.document_type', 'booking')->first();
                    
                    $transaction = Transaction::select('transactions.*',)
                    ->leftjoin('booking_invoices', 'transactions.invoice_id', '=', 'booking_invoices.id')
                    
                    ->where('booking_invoices.id', ($get_details)? $get_details->id : null)->first(); 
                    
                    return view('booking.managebooking.tabinvoice', compact('get_data','all_transactionhistory','transaction_history' ,'customer', 'vehicle', 'customer_details', 'model', 'fleet',  'get_details', 'amount', 'transaction'));
             }
      
           
        return view('booking.managebooking.tabinvoice', compact('get_data' ,'customer','all_transactionhistory','vehicle', 'customer_details', 'model', 'fleet', 'amount'));
    }

    private function validations($input, $type)
    {
        $validator = [];
        $errors = []; 
        $error = false;
        if ($type == "add")
         {
            $validator = Validator::make($input, [
               
                'pickup_date_time'             => 'required|string',
                'drop_off_date_time'           => 'required|string',
                'select_driver'                => 'required|string',
                'origin'                       => 'required|string',
                'destination'                  => 'required|string'


            ]);
         }

        if ($validator->fails())
         {
            $error = true;
            $errors = $validator->errors();
         }

        return ["error" => $error, "errors" => $errors];
    }

    private function validationsInvoice($input, $type)
    {
        $validator = [];
        $errors = [];
        $error = false;
        if ($type == "add")
         {
            $validator = Validator::make($input, [
                'full_name'                    => 'required|string',
                'currency_type'                => 'required|string',
                'transaction_type'             => 'required|string'
                
            ]);
         }

        if ($validator->fails())
         {
            $error = true;
            $errors = $validator->errors();
         }

        return ["error" => $error, "errors" => $errors];
    }



    public function check_tn_number($tn_number, $tn_uuid)
    {

        $get_booking_id = ManageBookings::where('uuid', $tn_uuid)->where('deleted_at', '=', null)->first();
        $get_tn_number = AcountsPayment::where('transaction_ref', $tn_number)->where('booking_id', null)->where('invoice_id', null)->where('deleted_at', '=', null)->first();

        if ($get_tn_number != null)
         {
            $get_inv_id = BookingInvoice::where('booking_id', $get_booking_id->id)->where('document_type', 'booking')->where('deleted_at', '=', null)->first();

            // dd($get_inv_id->grand_total, $get_tn_number->amount);

            if($get_inv_id->grand_total != $get_tn_number->amount) {

                return ajax_response('error', " Amount Difference! ", [], "Invoice amount is $get_inv_id->grand_total and Transaction amount is $get_tn_number->amount", $this->success);

            }

            // Booking status change from pending to paid
            $get_booking_id->payment_status = 'A';
            $get_booking_id->save();

            // Invoice status of field is_adjust_invoice change from 0 to 1
            $get_inv_id->is_adjust_invoice = 1;
            $get_inv_id->save();


            $final = AcountsPayment::where('transaction_ref', $tn_number)->limit(1)->update(array('invoice_id' => $get_inv_id->id, 'booking_id' => $get_inv_id->booking_id));

            AmountTransaction::where('transaction_ref', $tn_number)->limit(1)->update(array('invoice_id' => $get_inv_id->id));

            Transaction::where('tran_ref', $tn_number)->limit(1)->update(array('invoice_id' => $get_inv_id->id, 'booking_id' => $get_inv_id->booking_id));

            // ManageBookings::where('uuid', $tn_uuid)->limit(1)->update(array('booking_status' => '3'));

            return ajax_response('success', " Mapped!", [], "Booking Mapped With Transaction ID : $tn_number", $this->success);
         }
         else
          {
            // If transaction reference code isn't available in account_payment( here trasaction code store) table.
            return ajax_response('error', " Not Found!", [], "Transaction ID : $tn_number not found.", $this->success);

         }

         

    }

    public function marchantsku_auto_suggestion(Request $request)
    {
       
        if ($request->ajax())
         { 
            if($request->name != null)
            { 
                $data = Fleet::where('is_deleted','=','0')->where(function ($query) use ($request) {
                    $query->where('car_number','LIKE',$request->name.'%')->orWhere('car_SKU','LIKE',$request->name.'%');
                   })->where('fleets.organisation_id','!=',getUser()->organisation_id)->get();
            
                $output = '';
                if (count($data)>0)
                 {
                    $output = '<ul id="sku_ul" class="list-group" style="display: block; position: relative; z-index: 1">';
                    foreach ($data as $row)
                     {
                        $output .= '<li class="list-group-item" data-model='.$row->model_id.' data-brand='.$row->brand_id.' data-id='.$row->id.'>'.$row->car_SKU.'</li>';
                     }
                    $output .= '</ul>';
                }
                else
                 {
                    $output .= '<li class="list-group-item">'.'No Data Found'.'</li>';
                 }
                return $output;
            }
        }
    }
    public function customer_auto_suggestion(Request $request)
    {
        
        if ($request->ajax())
         { 
            if($request->name != null)
            {  
                $data = User::where('is_deleted','=','0')
                 ->where(function ($query) use ($request)
                  {
                    $query->where('fullname','LIKE',$request->name.'%')->orWhere('mobile','LIKE',$request->name.'%')->orWhere('email','LIKE',$request->name.'%');
                   })->where('usertype',2)->get();
 
                 
                $output = '';
                if (count($data)>0)
                 {
                    $output = '<ul id="customer_ul" class="list-group" style="display: block; position: relative; z-index: 1">';
                    foreach ($data as $row)
                     {
                        $output .= '<li class="list-group-item" data-id='.$row->id.'>'.$row->fullname.'</li>';
                    }
                    $output .= '</ul>';
                }
                else
                 {
                    $output .= '<li class="list-group-item">'.'No Data Found'.'</li>';
                }
                return $output;
            }
        }
    }
    public function description_auto_suggestion(Request $request)  
    {
       
        if ($request->ajax()) 
        {  
            if($request->description1 != null) 
            {
                
            
                $output = ''; 
              
                    $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                    
                        $output .= '<li class="list-group-item" data-id="1">Insurance</li>';
                        $output .= '<li class="list-group-item" data-id="2">Child Seat</li>';
                        $output .= '<li class="list-group-item" data-id="3">Extra km</li>';
                    
                    $output .= '</ul>';
                
                return $output;
            }
        }
    }


    public function description_price($fleet,$id) 
    {   
        $price = 0;
        if($id=='1')
        {
            $fleets = Fleet::where('car_SKU', $fleet)->where('is_deleted', '=', '0')->first();
           
            $price = $fleets->insurence;
        }
        elseif($id=='2')
        {
            $fleets = Fleet::where('car_SKU', $fleet)->where('is_deleted', '=', '0')->first();
            $price = $fleets->child_seat;

        }
        else
        {
            $fleets = Fleet::where('car_SKU', $fleet)->where('is_deleted', '=', '0')->first();
            $price = $fleets->additional_distance;

        }

        echo json_encode($price);  
        die;
    }
    public function getpromotion($code) 
    {   
         $date = Carbon::now();
         $current_date = $date->format('Y-m-d');
         $getdata=Promotion::where('promotion_code', $code)
                 ->whereDate('from_date','<=',$current_date)
                 ->whereDate('to_date', '>=',$current_date)->first();
           
         return response()->json([
            'value' => isset($getdata->promotion_value) ? $getdata->promotion_value : 0,
            'type' => isset($getdata->promotion_type) ? $getdata->promotion_type : 0,
            'id' => isset($getdata->id) ? $getdata->id : 0, 
        ]);
     
    }

    public function quick_payment_data($id)
    {   
           $data=ManageBookings::select('user.fullname as name',
           'user.mobile as mobile','user.email','manage_bookings.amount','user.id','manage_bookings.id as ids')
             ->leftjoin('users as user', function ($join) {
               $join->on('user.id', '=', 'manage_bookings.customer_id');
             })
               ->where('manage_bookings.uuid',$id)->first();
           
           echo json_encode($data);  
            die; 
    }

    public function quick_payment_store(Request $request)
    {
          
        $current_timestamp = Carbon::now()->timestamp; 
        DB::beginTransaction();
        try {
               $booking=ManageBookings::select('id')->where('id',$request->booking_ids)->first();
           
            //    $invoice=BookingInvoice::select('id')->where('booking_id',$booking->id)->first();
               
            if($request->transaction_type==4){
                
                $data = new AcountsPayment;
                $data->full_name               = $request->full_name;
                $data->transaction_type        = $request->transaction_type;
                $data->organisation_id         = getUser()->organisation_id;
                $data->phone                   = $request->phone;
                $data->email                   = $request->email;
                $data->amount                  = $request->amount;
                $data->agent                   = $request->agent;
                $data->description             = $request->description;
                $data->comment                 = $request->comment;
                $data->booking_id              = $booking->id;
                $data->created_user            = getUser()->id;
                $data->status                  = '1';
                $data->save();
                
                $trans = new Transaction;
 
                if($data->transaction_type)
                {
                    $tt='Cash';
                }
  
                $trans->tran_type			= $tt;
                $trans->invoice_id          = $data->invoice_id;
                $trans->booking_id          = $data->booking_id;
                $trans->acounts_payment_id          = $data->id;

                $trans->cart_id				= 'CART';
                $trans->cart_amount			= $request->amount;
                $trans->tran_ref		    = 'CA'.''.$current_timestamp;
                $trans->cart_currency		= 'AED';
                $trans->payment_status		= 'A';
                $trans->response_code 		= '';
                $trans->transferable_amount = 0;
                $trans->account_type  		= 1;
                $trans->transaction_time 	= now();
                $trans->organisation_id     = getUser()->organisation_id;
                $trans->user_id				= auth()->guard('web')->user()->id;
                $trans->description		    = 'Cash Payment';
                $trans->save();
 
                if($booking)
                   {
                    $booking->payment_status          = $trans->payment_status;
                    $booking->save();         
                   }

                 
                 //Creadit Store
                $general_ledger = new GeneralLedger;
                $general_ledger->organisation_id           = getUser()->organisation_id ;
                $general_ledger->credit                    =  $data->amount;
                $general_ledger->amount                    =  $trans->cart_amount;
                $general_ledger->trans_ref                 =  $trans->tran_ref;
                $general_ledger->transaction_id            = $trans->id;
                $general_ledger->is_transfer               =  2 ;
                $general_ledger->cash_collected            =  1 ;
                $general_ledger->type                      =  4 ;
                  /* Need to add calculation from company */
               
                $general = GeneralLedger::select('Balance')->orderBy('id', 'DESC') ->where('organisation_id', getUser()->organisation_id) ->first();
                
                if (is_object($general)) {
                      $general_ledger->Balance = $general->Balance + $data->amount;
                    
                } else {
                      $general_ledger->Balance  = $data->amount;
                }
                     
                     $general_ledger->save();

                      //Debit Store
                     $general_ledgers = new GeneralLedger;
                     $general_ledgers->organisation_id          = getUser()->organisation_id ;
                     $general_ledgers->debit                    =  $data->amount;
                     $general_ledgers->amount                   =  $trans->cart_amount;
                     $general_ledgers->trans_ref                =  $trans->tran_ref;
                     $general_ledgers->transaction_id           = $trans->id;
                     $general_ledgers->is_transfer              =  2 ;
                     $general_ledgers->cash_collected           =  1 ;
                     $general_ledgers->type                     =  4 ;
                       /* Need to add calculation from company */
                     
                     $general = GeneralLedger::select('Balance')->orderBy('id', 'DESC') ->where('organisation_id', getUser()->organisation_id) ->first();
                     
                     if (is_object($general)) {
                           $general_ledgers->Balance = $general->Balance - $data->amount;
                          
                     } else {
                           $general_ledgers->Balance  = $data->amount;
                     }
                        
                          $general_ledgers->save();

                     $mb = AcountsPayment::where('id', '=', $data->id)->first();
     
                     if ($mb) {
                         $mb->transaction_ref = $trans->tran_ref;
                         $mb->payment_status = $trans->payment_status; 
                         $mb->save();
                     }
                     if ($request->amount)
                        {
                            ManageBookings::where('id', $data->booking_id)->update(array('amount' => $request->amount));
                        }

            }else{  
                
            $data = new AcountsPayment;
            $data->full_name               = $request->full_name;
            $data->transaction_type        = $request->transaction_type;
            $data->organisation_id         = getUser()->organisation_id;
            $data->phone                   = $request->phone;
            $data->email                   = $request->email;
            $data->amount                  = $request->amount;
            $data->agent                   = $request->agent;
            $data->description             = $request->description;
            $data->comment                 = $request->comment;
            $data->booking_id              = $booking->id;
            $data->created_user            = getUser()->id;
            $data->status                  = '0';
            $data->save();

            $mb = AcountsPayment::where('id', '=', $data->id)->first();

            $short_link = new ShortLink;
            $short_link->user_id    = ($mb) ? $mb->agent : null;
            $short_link->other_id   = 0;
            $short_link->payment_id = $mb->id;
            $short_link->short_code = (string) \Str::random(8);
            $short_link->type       = "Short Payment";
            $short_link->save();

            if ($mb) {
                $mb->short_link = url('/', $short_link->short_code);
                $mb->save();
            }

            if ($request->amount)
            {
               ManageBookings::where('id', $data->booking_id)->update(array('amount' => $request->amount));
            }
 
             
        }     
            $popup_data = AcountsPayment::select('acounts_payments.*', 'user.fullname as agentname', 'company.org_street1 as address1', 'company.org_street2 as address2', 'company.org_city as city', 'company.org_state as state')
                ->join('users as user', function ($join) {
                    $join->on('user.id', '=', 'acounts_payments.agent');
                })
                ->join('organisations as company', function ($join) {
                    $join->on('user.organisation_id', '=', 'company.id');
                })
                ->withoutGlobalScope('organisation_id')
                ->where('acounts_payments.organisation_id', getUser()->organisation_id)
                ->where('acounts_payments.id', $data->id)
                ->first();

                $adminactivity = new CompanyActivity;
                $adminactivity->messages          = 'Quick payment successfully by '.$data->full_name;
                $adminactivity->created_user           = getUser()->id;
                $adminactivity->organisation_id   = getUser()->organisation_id;
                $adminactivity->save();
                
            DB::commit();
            return ajax_response(true, $popup_data, [], "Quick Payment Successfully", $this->success);
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        }
    }

    public function bookingdata_get($uuid)
    {
        $booking = ManageBookings::where('deleted_at', '=', null)->where('organisation_id' , getUser()->organisation_id)->get();
        $country      = CountryMaster::select('id', 'name')->get();
        $bookingdata  = ManageBookings::with('customer','customerInfo','vehicle','invoice','invoice.invoicedetails')->where('uuid',$uuid)->get()->first();
        $sku          = Fleet::where('id', '=', $bookingdata->vehicle_id)->first();

        return view('account_invoice.create',['booking' => $booking, 'bookingdata' => $bookingdata,'country'=>$country,'sku'=>$sku]);
    }


    public function popupsms_trigger($uuid)
    {

        $get_data = BookingInvoice::with('moreInfo')
        ->where('booking_invoices.uuid', $uuid)
        ->first();
        
        $phone = $get_data->phone;
        

        if(str_contains($get_data->phone, ' ')){

            $phone = str_replace(' ', '', $get_data->phone);

        }


        $messageText = "Your payment link for Rental360 is: " . $get_data->short_link;
        $smsApiKey = $get_data->moreInfo->api_key;

        if($smsApiKey == ''){                                   // Here we set myride sms key, if company doesn't have sms key.
            $smsApiKey = 'C20028525e987cee08a299.44558809';         
        }


        $data=Http::get("http://www.elitbuzz-me.com/sms/smsapi?api_key=$smsApiKey&type=text&contacts=$phone&senderid=MyRide&msg=$messageText");
        
        return 'true';

    }

    public function popupsms_trigger_for_quick($id)
    {
           
        $get_data = AcountsPayment::with('moreInfo')
        ->where('acounts_payments.id', $id)
        ->first();
          
        $phone = $get_data->phone;
        

        if(str_contains($get_data->phone, ' ')){

            $phone = str_replace(' ', '', $get_data->phone);

        }


        $messageText = "Your payment link for Rental360 is: " . $get_data->short_link;
       
        $smsApiKey = $get_data->moreInfo->api_key;
      
        $data=Http::get("http://www.elitbuzz-me.com/sms/smsapi?api_key=$smsApiKey&type=text&contacts=$phone&senderid=MyRide&msg=$messageText");
      
        return 'true';

    }

    public function popupmail_trigger_mail_for_quick($id)
    {
        $datas = AcountsPayment::with('moreInfo')
        ->where('acounts_payments.id', $id)
        ->first();

        $get_customer = User::where('fullname', $datas->full_name)->first();
         
        $data = array(

            'dear'         => 'Dear',
            'msg'          => 'Please find below your payment link:',
            'amount_msg'   => 'Total Amount is :',
            'name'      =>  $get_customer->fullname,
            'email'      =>  $datas->email,
            'mobile'      =>  $get_customer->mobile,
            'amount'      =>  $datas->amount,
            'short_link'      =>  $datas->short_link,

        );
          //For Payment
        Mail::mailer('smtp')->to($datas->email)->send(new SendMail($data));
        //For Booking
        // Mail::mailer('smtp1')->to($datas->email)->send(new SendMail($data)); 
        //For Support 
        // Mail::mailer('smtp2')->to($datas->email)->send(new SendMail($data)); 
        return 'true';
    }
    
}
