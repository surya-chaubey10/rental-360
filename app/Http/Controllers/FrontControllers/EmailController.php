<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
 
use App\Mail\SendMail; 
use Illuminate\Support\Facades\Mail;
use App\Models\Email;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class EmailController extends Controller
{
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
         return view('contact.email.email');   
        
    }

    public function send_message($uuid)
     {
        
       // $get_customer=Customer::where('id','=','user_id')->where('status','=',1)->get();
        //$get_user=User::where('status','=',1)->get();
        $datas=  DB::table('manage_bookings') 
        ->leftjoin('booking_invoices','manage_bookings.uuid','=','booking_invoices.booking_uuid')
        ->select('manage_bookings.*','booking_invoices.grand_total','booking_invoices.short_link')
        ->where('manage_bookings.uuid', $uuid)->first(); 
       
          $get_customer=DB::table('users')->where('id', $datas->customer_id)->first();  
         
           $data = array(
                'dear'         =>'Dear',
                'msg'          =>'Please find below your payment link:',
                'amount_msg'   =>'Total Amount is :',
                'name'         =>  $get_customer->fullname,
                'email'        =>  $get_customer->email,
                'mobile'       =>  $get_customer->mobile,
                'amount'       =>  $datas->grand_total,
            'short_link'      =>  $datas->short_link,
                
            );  
             // dd($data['msg']);
            
           Mail::to($get_customer->email)->send(new SendMail($data));   
          
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        //
    }
}
