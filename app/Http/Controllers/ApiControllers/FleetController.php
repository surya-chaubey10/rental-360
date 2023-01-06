<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
// use App\Models\LoginLog;
use App\Models\User;
use App\Models\Fleet;
use App\Models\VehicleBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class FleetController extends Controller
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
        $fleet = Fleet::select('id','mega_discription','image','booking_conditions','documents','type','car_SKU','car_year','car_service_type','car_color','car_chasis_number','fleet_size','allowed_distance','unit','child_seat','insurence','additional_distance','owner_name','phone','email','billing_email','status','brand_id','organisation_id')
        ->with(
        'brand:id,brand_name,service_type,brand_image,status,description',
        'vehicleModel:id,model_name'
        )->where("organisation_id", auth('sanctum')->user()->organisation_id)
        ->orderBy('id', 'desc')
        ->get();


        $fleet_array = array();

        if (is_object($fleet)) {
            foreach ($fleet as $key => $fleet1) {
                $fleet_array[] = $fleet[$key];
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

        return prepareResult(true, $data_array, [], "Fleet listing", $this->success, $pagination);


    }

    public function marketFleet(Request $request)
    {
      
        if (!$this->isAuthorized) {
             return prepareResult(false, [], ["error" => "User not authenticate"], "User not authenticate.", $this->unauthorized);
         }
       /*  pre(auth('sanctum')->user()->organisation_id); */
        $fleet = Fleet::select('id','mega_discription','image','booking_conditions','documents','type','car_SKU','car_year','car_service_type','car_color','car_chasis_number','fleet_size','allowed_distance','unit','child_seat','insurence','additional_distance','owner_name','phone','email','billing_email','status','brand_id','organisation_id')
        ->with(
        'brand:id,brand_name,service_type,brand_image,status,description',
        'vehicleModel:id,model_name'
        )->where("organisation_id", '!=',auth('sanctum')->user()->organisation_id)
        ->orderBy('id', 'desc')
        ->get();


        $fleet_array = array();

        if (is_object($fleet)) {
            foreach ($fleet as $key => $fleet1) {
                $fleet_array[] = $fleet[$key];
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
        //---------------------------

        $input = $request->json()->all();

         if ($input) {


           $brand_name = (isset($input['brand_name']) ? $input['brand_name'] : '');
           $model = (isset($input['model']) ? $input['model'] : '');
           $fleet = (isset($input['fleet']) ? $input['fleet'] : '');
             

           /*  pre(auth('sanctum')->user()->organisation_id); */
            $fleet = Fleet::select('id','mega_discription','image','booking_conditions','documents','type','car_SKU','car_year','car_service_type','car_color','car_chasis_number','fleet_size','allowed_distance','unit','child_seat','insurence','additional_distance','owner_name','phone','email','billing_email','status','brand_id','organisation_id')
            ->with(
            'brand:id,brand_name,service_type,brand_image,status,description',
            'vehicleModel:id,model_name'
            )->where("car_SKU", $brand_name)->orWhere('car_SKU','like',"%{$brand_name}%")->orWhere('fleet_size','like',"%{$fleet}%")
            ->orderBy('id', 'desc')
            ->get();
            
            ////where("mega_discription", $brand_name)

            $fleet_array = array();

            if (is_object($fleet)) {
                foreach ($fleet as $key => $fleet1) {
                    $fleet_array[] = $fleet[$key];
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

            return prepareResult(true, $data_array, [], "Fleet listing", $this->success, $pagination);


        }

        //-----------------------



        return prepareResult(true, $data_array, [], "Fleet listing", $this->success, $pagination);


    }

    //listing serch ----------------------------------------


    public function advancedSearch(Request $request)
    {
        if (!$this->isAuthorized) {
             return prepareResult(false, [], ["error" => "User not authenticate"], "User not authenticate.", $this->unauthorized);
         }

        $input = $request->json()->all();

         if ($input['module'] == "brand-check") {


           $brand_name = (isset($input['mega_discription']) ? $input['mega_discription'] : '');

           /*  pre(auth('sanctum')->user()->organisation_id); */
            $fleet = Fleet::select('id','mega_discription','image','booking_conditions','documents','type','car_SKU','car_year','car_service_type','car_color','car_chasis_number','fleet_size','allowed_distance','unit','child_seat','insurence','additional_distance','owner_name','phone','email','billing_email','status','brand_id','organisation_id')
            ->with(
            'brand:id,brand_name,service_type,brand_image,status,description',
            'vehicleModel:id,model_name'
            )->where("mega_discription", $brand_name)->orWhere('mega_discription','like',"%{$brand_name}%")
            ->orderBy('id', 'desc')
            ->get();
            
            ////where("mega_discription", $brand_name)

            $fleet_array = array();

            if (is_object($fleet)) {
                foreach ($fleet as $key => $fleet1) {
                    $fleet_array[] = $fleet[$key];
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

            return prepareResult(true, $data_array, [], "Fleet listing", $this->success, $pagination);


        }


        //testing--------------------------

        if ($input['module'] == "brand") {


           $brand_name = (isset($input['brand_name']) ? $input['brand_name'] : '');

           /*  pre(auth('sanctum')->user()->organisation_id); */
            $pankaj =VehicleBrand::where("brand_name",$brand_name)->orWhere('brand_name','like',"%{$brand_name}%")->orderBy('id', 'desc')->get();


            $fleet_array = array();

            if (is_object($pankaj)) {
                foreach ($pankaj as $key => $fleet1) {
                    $fleet_array[] = $pankaj[$key];
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

            return prepareResult(true, $data_array, [], "Fleet listing", $this->success, $pagination);


        }

        //testing-----------------



        
    }
    //listing serch---------------------------


}