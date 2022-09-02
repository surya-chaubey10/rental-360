<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Collection;
use App\Models\Booking;

class CustomerController extends Controller
{

    public function index(){
       
        $customer = Customer::paginate(10);
        return view('contact.customer.list', ['customer' => $customer]); 
    }

    public function json_list(){

         $customer = Customer::select('id','fullname','customer_type','email','status','contact')->get();
         $details = new Collection();

         foreach ($customer as $key => $date) {

            $details->push([
                "id"             => $date->id,
                "fullname"      => $date->fullname,
                "customer_type"  => $date->customer_type,
                "email"          => $date->email,
                "contact"        => $date->contact,
                "status"         => ucfirst($date->status),
              
            ]);

         }

        return array('data' => $details);
        
    }

    public function store(Request $request)
    {
        
        $customer = new Customer;
        $customer->fullname      = $request->fullname;
        $customer->username      = $request->username;
        $customer->email         = $request->email;
        $customer->contact       = $request->contact;
        $customer->company       = $request->company;
        $customer->customer_type = $request->customer_type;
        $customer->country       = $request->country;
        $customer->save();

      
    }
}
