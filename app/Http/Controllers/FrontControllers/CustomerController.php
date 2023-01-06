<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Imports\ImportCustomer;
use Illuminate\Support\Collection;
use App\Models\User;
use App\Models\Country;
use App\Models\CountryMaster;
use App\Models\Notifications;
use App\Models\CustomerType;
use App\Models\CompanyActivity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator; 
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

class CustomerController extends Controller
{
    public function index()
    {
       /*  if (checkPermission('customer-list')) {
            return redirect(route('dashboard'))->withErrors(['msg' => 'You do not have required authorization.']);
        } */

        $country = CountryMaster::select('id', 'name')->get();
        $customer_type = CustomerType::select('id', 'type_name')->get();

        $customer_total= DB::table('customers')
                ->selectRaw('count(*) as total')
                ->selectRaw("count(case when approval_status = 'Pending' then 1 end) as pending")
                ->selectRaw("count(case when approval_status = 'Active' then 1 end) as active")
                ->selectRaw("count(case when approval_status = 'Inactive' then 1 end) as inactive")
                ->where('customers.organisation_id', getUser()->organisation_id)
                ->first();
            
        $pageConfigs = ['pageHeader' => false];

        $path = public_path() . '/data/customer-json';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (file_exists($path . '/' . getUser()->organisation_id . '_customer-list.json')) {
            \File::delete($path . '/' . getUser()->organisation_id . '_customer-list.json');
        }

        if (!file_exists($path . '/' . getUser()->organisation_id . '_customer-list.json')) {
            $user = $this->jsonCustomerList();
            $data = array('data' => $user);
            \File::put($path . '/' . getUser()->organisation_id . '_customer-list.json', collect($data));
        }

       
        return view('contact.customer.list', ['pageConfigs' => $pageConfigs, 'country' => $country, 'customer_type' => $customer_type,'customer_count' => $customer_total,]);
    }

    private function jsonCustomerList()
    {
        return Customer::select('customers.id', 'customers.uuid', 'roles.name as role', 'user.fullname', 'user.mobile as contact', 'user.email', 'user.mobile', 'customers.status as status', 'cust_type.type_name as customer_type')
            ->join('users as user', function ($join) {
                $join->on('user.id', '=', 'customers.user_id');
            })
            ->leftjoin('default_roles as roles', function ($join) {
                $join->on('roles.id', '=', 'user.role_id');
            })
            ->leftjoin('customer_types as cust_type', function ($join) {
                $join->on('cust_type.id', '=', 'customers.customer_type');
            })
            ->withoutGlobalScope('organisation_id')
            ->where('customers.organisation_id', getUser()->organisation_id)
            ->where('user.usertype', 2)
            ->where('user.is_deleted','=','0')   
            ->where('customers.is_deleted','=','0')   
            ->orderBy('customers.id', 'desc') 
            ->get();
    }

    public function json_list()
    {
        $customer = Customer::with('customer_typee', 'user')->get();

        $details = new Collection();
        foreach ($customer as $key => $date) {

            $details->push([
                "id"             => $date->id,
                "uuid"           => $date->uuid,
                "fullname"       => ($date->user ?  $date->user->fullname : ''),
                "customer_type"  => ($date->customer_typee ? $date->customer_typee->type_name : ''),
                "email"          => ($date->user ? $date->user->email : ''),
                "contact"        => ($date->user ? $date->user->mobile : ''),
                "status"         => $date->approval_status,
            ]);
        }

        return array('data' => $details);
    }

