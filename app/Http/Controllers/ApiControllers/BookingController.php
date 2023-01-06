<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
// use App\Models\LoginLog;
use App\Models\User;
use App\Models\ManageBookings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

class BookingController extends Controller
{

    public function validations($input, $type)
    {
        $errors = [];
        $error = false;

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if (!$this->isAuthorized) {
             return prepareResult(false, [], ["error" => "User not authenticate"], "User not authenticate.", $this->unauthorized);
         }
       /*  pre(auth('sanctum')->user()->organisation_id); */
        $booking =  ManageBookings::select(
            DB::raw('CONCAT("1000", manage_bookings.id) as booking_id'),
            'manage_bookings.id',
            'manage_bookings.driver_id as driver_name',
            'manage_bookings.pickup_date_time',
            'manage_bookings.dropoff_date_time',
            'manage_bookings.pickup_address',
            'manage_bookings.dropoff_address',
            'manage_bookings.status  as  pay_status', 
            'manage_bookings.booking_status',
            'manage_bookings.payment_mode',
            'manage_bookings.amount as price', 
            'manage_bookings.number_of_tavellers', 
            'user.fullname as customer_name',
            'user.mobile as mobile',
            'vehicle_brands.brand_name'
        )
            ->join('users as user', function ($join) {
                $join->on('user.id', '=', 'manage_bookings.customer_id');
            })
            ->leftjoin('vehicle_brands', function ($join) {
                $join->on('vehicle_brands.id', '=', 'manage_bookings.brand_id'); 
            })->leftjoin('booking_invoices', function ($join) {
                $join->on('booking_invoices.booking_id', '=', 'manage_bookings.id');
            })
            ->where('manage_bookings.organisation_id', auth('sanctum')->user()->organisation_id)
            ->where('user.usertype', 2)
            ->where('booking_invoices.document_type', '=', 'booking')  
            ->get();
  
        $fleet_array = array();

        if (is_object($booking)) {
            foreach ($booking as $key => $fleet1) {
                $fleet_array[] = $booking[$key];
            }

        }

        $data_array = array();
        $page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : '';
        $limit = (isset($_REQUEST['page_size'])) ? $_REQUEST['page_size'] : '';
        $pagination = array();
        if ($page != '' && $limit != '') {
            $offset = ($page - 1) * $limit;
            for ($i = 0; $i < $limit; $i++) {
                if (isset($fleet_array[$offset])) {
                    $data_array[] = $fleet_array[$offset];
                }
                $offset++;
            }

            $pagination['total_pages'] = ceil(count($fleet_array) / $limit);
            $pagination['current_page'] = (int)$page;
            $pagination['total_records'] = count($fleet_array);
        } else {
            $data_array = $fleet_array;
        }

        return prepareResult(true, $data_array, [], "Booking listing", $this->success, $pagination);


    }


}