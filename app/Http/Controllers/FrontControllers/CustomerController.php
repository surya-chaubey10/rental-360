<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Collection;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{

    public function index(){
       
        
        return view('contact.customer.list'); 
    }

    public function json_list(){

         $customer = Customer::with('user')->get();

         $details = new Collection();

         foreach ($customer as $key => $date) {

            $details->push([
                "id"             => $date->id,
                "fullname"      => $date->user->fullname,
                "customer_type"  => $date->customer_type,
                "email"          => $date->user->email,
                "contact"        => $date->user->mobile,
                "status"         => $date->approval_status,
              
            ]);

         }
        return array('data' => $details);
        
    }

    public function store(Request $request)
    {
     DB::beginTransaction();
         try{
                $user = new User;
                $user->fullname      = $request->fullname;
                $user->username      = $request->username;
                $user->email         = $request->email;
                $user->mobile        = $request->contact;
                $user->api_token = \Str::random(35);
                $user->password      = \Hash::make('123456');
                $user->country_id       = $request->country;
                $user->save();
                
                $customer = new Customer;
                $customer->company       = $request->company;
                $customer->customer_type = $request->customer_type;
                $customer->user_id = $user->id;
                $customer->save();

            DB::commit();
            return ajax_response(true, $customer, [], "Customer Saved Successfully", $this->success);
         }
         catch(\Exception $e){
             DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false,[], [], $message , $this->internal_server_error);
         }
        
    }
}