    public function store(Request $request)
    {
        $created_user=getUser();
        DB::beginTransaction();
        try {
            $input = $request->all();
            $validate = $this->validations($input, "add");
            if ($validate["error"]) {
             
               return ajax_response(false, [],$validate['errors']->first(), "Error while validating customer", $this->success);
            }
            $user = new User;
            $user->fullname      = $request->fullname;
            $user->username      = $request->username;
            $user->email         = $request->email;
            $user->usertype      = 2;
            $user->mobile        = $request->contact;
            $user->created_user        =  $created_user->id;
            $user->api_token = \Str::random(35);
            $user->password      = \Hash::make('123456');
            $user->country_id       = $request->country;
            $user->save();

            $customer = new Customer;
            $customer->company       = $request->company;
            $customer->customer_type = $request->customer_type;
            $customer->user_id = $user->id;
            $customer->created_user        =  $created_user->id;
            $customer->save();

            $notifications = new Notifications;
            $notifications->messages          = "Customer created by ".getUser()->fullname; 
            $notifications->read              = '0';
            $notifications->unread            = '1';
            $notifications->user_id           = getUser()->id;
            $notifications->organisation_id   = getUser()->organisation_id;
            $notifications->url               = 'customer-view/';
            $notifications->notification_id   = $customer->uuid;
            $notifications->save();

            $adminactivity = new CompanyActivity;
            $adminactivity->messages          = 'Customer created by '.getUser()->fullname;
            $adminactivity->created_user      = getUser()->id;
            $adminactivity->organisation_id   = getUser()->organisation_id;
            $adminactivity->save();

            DB::commit();
            return ajax_response(true, $customer, [], "Customer Saved Successfully", $this->success);
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
        } catch (\Throwable $e) {
            DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false, [], [], $message, $this->internal_server_error);
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


    public function edit($uuid)
    {
        // $customers = Customer::with('customer_typee', 'user.country','user')
        //     ->where('customers.uuid', $uuid)
        //     ->first();
        $customers= Customer::select('customers.*','roles.name as role', 'user.fullname','user.username','user.mobile as contact', 'user.email', 'user.mobile', 'cust_type.type_name as customer_type')
                   ->join('users as user', function ($join) {
                     $join->on('user.id', '=', 'customers.user_id');
                    })
                    ->leftjoin('default_roles as roles', function ($join) {
                        $join->on('roles.id', '=', 'user.role_id');
                    })
                    ->leftjoin('customer_types as cust_type', function ($join) {
                        $join->on('cust_type.id', '=', 'customers.customer_type');
                    })
                    ->withoutGlobalScope('organisation_id')
                    ->where('customers.organisation_id', getUser()->organisation_id)
                    ->where('customers.uuid', $uuid)
                    ->get()->first();

        $country = Country::select('id', 'name')->get();

        $customer_type = CustomerType::select('id', 'type_name')->get();

        return view('contact.customer.edit', compact('country', 'customer_type', 'customers'));
    }

    public function update(Request $request)
    {
        //  dd($request);
        $created_user=getUser();
        if ($request->language != null) {
            $language = implode(',', $request->language);
        } else {
            $language = null;
        }


        if ($request->contact_option != null) {
            $contact_option = implode(',', $request->contact_option);
        } else {
            $contact_option = null;
        }

        $path = public_path('../public/images/customer_images/');
        if (! file_exists($path) ) {
            mkdir($path, 0777, true);
         }

        $file = $request->file('image');
        $fileName='';
        if($file!=''){
            $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($path, $fileName);
        }
        

        \DB::beginTransaction(); 
        try {

            $user = User::find($request->user_updated_id);
            $user->fullname      = $request->fullname;
            $user->username      = $request->username;
            $user->email         = $request->email;
            $user->mobile        = $request->contact;
           /*  $user->country_id    = $request->country; */ 
          
            $user->save();

            $Customer_updated = Customer::find($request->customer_updated_id);

            $Customer_updated->image            = $fileName; 
            $Customer_updated->status           = $request->status;
            $Customer_updated->customer_type    = $request->customer_type;
            $Customer_updated->Company          = $request->company;
            $Customer_updated->dob              = $request->birth_date;
            $Customer_updated->website          = $request->website;
            $Customer_updated->language         = $language;
            $Customer_updated->gender           = $request->gender;
            $Customer_updated->contact_option   = $contact_option;
            $Customer_updated->address1         = $request->address_line1;
            $Customer_updated->address2         = $request->address_line2;
            $Customer_updated->postcode         = $request->post_code;
            $Customer_updated->city             = $request->city;
            $Customer_updated->state            = $request->state;
            $Customer_updated->twitter          = $request->twitter;
            $Customer_updated->facebook         = $request->facebook;
            $Customer_updated->instagram        = $request->instagram;
            $Customer_updated->github           = $request->github;
            $Customer_updated->codepen          = $request->codepen;
            $Customer_updated->stack            = $request->stack;
            $Customer_updated->updated_user     = $created_user->id;

            $Customer_updated->save();
            $notifications = new Notifications;
            $notifications->messages          = "Customer Updated by ".getUser()->fullname; 
            $notifications->read              = '0';
            $notifications->unread            = '1';
            $notifications->user_id           = getUser()->id;
            $notifications->organisation_id   = getUser()->organisation_id;
            $notifications->url               = 'customer-view/';
            $notifications->notification_id   = $Customer_updated->uuid;
            $notifications->save();
            $adminactivity = new CompanyActivity;
            $adminactivity->messages          = 'Customer updated by '.getUser()->fullname;
            $adminactivity->created_user      = getUser()->id;
            $adminactivity->organisation_id   = getUser()->organisation_id;
            $adminactivity->save();

            \DB::commit();
            return ajax_response(true, $Customer_updated, [], "Customer Update Successfully", $this->success);
        } catch (\Throwable $exception) {
            \DB::rollback();
            $message = $exception->getMessage();
            return ajax_response(false, $message, [],  "Customer Update Unsuccessfully", $this->internal_server_error);
        }
    }

    public function show($uuid)
    {
        $customer= Customer::select('customers.*','roles.name as role', 'user.fullname','user.username','user.mobile as contact', 'user.email', 'user.mobile', 'cust_type.type_name as customer_type','country.name as country')
        ->join('users as user', function ($join) {
          $join->on('user.id', '=', 'customers.user_id');
         })
         ->leftjoin('default_roles as roles', function ($join) {
             $join->on('roles.id', '=', 'user.role_id');
         })
         ->leftjoin('customer_types as cust_type', function ($join) {
             $join->on('cust_type.id', '=', 'customers.customer_type');
         })
         ->leftjoin('country_masters as country', function ($join) {
            $join->on('country.id', '=', 'user.country_id');
        })
         ->withoutGlobalScope('organisation_id')
         ->where('customers.organisation_id', getUser()->organisation_id)
         ->where('customers.uuid', $uuid)
         ->get()->first();

        //$customer = Customer::with('customer_typee', 'user.country')->where('customers.uuid', $uuid)->first();

        return view('contact.customer.app-user-view-account', compact('customer'));
    }

    public function destroy($uuid)
    {
        $customer = Customer::where('uuid', $uuid)->first();
        $customer->is_deleted    ='1';
        $customer->save(); 
        $customer->user_id;
        

        DB::table('users')
        ->where('id', $customer->user_id) 
        ->limit(1)   
        ->update(array('is_deleted' =>'1'));  

        $adminactivity = new CompanyActivity;
        $adminactivity->messages          = 'Customer deleted by '.getUser()->fullname;
        $adminactivity->created_user      = getUser()->id;
        $adminactivity->organisation_id   = getUser()->organisation_id;
        $adminactivity->save();
        
        // if (is_object($customer)) {   
        //     $customer->delete();
        //     $customer->user->delete();
        // }

        return ajax_response(true, [], [], "Customer Deleted Successfully", $this->success);
    }
    public function importcustomers(Request $request)
    {

        $request->validate([
            'file' => 'required|max:50000|mimes:xlsx,excel',
        ]);

        if ($request->hasfile('file')) {
            $extensions = array("xls", "xlsx", "csv");

            $excel_headers = array();
            $result = array($request->file('file')->getClientOriginalExtension());

            if (in_array($result[0], $extensions)) {
                $excel_data = Excel::toArray(new ImportCustomer, $request->file('file'));

                $data = $excel_data[0];

                $header_reader = (new HeadingRowImport())->toArray($request->file('file'));
                // dd($header_reader);
                if (count($header_reader[0][0]) > 0) {
                    $aHeaderRow = $header_reader[0][0];
                    foreach ($aHeaderRow as $vHeaderRow) {
                        $excel_headers[] = strtolower($vHeaderRow);

                    }
                    $aheadeError = [];
                    if (!empty($excel_headers) && (!in_array('username', $excel_headers, true))) {
                        $head_err = 'Username name header is missing.';
                        $aheadeError[]['username'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('fullname', $excel_headers, true))) {
                        $head_err = 'Full Name header is missing.';
                        $aheadeError[]['fullname'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('email', $excel_headers, true))) {
                        $head_err = 'email header is missing.';
                        $aheadeError[]['email'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('customer_type', $excel_headers, true))) {
                        $head_err = 'Customer header is missing.';
                        $aheadeError[]['customer_type'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('company', $excel_headers, true))) {
                        $head_err = 'Company header is missing.';
                        $aheadeError[]['company'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('birth_date', $excel_headers, true))) {
                        $head_err = 'Date of birth header is missing.';
                        $aheadeError[]['birth_date'] = $head_err;
                    }

                    if (!empty($excel_headers) && (!in_array('website', $excel_headers, true))) {
                        $head_err = 'Website header is missing.';
                        $aheadeError[]['website'] = $head_err;
                    }

                    if (!empty($excel_headers) && (!in_array('language', $excel_headers, true))) {
                        $head_err = 'language header is missing.';
                        $aheadeError[]['language'] = $head_err;
                    }

                    if (!empty($excel_headers) && (!in_array('address1', $excel_headers, true))) {
                        $head_err = 'Address1 header is missing.';
                        $aheadeError[]['address1'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('address2', $excel_headers, true))) {
                        $head_err = 'Salutation CEO header is missing.';
                        $aheadeError[]['address2'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('city', $excel_headers, true))) {
                        $head_err = 'City header is missing.';
                        $aheadeError[]['city'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('postcode', $excel_headers, true))) {
                        $head_err = 'Postal code header is missing.';
                        $aheadeError[]['postcode'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('country', $excel_headers, true))) {
                        $head_err = 'Country header is missing.';
                        $aheadeError[]['country'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('state', $excel_headers, true))) {
                        $head_err = 'State header is missing.';
                        $aheadeError[]['state'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('facebook', $excel_headers, true))) {
                        $head_err = 'Facebook header is missing.';
                        $aheadeError[]['facebook'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('twitter', $excel_headers, true))) {
                        $head_err = 'Twitter header is missing.';
                        $aheadeError[]['twitter'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('instagram', $excel_headers, true))) {
                        $head_err = 'Instagram header is missing.';
                        $aheadeError[]['instagram'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('github', $excel_headers, true))) {
                        $head_err = 'Github header is missing.';
                        $aheadeError[]['github'] = $head_err;
                    }
                    if (!empty($excel_headers) && (!in_array('codepen', $excel_headers, true))) {
                        $head_err = 'Codepen header is missing.';
                        $aheadeError[]['codepen'] = $head_err;
                    }

                    if (count($aheadeError)) {
                        return redirect()->back()->withErrors($aheadeError);
                    }
                    if (isset($excel_data) && !empty($excel_data)) {
                        $data = array_filter($data, 'array_filter');
                        // dd($data);
                        $customer_details = [];

                        // dd($customer_details);
                        foreach ($data as $temp_key => $temp_value) {
                            //dd($temp_value);

                            $username = isset($temp_value['username']) ? (trim($temp_value['username'])) : '';
                            $fullname = isset($temp_value['fullname']) ? (trim($temp_value['fullname'])) : '';
                            $customer_type = isset($temp_value['customer_type']) ? (trim($temp_value['customer_type'])) : '';
                            $company = isset($temp_value['company']) ? (trim($temp_value['company'])) : '';
                            $birth_date = isset($temp_value['birth_date']) ? (trim($temp_value['birth_date'])) : '';
                            $website = isset($temp_value['website']) ? (trim($temp_value['website'])) : '';
                            $city = isset($temp_value['city']) ? (trim($temp_value['city'])) : '';
                            $postcode = isset($temp_value['postcode']) ? (trim($temp_value['postcode'])) : '';
                            $country = isset($temp_value['country']) ? (trim($temp_value['country'])) : '';
                            $language = isset($temp_value['language']) ? (trim($temp_value['language'])) : '';
                            $email = isset($temp_value['email']) ? (trim($temp_value['email'])) : '';
                            $address1 = isset($temp_value['address1']) ? (trim($temp_value['address1'])) : '';
                            $address2 = isset($temp_value['address2']) ? (trim($temp_value['address2'])) : '';
                            $state = isset($temp_value['state']) ? (trim($temp_value['state'])) : '';
                            $facebook = isset($temp_value['facebook']) ? (trim($temp_value['facebook'])) : '';
                            $twitter = isset($temp_value['twitter']) ? (trim($temp_value['twitter'])) : '';
                            $instagram = isset($temp_value['instagram']) ? (trim($temp_value['instagram'])) : '';
                            $github = isset($temp_value['github']) ? (trim($temp_value['github'])) : '';
                            $codepen = isset($temp_value['codepen']) ? (trim($temp_value['codepen'])) : '';
                            $mobile = isset($temp_value['mobile']) ? (trim($temp_value['mobile'])) : '';

                            $errorMsg = $this->checkEmptyValueValidation($username, $fullname);
                            $errorMsg = $this->checkEmptyValueValidation($company, $birth_date);
                            $errorMsg = $this->checkEmptyValueValidation($website, $city);
                            $errorMsg = $this->checkEmptyValueValidation($customer_type,$codepen);
                            $errorMsg = $this->checkEmptyValueValidation($website,$state);
                            $errorMsg = $this->checkEmptyValueValidation($country, $language);
                            $errorMsg = $this->checkEmptyValueValidation($address1, $address2);
                            $errorMsg = $this->checkEmptyValueValidation($facebook, $twitter);
                            $errorMsg = $this->checkEmptyValueValidation($state, $github);
                            $emailError = $this->checkEmailUniqValidation($email);
                            if (count($errorMsg)) {
                                return redirect()->back()->withErrors($errorMsg);
                            }
                            if (count($emailError)) {
                                return redirect()->back()->withErrors($emailError);
                            }
                            $customer_details[] = [

                                'username' => $username,
                                'fullname' => $fullname,
                                'customer_type' => $customer_type,
                                'company' => $company,
                                'birth_date' => $birth_date,
                                'website' => $website,
                                'city' => $city,
                                'mobile' => $mobile,
                                'postcode' => $postcode,
                                'country' => $country,
                                'language' => $language,
                                'email' => $email,                                
                                'address1' => $address1,
                                'address2' => $address2,
                                'state' => $state,
                                'facebook' => $facebook,
                                'twitter' => $twitter,
                                'instagram' => $instagram,
                                'github' => $github,
                                'codepen' => $codepen,

                            ];
                        }
                        // dd($customer_details);
                        $emailDuplicate = $this->checkEmailDuplicate($customer_details);
                        if (count($emailDuplicate)) {
                            return redirect()->back()->withErrors($emailDuplicate);
                        }
                        foreach ($customer_details as $details) {

                            $user = User::create([
                                'organisation_id' => getUser()->organisation_id,
                                'email' =>   $details['email'],
                                'username' =>   $details['username'],
                                'fullname' =>   $details['fullname'],
                                'mobile' =>   $details['mobile']
                            ]);


                           if($user->id){
                            $customer = Customer::create([
                                'user_id'=>  $user->id,
                                'customer_type'  =>  $details['customer_type'],
                                'organisation_id' => getUser()->organisation_id,
                                'company' =>  $details['company'],
                                'birth_date'   =>  $details['birth_date'],
                                'website' =>  $details['website'],
                                'city' =>   $details['city'],
                                'postcode' =>  $details['postcode'],
                                'country' =>  $details['country'],
                                'language' =>   $details['language'],
                                'address1' =>  $details['address1'],
                                'address2'  =>   $details['address2'],
                                'state' =>   $details['state'],
                                'facebook' =>   $details['facebook'],
                                'instagram'  =>  $details['instagram'],
                                'github'  =>  $details['github'],
                                'codepen'  =>   $details['codepen']
                            ]);
                           }



                        }
                        return redirect()->back()->with('success', __('Customer Data Upload successfully!'));
                    }
                }
            } else {
                return redirect()->back()->withErrors(['error' => 'The upload file must be a file of type: csv, xls, xlsx.']);
            }
        }

    }

    public function checkEmptyValueValidation($username, $email,)
    {
        $errorMsg = '';
        if ($username == "") {
            $errorMsg = ['username' => 'The name column can not be empty.'];
            return $errorMsg;
        } else if ($email == "") {
            $errorMsg = ['email' => 'The email column can not be empty.'];
            return $errorMsg;

        } else {
            return $errorMsg = [];
        }

    }

    // check email in customers table
    public function checkEmailUniqValidation($email)
    {
        $errorMsg = '';
        $customer = User::where('email', $email)->first();
        if ($customer) {
            $errorMsg = ['email' => 'Email already exist!'];
            return $errorMsg;
        } else {
            return $errorMsg = [];
        }
    }

    // check duplicate email in excel data
    public function checkEmailDuplicate($customer_details)
    {
        $errorMsg = '';
        $data = array_intersect_key(
            $customer_details,
            array_unique(array_column($customer_details, 'email'))
        );
        if (count($customer_details) != count($data)) {
            $errorMsg = ['email' => 'The email must be unique.'];
            return $errorMsg;
        } else {
            return $errorMsg = [];
        }
    }

    public function customertStatus($id) {

        $value = Customer::find($id);
        if($value->status== 1) {
            $value->status = 2;
        } else
        {
            $value->status=1;
        }
        if($value->save()){
        echo json_encode("success");
        }else {
        echo json_encode("failed");
        }

    }

}
