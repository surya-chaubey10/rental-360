<?php

namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking; 
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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageConfigs = ['pageHeader' => false];

        $path = public_path() . '/data/booking-data';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (file_exists($path . '/' . '_booking-data.json')) {
            \File::delete($path . '/' . '_booking-data.json');
        }

        if (!file_exists($path . '/' . '_booking-data.json')) {
            $user = $this->json_list();
            $data = array('data' => $user);
            // dd($data);
            \File::put($path . '/' . '_booking-data.json', collect($data));
        }

//finishpayment

$path1 = public_path() . '/data/booking-data';

if (!file_exists($path1)) {
    \File::makeDirectory($path1, 0777, true, true);
}

if (file_exists($path1 . '/' . '_booking-finish_data.json')) {
    \File::delete($path1 . '/' . '_booking-finish_data.json');
}
if (!file_exists($path1 . '/' . '_booking-finish_data.json')) {
    $user1 = $this->json_listfinish();
    $data1 = array('data' => $user1);
    // dd($data);
    \File::put($path . '/' . '_booking-finish_data.json', collect($data1));
}


//end
        return view('booking.list');
    }
    
    private function json_list()
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
            'manage_bookings.payment_status',
            'manage_bookings.status  as  pay_status',         
            'manage_bookings.booking_status',
            'manage_bookings.payment_mode',
            'manage_bookings.amount',
            'manage_bookings.number_of_tavellers',
            'user.fullname as name',
            'user.mobile as mobile',
            'vehicle_brands.brand_name as vehicle'
            // 'booking_invoices.uuid as invoice_uuid',
            // 'booking_invoices.short_link as short_link'
        )  
            ->leftjoin('users as user', function ($join) {
                $join->on('user.id', '=', 'manage_bookings.customer_id');
            })
            ->leftjoin('vehicle_brands', function ($join) {
                $join->on('vehicle_brands.id', '=', 'manage_bookings.brand_id');
            })

            // ->leftjoin('booking_invoices', function ($join) {
            //     $join->on('booking_invoices.booking_id', '=', 'manage_bookings.id');
            // })

            ->withoutGlobalScope('organisation_id')
            ->where('manage_bookings.payment_status','=','A')
            ->where('user.usertype', 2)
            // ->where('booking_invoices.document_type', '=', 'booking')
            ->orderBy('manage_bookings.id', 'desc')
            ->get();
    //   dd($return);
        // $super= Booking::select('bookings.id','bookings.status','bookings.pickup as pickup','bookings.merchantname as merchantname','vehicle_brands.brand_name','bookings.booking_status','bookings.amount','bookings.driver_id','bookings.dropoff_address as dropoff_address')
        
        // ->leftjoin('vehicle_brands', function ($join) {
        //     $join->on('vehicle_brands.id', '=', 'bookings.bookingMake');
        // })
        //  ->orderBy('bookings.id', 'desc');
       
        //     $admin= ManageBookings::select('manage_bookings.id','manage_bookings.driver_id','manage_bookings.status','manage_bookings.booking_status','manage_bookings.amount','vehicle_brands.brand_name','manage_bookings.merchant_name as merchantname','manage_bookings.pickup_address as pickup','manage_bookings.dropoff_address as dropoff_address')
                     
        //            ->leftjoin('vehicle_brands', function ($join) {
        //             $join->on('vehicle_brands.id', '=', 'manage_bookings.vehicle_id');
        //         }) 
                   
        //            ->union($super) 
        //            ->orderBy('id', 'desc')
        //              ->get(); 
                 
        //            return $admin;
          
    }



    private function json_listfinish()
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
            'manage_bookings.payment_status',
            'manage_bookings.status  as  pay_status',         
            'manage_bookings.booking_status',
            'manage_bookings.payment_mode',
            'manage_bookings.amount',
            'manage_bookings.number_of_tavellers',
            'user.fullname as name',
            'user.mobile as mobile',
            'vehicle_brands.brand_name as vehicle'
            // 'booking_invoices.uuid as invoice_uuid',
            // 'booking_invoices.short_link as short_link'
        )
            ->leftjoin('users as user', function ($join) {
                $join->on('user.id', '=', 'manage_bookings.customer_id');
            })
            ->leftjoin('vehicle_brands', function ($join) {
                $join->on('vehicle_brands.id', '=', 'manage_bookings.brand_id');
            })
            // ->leftjoin('booking_invoices', function ($join) {
            //     $join->on('booking_invoices.booking_id', '=', 'manage_bookings.id');
            // })

            ->withoutGlobalScope('organisation_id')
            
            ->where('user.usertype', 2)
            // ->where('booking_invoices.document_type', '=', 'booking')
            ->orderBy('manage_bookings.id', 'desc')
            ->get();
    }

    public function create()
    {        
 
        $Company =Organisation::select('id', 'org_name')->where('deleted_at', '=', null)->get(); 
        
        $customer = User::select('id', 'fullname')->where('usertype', 2)->where('deleted_at', '=', null)->get(); 
        $vehicle = VehicleBrand::select('id', 'brand_name')->get();
        $VehicleModel = VehicleModel::select('id', 'model_name')->get(); 
    
        
        return view('booking.create',compact( 'vehicle','VehicleModel','customer','Company'));
    } 
    // public function store(Request $request)
    // {           
    //    $created_user=getUser();

    //     DB::beginTransaction();
    //         try {
    //             $data = new Booking;
    //             $data->name                     =  $request->name;
    //             $data->phone                    =  $request->phone;
    //             $data->customeremail            = $request->customeremail;
    //             $data->fromdate                 =  $request->fromdate;
    //             $data->todate                   = $request->todate;
    //             $data->pickup                   = $request->pickup;
    //             $data->destination              = $request->destination;
    //             $data->bookingMake              = $request->bookingMake; 
    //             $data->bookingModel             = $request->bookingModel; 
    //             $data->inlineRadioOptions       = $request->inlineRadioOptions; 
    //             $data->merchantname             = $request->merchantname; 
    //             $data->contact                  = $request->contact; 
    //             $data->paymentmode              = $request->paymentmode; 
    //             $data->note                     = $request->note; 
    //             $data->status                   = $request->status; 
    //             $data->created_user             = $created_user->id; 
    //             $data->save();   
              
    //             DB::commit();
    //             return ajax_response(true, $data, [], "Booking Saved Successfully", $this->success);
    //          } catch (\Exception $e) {
    //             DB::rollback();
    //             $message = $e->getMessage();
    //             return ajax_response(false, [], [], $message, $this->internal_server_error );
    //         }
    // }


    public function getting_merchant_sku($merchant_sku)
    {
       
        $org=getUser();
       
        $data_id = DB::table('fleets')->select('*')->where('car_SKU',$merchant_sku)->where('is_reserved', '=','0')->where('organisation_id', '!=',$org->organisation_id)->where('deleted_at', '=', null)->first();

        $data['id']  = $data_id->id;  
        $data['brand']  = $data_id->brand_id;  
        $data['model']  = $data_id->model_id;  
        // $data_model  = $data_id->model_id;  
      
        return ajax_response(true, $data, [], "Fleet Available", $this->success);

       

    //     echo json_encode($data);
    //   die;  
    } 


    public function store(Request $request)
    {
        //    DD($request);

        $created_user = getUser();

        $input = $request->all();
        $validate = $this->validations($input, "add");
        if ($validate["error"]) {

            return prepareResult(false, [], $validate['errors']->first(), "Error while validating booking", $this->unprocessableEntity);
        }
 
        DB::beginTransaction();
        try {
            $data = new ManageBookings;
            $data->organisation_id                  = $request->Company;
            $data->customer_id                  = $request->select_customer;
            $data->pickup_date_time             = $request->pickup_date_time;
            $data->dropoff_date_time            = $request->drop_off_date_time;
 
            $data->pickup_time             = $request->pickup_time;
            $data->dropoff_time            = $request->drop_off_time;

            if ($request->inlineRadioOptions == '2') {
                $data->vehicle_id                   = $request->merchant_sku_id;
                $data->brand_id                     = $request->merchant_sku_brand;
                $data->model_id                     = $request->merchant_sku_model;
            } else {
                $data->vehicle_id                   = $request->select_sku;
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
            $data->created_user                 = $created_user->id;
            $data->save();
            $data->id;

            $reversed = new ReserveFleet;
            $reversed->from_date                    = $request->pickup_date_time;
            $reversed->to_date                      = $request->drop_off_date_time;
            if ($request->inlineRadioOptions == '2') {
                $reversed->fleet_id                     = $request->merchant_sku_id;
                $reversed->brand_id                     = $request->merchant_sku_brand;
                $reversed->model_id                     = $request->merchant_sku_model;
                $reversed->car_SKU                      = $request->merchant_sku;
            } else {
                $reversed->fleet_id                     = $request->select_sku;
                $reversed->brand_id                     = $request->select_vehicle;
                $reversed->model_id                     = $request->select_model;
                $reversed->car_SKU                      = $request->sku;
            }
            $reversed->booking_id                   = $data->id;
            $reversed->created_user                 = $created_user->id;
            $reversed->save();
            Fleet::where('id', $request->select_sku)
                ->update([
                    'is_reserved' => '1',
                ]);

            DB::commit();
            return ajax_response(true, $data, [], "Booking Saved Successfully", $this->success);
        } catch (\Exception $e) {
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
        foreach ($sku as $key => $sku_details) {
            if ($sku_details->fleetDetails) {
                foreach ($sku_details->fleetDetails as $key => $details) {
                    if ($details->material == 1) {
                        $fleet_pricing['hourly'] = $details->unit_price;
                    }
                    if ($details->material == 2) {
                        $fleet_pricing['daily'] = $details->unit_price;
                    }
                    if ($details->material == 3) {
                        $fleet_pricing['weekly'] = $details->unit_price;
                    }
                    if ($details->material == 4) {
                        $fleet_pricing['monthly'] = $details->unit_price;
                    }
                    if ($details->material == 5) {
                        $fleet_pricing['custom'] = $details->unit_price;
                    }
                }
            }
        }


        $price = 0;
        $diffHour = (Carbon::parse($booked->dropoff_date_time))->diffInHours(Carbon::parse($booked->pickup_date_time));

        if ($diffHour > 24) {
            $diffDays = (int)($diffHour / 24);
            $diffHour = ($diffHour % 24);


            if ($diffDays >= 30) {

                $remaining = $diffDays - 30;
                if ($remaining > 0) {
                    $price  =  $fleet_pricing['monthly'] * 2;
                } else {
                    $price  = $fleet_pricing['monthly'];
                }
            } else if ($diffDays >= 7) {

                $week = (int)($diffDays / 7);
                $remaining = ($diffDays % 7);
                if ($remaining > 0) {
                    $week_price  =  $fleet_pricing['weekly'] * $week;
                    $day  =  $fleet_pricing['daily'] * $remaining;
                    $price  = $week_price + $day;
                } else {
                    $price  = $fleet_pricing['weekly'] * $week;
                }
            } else if ($diffDays >= 1) {

                if ($diffHour > 0) {
                    $day    =  $fleet_pricing['daily'] * $diffDays;
                    $price  =  $day + $fleet_pricing['daily'];
                } else {
                    $price  = $fleet_pricing['daily'] * $diffDays;
                }
            }
        } else {
            $diffDays = 0;
            $price    =  $fleet_pricing['hourly'] * $diffHour;
        }

        /* End coded by pankaj */ 

        return view('booking.createInvoice', compact('customer', 'uuid', 'customer_details', 'country', 'booked', 'brand', 'brand_vehicle', 'diffDays', 'diffHour', 'sku', 'price'));
    }

    public function storeInvoice(Request $request)
    {
        $created_user = getUser();
        $booking_id  = ManageBookings::select('*')->where('uuid', $request->booking_id)->first();

        $input = $request->all();
        $validate = $this->validationsInvoice($input, "add");

        if ($validate["error"]) {

            return prepareResult(false, [], $validate['errors']->first(), "Error while validating Invoice", $this->unprocessableEntity);
        }

        DB::beginTransaction();
        try {
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
            $booking->zip                    =  $request->zip;
            $booking->inv_description        =  $request->inv_description;
            $booking->subtotal               =  $request->subTotal;
            $booking->subtotal_discount      =  $request->footer_discount;
            $booking->delivery_charge        =  $request->deliveryCharge;
            $booking->grand_total            =  $request->grandTotal;
            $booking->create_user            = $created_user->id;
            $booking->document_type           = $request->document_type;
            $invoice_saved = $booking->save();
            if ($request->grandTotal) {
                ManageBookings::where('id', $booking_id->id)->update(array('amount' => $request->grandTotal));
            }

            $mb = BookingInvoice::where('booking_id', $booking_id->id)->orderBy('id', 'DESC')->first();

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

            if ($request->document_type == 'account') {

                $reversed = new ReserveFleet;
                $reversed->from_date                    = $request->pickup_date_time;
                $reversed->to_date                      = $request->extend_date_time;
                $reversed->fleet_id                     = $request->fleet_id;
                $reversed->brand_id                     = $request->brand_id;
                $reversed->model_id                     = $request->model_id;
                $reversed->car_SKU                      = $request->car_sku;
                $reversed->booking_id                   = $request->bookingid;
                $reversed->created_user                 = getUser()->id;
                $reversed->save();

                $reversed =  ManageBookings::find($request->bookingid);
                $booking_id->extend_date = $request->extend_date_time;
                $booking_id->save();
            }

                // dd($request['sku']);


            if (count($request->sku) > 0) {

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

            // if(){

            // }


            DB::commit();
            return ajax_response(true, $booking, [], "Invoice Saved Successfully", $this->success);
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        }
    }


    public function preview($uuid)
    {
        $get_data = BookingInvoice::select('booking_invoices.*', 'booking_invoicedetails.invoice_id', 'booking_invoicedetails.sku', 'booking_invoicedetails.description', 'booking_invoicedetails.price', 'booking_invoicedetails.period', 'booking_invoicedetails.discount', 'booking_invoicedetails.tax', 'booking_invoicedetails.total', 'booking_invoicedetails.agent', 'booking_invoicedetails.note', 'manage_bookings.customer_id', 'manage_bookings.pickup_date_time', 'manage_bookings.dropoff_date_time', 'manage_bookings.vehicle_id', 'manage_bookings.model_id', 'manage_bookings.driver_id', 'manage_bookings.number_of_tavellers', 'manage_bookings.pickup_address', 'manage_bookings.dropoff_address', 'manage_bookings.amount', 'manage_bookings.invoice_preview_note', 'manage_bookings.created_at as date', 'manage_bookings.id as booking_code', 'users.fullname', 'users.email as customer_email', 'users.mobile', 'customers.address1', 'customers.address2', 'customers.city as customer_city', 'customers.postcode', 'organisations.org_street1', 'organisations.org_street2', 'organisations.org_city', 'organisations.org_state', 'organisations.org_postal', 'organisations.org_phone', 'organisations.org_contact_person_number', 'organisations.org_name')
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

        return view('booking.invoice-preview', compact('get_data', 'get_details')); 
    }

    public function inv_note_store(Request $request, $uuid)
    {

        ManageBookings::where('id', $uuid)->limit(1)->update(array('invoice_preview_note' => $request->name, 'is_send_invoice' => 1));

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

        Mail::to($get_customer->email)->send(new SendMail($data));
    }



    public function tabinvoice($uuid)
    {

        // $get_data = ManageBookings::select('manage_bookings.*', 'vehicle_brands.brand_name', 'vehicles.vehicle_name', 'users.fullname', 'customers.address1', 'customers.address2', 'customers.city as customer_city', 'customers.postcode', 'users.fullname', 'users.email as customer_email', 'users.mobile', 'organisations.org_street1', 'organisations.org_street2', 'organisations.org_city', 'organisations.org_state', 'organisations.org_postal', 'organisations.org_phone', 'organisations.org_contact_person_number', 'organisations.org_name', 'customers.state')->where('manage_bookings.id', $uuid)
        //     ->leftjoin('vehicle_brands', 'manage_bookings.vehicle_id', '=', 'vehicle_brands.id')
        //     ->leftjoin('vehicles', 'manage_bookings.model_id', '=', 'vehicles.id')
        //     ->leftjoin('users', 'manage_bookings.customer_id', '=', 'users.id')
        //     ->leftjoin('customers', 'manage_bookings.customer_id', '=', 'customers.user_id')
        //     ->leftjoin('organisations', 'customers.organisation_id', '=', 'organisations.id')
        //     ->first(); 

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

        // $get_details = BookingInvoice::select('booking_invoicedetails.*', 'booking_invoices.subtotal', 'booking_invoices.delivery_charge', 'booking_invoices.grand_total', 'booking_invoices.subtotal_discount')
        //     ->leftjoin('booking_invoicedetails', 'booking_invoices.id', '=', 'booking_invoicedetails.invoice_id') 
        //     ->where('booking_invoices.booking_id', $uuid)->get();
       
        $amount = BookingInvoice::select('booking_invoices.*')
            ->leftjoin('booking_invoicedetails', 'booking_invoices.id', '=', 'booking_invoicedetails.invoice_id')
            ->where('booking_invoices.booking_id', $uuid)->first();

            $get_details = BookingInvoice::with('invoicedetails')->where('booking_invoices.booking_id', $uuid)->where('booking_invoices.document_type', 'booking')->get();
            //dd($get_details);
            
        $transaction = Transaction::select('transactions.*',)
            ->leftjoin('booking_invoices', 'transactions.invoice_id', '=', 'booking_invoices.id')
            ->where('booking_invoices.id', $get_details[0]->id)->first();
//dd($transaction);
        return view('booking.tabinvoice', compact('get_data', 'customer', 'vehicle', 'customer_details', 'model', 'fleet',  'get_details', 'amount', 'transaction'));
    } 

    private function validations($input, $type)
    {
        $validator = [];
        $errors = []; 
        $error = false;
        if ($type == "add") {
            $validator = Validator::make($input, [
                'select_customer'              => 'required|string',
                'pickup_date_time'             => 'required|string',
                'drop_off_date_time'           => 'required|string',
                'select_driver'                => 'required|string',
                'no_of_traveller'              => 'required|string',
                'origin'                       => 'required|string',
                'destination'                  => 'required|string'


            ]);
        }

        if ($validator->fails()) {
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
        if ($type == "add") {
            $validator = Validator::make($input, [
                'full_name'                    => 'required|string',
                'currency_type'                => 'required|string',
                'transaction_type'             => 'required|string',
                'email'                        => 'required|string'
            ]);
        }

        if ($validator->fails()) {
            $error = true;
            $errors = $validator->errors();
        }

        return ["error" => $error, "errors" => $errors];
    }

   

    
    public function check_tn_number($tn_number, $tn_uuid)
    {

        $get_booking_id = ManageBookings::where('uuid', $tn_uuid)->where('deleted_at', '=', null)->first();
        $get_tn_number = AcountsPayment::where('transaction_ref', $tn_number)->where('booking_id', null)->where('invoice_id', null)->where('deleted_at', '=', null)->first();
        if ($get_tn_number != null) {
            $get_inv_id = BookingInvoice::where('booking_id', $get_booking_id->id)->where('document_type', 'booking')->where('deleted_at', '=', null)->first();

            $final = AcountsPayment::where('transaction_ref', $tn_number)->limit(1)->update(array('invoice_id' => $get_inv_id->id, 'booking_id' => $get_inv_id->booking_id));

            AmountTransaction::where('transaction_ref', $tn_number)->limit(1)->update(array('invoice_id' => $get_inv_id->id));

            Transaction::where('tran_ref', $tn_number)->limit(1)->update(array('invoice_id' => $get_inv_id->id, 'booking_id' => $get_inv_id->booking_id));

            ManageBookings::where('uuid', $tn_uuid)->limit(1)->update(array('booking_status' => '3'));
        } else {
            $final = null;
        }
        echo json_encode($final);
        die;
    }

    public function customer_details($org_id)
    {
             
        // $get_data=Customer::with('user')->whereHas('user', function ($q) use ($org_id) {
        //     $q->where('organisation_id', $org_id);
        // })->get();
        $get_data = User::where('id', $org_id)->where('deleted_at', '=', null)->first();
        echo json_encode($get_data);
        die;
		// ?>
		// <option  value="">     </option>
		// <?php
		// foreach($get_data as $data)
	    //   {
		// 	?>
		// 	<option value="<?php echo $data->id ?>" > <?php echo $data->fullname ?></option>	
		// 	<?php		
	    //   }	    
	 
    }


    public function customer_auto_suggestion(Request $request)
    {
        if ($request->ajax()) {
            if($request->name != null)
            {
                $data = User::where('fullname','LIKE',$request->name.'%')->where('usertype', 2)->get();
                $output = '';
                if (count($data)>0) {
                    $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                    foreach ($data as $row) {
                        $output .= '<li class="list-group-item" data-id='.$row->id.'>'.$row->fullname.'</li>';
                    }
                    $output .= '</ul>';
                }else {
                    $output .= '<li class="list-group-item">'.'No Data Found'.'</li>';
                }
                return $output;
            }
        }
    }
}
