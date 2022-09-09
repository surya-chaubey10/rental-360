<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Collection;
use App\Models\User;
use App\Models\Country;
use App\Models\CountryMaster;
use App\Models\CustomerType;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        if (checkPermission('customer-list')) {
            return redirect(route('dashboard'))->withErrors(['msg' => 'You do not have required authorization.']);
        }

        $country = CountryMaster::select('id', 'name')->get();
        $customer_type = CustomerType::select('id', 'type_name')->get();

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

        return view('contact.customer.list', ['pageConfigs' => $pageConfigs, 'country' => $country, 'customer_type' => $customer_type]);
    }

    private function jsonCustomerList()
    {
        return Customer::select('customers.id', 'customers.uuid', 'roles.name as role', 'user.fullname', 'user.mobile as contact', 'user.email', 'user.mobile', 'customers.approval_status as status', 'cust_type.type_name as customer_type')
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

        DB::beginTransaction();
        try {
            $user = new User;
            $user->fullname      = $request->fullname;
            $user->username      = $request->username;
            $user->email         = $request->email;
            $user->usertype      = 2;
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

    public function edit($uuid)
    {
        $customers = Customer::with('customer_typee', 'user.country')
            ->where('customers.uuid', $uuid)
            ->first();

        $country = Country::select('id', 'name')->get();

        $customer_type = CustomerType::select('id', 'type_name')->get();

        return view('contact.customer.edit', compact('country', 'customer_type', 'customers'));
    }

    public function update(Request $request)
    {

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
        \DB::beginTransaction();
        try {
            $user = User::find($request->user_updated_id);
            $user->fullname      = $request->fullname;
            $user->username      = $request->username;
            $user->email         = $request->email;
            $user->mobile        = $request->contact;
            $user->country_id    = $request->country;
            $user->save();

            $Customer_updated = Customer::find($request->customer_updated_id);

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

            $Customer_updated->save();

            \DB::commit();
            return ajax_response(true, $Customer_updated, [], "Customer Update Successfully", $this->success);
        } catch (\Exception $exception) {
            \DB::rollback();
            $message = $exception->getMessage();
            return ajax_response(false, $message, [],  "Customer Update Unsuccessfully", $this->internal_server_error);
        } catch (\Throwable $exception) {
            \DB::rollback();
            $message = $exception->getMessage();
            return ajax_response(false, $message, [],  "Customer Update Unsuccessfully", $this->internal_server_error);
        }
    }

    public function show($uuid)
    {
        $customer = Customer::with('customer_typee', 'user.country')->where('customers.uuid', $uuid)->first();

        return view('contact.customer.app-user-view-account', compact('customer'));
    }

    public function destroy($uuid)
    {
        $customer = Customer::where('uuid', $uuid)->first();

        if (is_object($customer)) {

            $customer->user->delete();
        }

        return ajax_response(true, [], [], "Customer Deleted Successfully", $this->success);
    }
}
