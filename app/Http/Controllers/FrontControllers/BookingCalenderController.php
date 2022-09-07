<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BookingCalenderController extends Controller
{
    public function index(){
    
         return view('booking.bookingCalender.booking-calender'); 
    }
    public function get_calender(){
    
        //calling json callender
   }
}
