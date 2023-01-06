<?php

namespace App\Http\Controllers\FrontControllers;
use App\Http\Controllers\Controller;
use App\Models\VendorModel;
use App\Models\User;
use App\Models\Country;
use App\Models\CustomerType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;  

class VendorController extends Controller
{
    public function vendorList()
    {   
        $country = Country::select('id','name')->get();
        $customer_type = CustomerType::select('id','type_name')->get();

        $vendors_total= DB::table('vendors')
        ->selectRaw('count(*) as total')
        ->selectRaw("count(case when approval_status = 'Pending' then 1 end) as pending")
        ->selectRaw("count(case when approval_status = 'Active' then 1 end) as active")
        ->selectRaw("count(case when approval_status = 'Inactive' then 1 end) as inactive")
        ->first();

        $pageConfigs = ['pageHeader' => false];

        $path = public_path() . '/data/vendor-json';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (file_exists($path . '/' . getUser()->organisation_id . '_vendor-list.json')) {
            \File::delete($path . '/' . getUser()->organisation_id . '_vendor-list.json');
        }

        if (!file_exists($path . '/' . getUser()->organisation_id . '_vendor-list.json')) {
            $user = $this->jsonCustomerList();
            $data = array('data' => $user);
            \File::put($path . '/' . getUser()->organisation_id . '_vendor-list.json', collect($data));
        }
        
       
       /*  return view('contact.vendor.list', ['pageConfigs' => $pageConfigs, 'country' => $country, 'customer_type' => $customer_type,'customer_count' => $customer_total,]); */
        
        return view('contact.vendor.list',compact('country','customer_type','vendors_total'));   
    }
    
    private function jsonCustomerList()
    {
        return VendorModel::select('vendors.id', 'vendors.uuid', 'roles.name as role', 'user.fullname', 'user.mobile as contact', 'user.email', 'user.mobile', 'vendors.approval_status as status', 'cust_type.type_name as customer_type')
            ->join('users as user', function ($join) {
                $join->on('user.id', '=', 'vendors.user_id');
            })
            ->leftjoin('default_roles as roles', function ($join) {
                $join->on('roles.id', '=', 'user.role_id');
            })
            ->leftjoin('customer_types as cust_type', function ($join) {
                $join->on('cust_type.id', '=', 'vendors.customer_type');
            })
            ->withoutGlobalScope('organisation_id')
            ->where('vendors.organisation_id', getUser()->organisation_id)
            ->where('user.usertype', 3)
            ->where('user.is_deleted','=','0') 
            ->where('vendors.is_deleted','=','0') 

            ->orderBy('vendors.id', 'desc') 
            ->get();
    }
  

