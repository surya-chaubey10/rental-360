<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
{
    public function index()
    {

        $receipt_data = Booking::with('vehicle','customer.user')
         ->withoutGlobalScope('organisation_id')
         ->where('bookings.organisation_id', getUser()->organisation_id)
         ->first();

        return view('booking.receipt.list',compact('receipt_data'));
    }

     // invoice print App
     public function print()
     {
         $pageConfigs = ['pageHeader' => false];

         $receipt_data = Booking::with('vehicle','customer.user')
         ->withoutGlobalScope('organisation_id')
         ->where('bookings.organisation_id', getUser()->organisation_id)
         ->first();

         return view('/booking.receipt.receipt-print', ['pageConfigs' => $pageConfigs,'receipt_data'=>$receipt_data]);
     }

}
