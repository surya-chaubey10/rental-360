<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;    
use App\Models\Event;
use App\Models\Fleet;
use App\Models\VehicleBrand;
use App\Models\CompanyActivity;
use App\Models\ManageBookings;
use App\Models\Customer;
use App\Models\User;
use App\Models\CountryMaster;
use App\Models\Organisation;
use App\Models\BookingInvoice;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class BookingCalenderController extends Controller
{
    public function index(Request $request){

        $path_set = public_path() . '/data/booking-calender-json';

        if (!file_exists($path_set)) {
            \File::makeDirectory($path_set, 0777, true, true);
        }

        if (file_exists($path_set . '/' . getUser()->organisation_id . '_events.json')) {
            \File::delete($path_set . '/' . getUser()->organisation_id . '_events.json');
        }

        if (!file_exists($path_set . '/' . getUser()->organisation_id . '_events.json')) {
            $user_set = $this->jsonCustomerList($request);
        
            $details = new Collection();
            foreach ($user_set as $key => $data) {

                $details->push([
                    "id"                 => $data->id,
                    "url"                => "",
                    "title"              => $data->name .' ,  1000'.$data->id .' , '.$data->car_SKU ,
                    "start"              => ($data->pickup_date_time." ".trim($data->pickup_time,":00")),
                    "end"                => ($data->dropoff_date_time." ".trim($data->dropoff_time,":00")),
                    "allDay"             =>  false,
                    "extendedProps"      => array('calendar' => "Business"),

                ]);
            }


            $data_set = $details;

            \File::put($path_set . '/' . getUser()->organisation_id . '_events.json', collect($data_set));
        }

        $vehicle = VehicleBrand::select('vehicle_brands.id', 'vehicle_brands.brand_name')
                    ->leftjoin('fleets', function ($join) {
                        $join->on('fleets.brand_id', '=', 'vehicle_brands.id');
                    })
                    ->where('fleets.organisation_id', getUser()->organisation_id)
                    ->groupBy('fleets.brand_id')
                    ->get();
    
        $allvehicle = VehicleBrand::select('id', 'brand_name')->get();

        $orgs_name= Organisation::select('organisations.*','country_masters.name') 
     
        ->leftjoin('country_masters as country_masters', function ($join) {
          $join->on('country_masters.id', '=', 'organisations.org_country_id');
        })
         ->where('organisations.id','=',getUser()->organisation_id)
        ->first();
            
        $fleets = Fleet::select('car_SKU', 'id','brand_id','model_id')
        ->where('status', '=', '1')
        ->where('organisation_id',getUser()->organisation_id)
        ->get();

        return view('booking.bookingCalender.booking-calender', compact('vehicle','allvehicle','orgs_name','fleets')); 
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
            'manage_bookings.pickup_time',
            'manage_bookings.dropoff_date_time',
            'manage_bookings.dropoff_time',
            'manage_bookings.pickup_address', 
            'manage_bookings.dropoff_address',
            'manage_bookings.uuid',
            'manage_bookings.payment_status  as  pay_status', 
            'manage_bookings.booking_status',
            'manage_bookings.payment_mode',
            'manage_bookings.amount',
            'manage_bookings.number_of_tavellers',
            'user.fullname as name',
            'user.mobile as mobile',
            'fleets.car_SKU',
            'vehicle_brands.brand_name as vehicle',
            //'booking_invoices.uuid as invoice_uuid',
            'booking_invoices.short_link as short_link'
        )
            ->leftjoin('users as user', function ($join) {
                $join->on('user.id', '=', 'manage_bookings.customer_id');
            })
            ->leftjoin('fleets', function ($join) {
                $join->on('fleets.id', '=', 'manage_bookings.vehicle_id');
            })
            ->leftjoin('vehicle_brands', function ($join) {
                $join->on('vehicle_brands.id', '=', 'manage_bookings.brand_id');
            })
            ->leftjoin('booking_invoices', function ($join) {
                $join->on('booking_invoices.booking_id', '=', 'manage_bookings.id')->where('booking_invoices.document_type', '=', 'booking');
            })
            ->where('manage_bookings.organisation_id', getUser()->organisation_id)
            ->where('user.usertype', 2)
            ->orderBy('manage_bookings.id', 'desc')
            ->get();
    }


    // public function get_marchantmodel_calendar($brand, $model)
    // {
    //     // dd($brand, $model);
    //     $return = array();
    //     $getdata = VehicleModel::select('vehicle_models.model_name', 'vehicle_models.id')
    //     ->where('vehicle_models.brand_id', '=', $brand)
    //     ->where('vehicle_models.status', '=', '1')
    //     ->get();

    //     $return['status'] = false;
    //     $return['html'] = '<option class="opt_v1" ></option>';
    //     if (count($getdata) > 0)
    //      {
    //         $select = "";
    //         foreach ($getdata as $model_name1)
    //          {
    //             $select="";
    //             if ($model_name1->id == $model)
    //              {
    //                 $select = "selected";
    //             }

    //             $return['html'] .= '<option class="opt_v1" ' . $select . ' value="' . $model_name1->id . '">' . $model_name1->model_name;
    //             $return['html'] .= "</option>";
    //         }
    //         $return['status'] = true;
    //     }
    //      return response()->json($return);
    // }

   //  public function get_calender(){
    
   //      //calling json callender
   //      //$event = Event::all();
   //      //dd($event->title);
   //      $data = [
   //      "id" => 3,
   //      "url"=> "",

   //      "title" => "Pankaj",
   //      "start" => "2022-11-12 05:00",
   //      "end" => "2022-11-15 07:00",
   //      "allDay" => false
         
   //  ];

   //      $d = Storage::disk('local')->put('events.json', json_encode($data));

   //      if ($d) {
   //          echo "string";
   //      }
   // }


   public function fetch(Request $request){

    

    $event = ManageBookings::select(
        'manage_bookings.id',
        'manage_bookings.is_created_invoice',
        'manage_bookings.is_send_invoice',
        'manage_bookings.booking_code',
        'manage_bookings.driver_id',
        'manage_bookings.pickup_date_time',
        'manage_bookings.pickup_time',
        'manage_bookings.dropoff_date_time',
        'manage_bookings.dropoff_time',
        'manage_bookings.pickup_address', 
        'manage_bookings.dropoff_address',
        'manage_bookings.uuid',
        'manage_bookings.payment_status  as  pay_status', 
        'manage_bookings.booking_status',
        'manage_bookings.payment_mode',
        'manage_bookings.amount',
        'manage_bookings.number_of_tavellers',
        'user.fullname as name',
        'user.mobile as mobile',
        'fleets.car_SKU',
        // 'vehicle_brands.brand_name as vehicle',
        //'booking_invoices.uuid as invoice_uuid',
        // 'booking_invoices.short_link as short_link'
    )
        ->leftjoin('users as user', function ($join) {
            $join->on('user.id', '=', 'manage_bookings.customer_id');
        })
        ->leftjoin('fleets', function ($join) {
            $join->on('fleets.id', '=', 'manage_bookings.vehicle_id');
        })
        // ->leftjoin('vehicle_brands', function ($join) {
        //     $join->on('vehicle_brands.id', '=', 'manage_bookings.brand_id');
        // })
        // ->leftjoin('booking_invoices', function ($join) {
        //     $join->on('booking_invoices.booking_id', '=', 'manage_bookings.id')->where('booking_invoices.document_type', '=', 'booking');
        // })
        ->where('manage_bookings.organisation_id', getUser()->organisation_id)
        ->where('user.usertype', 2);

        if($request->brandId){
           
            $event->where('manage_bookings.brand_id', $request->brandId);
        }

        if($request->modelId){

            $event->where('manage_bookings.model_id', $request->modelId);
        }

        if($request->skuId){

            $event->where('manage_bookings.vehicle_id', $request->skuId);
        }

        if($request->SearchskuId){

            $event->where('manage_bookings.vehicle_id', $request->SearchskuId);
        }

        $events =  $event->orderBy('manage_bookings.id', 'desc')
        ->get();


        $eventCollection = new Collection();
            foreach ($events as $key => $data) {    
                $color = null;



                if($data->is_created_invoice == 1){
                    $color = 'grey';

                    if($data->pay_status == 'A'){
                        $color = 'red';
                    }
                    
                }else{
                    $color = 'orange';
                }

                $eventCollection->push([

                    "id"                 => $data->id,
                    "url"                => '../tabinvoice/'.$data->id,
                    "title"              => $data->name .' ,  1000'.$data->id .'  '.$data->car_SKU ,
                    "start"              => ($data->pickup_date_time." ".substr($data->pickup_time,0,-3)),
                    "end"                => ($data->dropoff_date_time." ".substr($data->dropoff_time,0,-3)),
                    "color"              => $color,

                ]);
        }



        return response()->json($eventCollection);

   }


   public function get_filter_fleet($model)
   {

        $return = array();
        $getdata = Fleet::select('car_SKU', 'id', 'is_reserved','car_number')
        ->where('model_id', '=', $model)->where('status', '=', '1')->where('organisation_id',getUser()->organisation_id)->get();

        $return['status'] = false;

        $return['html'] = '<option class="opt_v1" value=""></option>';
        
        if (count($getdata) > 0) 
        {

            foreach ($getdata as $d) 
            {
                
                $return['html'] .= '<option class="opt_v1" value="' . $d->id . '">' . $d['car_SKU'];
                $return['html'] .= "</option>";
            }
            $return['status'] = true;

            return $return;
        }

        return $return;

   }

   public function createInvoice_calender($uuid)
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
 
       return response()->json([ 'customer' => $customer,  'vat' => $vat, 'total' => $total, 'period' => $period,  'unitprice' => $unitprice,
          'uuid' => $uuid,  'customer_details' => $customer_details,  'country' => $country,  'booked' => $booked,  'brand' => $brand,
          'brand_vehicle' => $brand_vehicle, 'diffDays' => $diffDays,  'diffHour' => $diffHour,  'sku' => $sku,  'price' => $price ]);
    }

    public function bookingcalendarpreview($uuid)
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
        return response()->json([ 'get_data' => $get_data,  'get_details' => $get_details]);
        
    }


    // public function fleets_auto_suggestion(Request $request)
    // {
        
    //     if ($request->ajax())
    //      { 
    //         if($request->name != null)
    //         {  
    //             // $data = User::where('is_deleted','=','0')
    //             //  ->where(function ($query) use ($request)
    //             //   {
    //             //     $query->where('fullname','LIKE',$request->name.'%')
    //             //     ->orWhere('mobile','LIKE',$request->name.'%')
    //             //     ->orWhere('email','LIKE',$request->name.'%');
    //             //    })->where('usertype',2)->get();
 

    //             $data = Fleet::select('car_SKU', 'id', 'is_reserved','car_number')
    //             ->where('status', '=', '1')
    //             ->where(function ($query) use ($request)
    //                 {
    //                     $query->where('car_SKU','LIKE',$request->name.'%');
    //                 })
    //             ->where('organisation_id',getUser()->organisation_id)
    //             ->get();


                 
    //             $output = '';
    //             if (count($data)>0)
    //              {
    //                 $output = '<ul id="fleet_ul" class="list-group" style="display: block; position: relative; z-index: 1">';
    //                 foreach ($data as $row)
    //                  {
    //                     $output .= '<li class="list-group-item" data-id='.$row->id.'>'.$row->car_SKU.'</li>';
    //                 }
    //                 $output .= '</ul>';
    //             }
    //             else
    //              {
    //                 $output .= '<li class="list-group-item">'.'No Data Found'.'</li>';
    //             }
    //             return $output;
    //         }
    //     }
    // }

}