    public function ajax_list_data()
    {   
        $vendor = VendorModel::with('customer_typee','user')->get();
         
        $details = new Collection(); 
         foreach ($vendor as $key => $date) {
 
            $details->push([
                "id"                => $date->id,
                "uuid"              => $date->uuid, 
                "fullname"          => $date->user->fullname,
                "customer_type"     => $date->customer_typee->type_name,
                "email"             => $date->user->email,
                "contact"           => $date->user->mobile,
                "status"            => $date->status,
            ]); 
         } 

        return array('data' => $details);
    } 
    public function store(Request $request)
    {
     DB::beginTransaction();
         try{
            $input = $request->all();
            $validate = $this->validations($input, "add");
            if ($validate["error"]) {
             
               return ajax_response(false, [],$validate['errors']->first(), "Error while validating vendor", $this->success);
            }
                $user = new User;
                $user->fullname      = $request->fullname;
                $user->username      = $request->username;
                $user->email         = $request->email;
                $user->mobile        = $request->contact;
                $user->usertype      = 3;
                $user->api_token = \Str::random(35);
                $user->password      = \Hash::make('123456');
                $user->country_id       = $request->country;
                $user->save();
                
                $vendor = new VendorModel;
                $vendor->company       = $request->company;
                $vendor->customer_type = $request->customer_type;
                $vendor->user_id = $user->id;
                $vendor->save();

            DB::commit();
            return ajax_response(true, $vendor, [], "Vendor Saved Successfully", $this->success);
         }
         catch(\Exception $e){
             DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false,[], [], $message , $this->internal_server_error);
         }
        
    }
    private function validations($input, $type)
    {
      $validator = [];
      $errors = [];
      $error = false;
      if ($type == "add") {
          $validator = Validator::make($input, [
              'fullname'         => 'required',
              'username'          => 'required',
               'email'            => 'required',
              'contact'             => 'required',
              'company'             => 'required',
              'customer_type'             => 'required',
              'country'           => 'required' 
          ]);
      }

      if ($validator->fails()) {
          $error = true;
          $errors = $validator->errors();
      }

      return ["error" => $error, "errors" => $errors];
  }

    public function view($uuid){
        $vendor = VendorModel::with('customer_typee','user.country')->where('vendors.uuid',$uuid)->first();
        return view('contact.vendor.view',compact('vendor'));    
       
   }
  //Edit And Update the Customer Data 
  public function vendorEdit($uuid)
  { 
      
    $vendor = VendorModel::with('customer_typee','user.country')->where('vendors.uuid',$uuid)->first();
    $country = Country::select('id','name')->get();
    $customer_type = CustomerType::select('id','type_name')->get();

    /* $contact_option =  explode(',',$customer->contact_option); 
    $customer = Customer::where('uuid',$uuid)->first(); 
    $user_id = $customer->user_id; 
    $user = User::find($user_id); */ 


    //   $vendor = VendorModel::where('uuid', $uuid)->first();
    //   $user_id = $vendor->user_id; 
         
    //   $user = User::find($user_id);

    //   $country = Country::select('id','name')->get();
    //   $customer_type = CustomerType::select('id','type_name')->get();
    //     $contact_option =  explode(',',$vendor->contact_option); 
      return view('contact.vendor.edit',compact('vendor','country','customer_type'));    
  } 
  public function update(Request $request)
    {   
        $language = implode(',',$request->language); 
        if($request->contact_option != null){
            $contact_option = implode(',',$request->contact_option) ;   
        }else{
            $contact_option = '';
        }
        $path = public_path('../public/images/vendor_images/');
        if (! file_exists($path) ) {
            mkdir($path, 0777, true);
         }
         $fileName=null;
        $file = $request->file('image');
        $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $fileName);
        
        \DB::beginTransaction();
        try {
            $user = User::find($request->user_updated_id);
            $user->fullname      = $request->fullname;
            $user->username      = $request->username;
            $user->email         = $request->email;
            $user->mobile        = $request->contact; 
            $user->country_id    = $request->country;
            $user->save(); 

            $vendor_updated = VendorModel::find($request->vendor_updated_id); 
            
            $vendor_updated->image            = $fileName; 
            $vendor_updated->status           = $request->status;
            $vendor_updated->customer_type    = $request->customer_type;
            $vendor_updated->Company          = $request->company;
            $vendor_updated->dob              = $request->birth_date; 
            $vendor_updated->website          = $request->website;
            $vendor_updated->language         = $language;
            $vendor_updated->gender           = $request->gender;
            $vendor_updated->contact_option   = $contact_option;
            $vendor_updated->address1         = $request->address_line1;
            $vendor_updated->address2         = $request->address_line2;
            $vendor_updated->postcode         = $request->post_code;
            $vendor_updated->city             = $request->city;
            $vendor_updated->state            = $request->state; 
            $vendor_updated->twitter          = $request->twitter;
            $vendor_updated->facebook         = $request->facebook;
            $vendor_updated->instagram        = $request->instagram;
            $vendor_updated->github           = $request->github;
            $vendor_updated->codepen          = $request->codepen;
            $vendor_updated->stack            = $request->stack;
 
            $vendor_updated->save(); 
 
            \DB::commit();  
            return ajax_response(true, $vendor_updated, [], "Vendor Update Successfully", $this->success);
        } catch (\Exception $exception) {
            \DB::rollback();
            $message = $exception->getMessage();

            return ajax_response(false, $message, [],  "Vendor Update Unsuccessfully", $this->internal_server_error);
        } catch (\Throwable $exception) {
            \DB::rollback();
            $message = $exception->getMessage();

            return ajax_response(false, $message, [],  "Vendor Update Unsuccessfully", $this->internal_server_error);

        } 
    } 
    public function destroy($uuid)
    {
     
        $vendor_delete = VendorModel::where('uuid', $uuid)->first();
        $vendor_delete->is_deleted    ='1';
        $vendor_delete->save(); 
        $vendor_delete->user_id;
        

        DB::table('users')
        ->where('id', $vendor_delete->user_id)  
        ->limit(1)   
        ->update(array('is_deleted' =>'1'));  
        // $user = $vendor_delete->user; 

        // if (is_object($user)) {
        //     $user->delete();
        //     $vendor_delete->delete();
        //     return prepareResult(true, [], [], "Record delete successfully", $this->success);
        // }

        return ajax_response(true, [], [], "Vendor Deleted Successfully", $this->success);

    }
} 
