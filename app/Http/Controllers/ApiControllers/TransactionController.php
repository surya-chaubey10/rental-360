<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
// use App\Models\LoginLog;
use App\Models\User;
use App\Models\AmountTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
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
        $transaction= AmountTransaction::select('amount_transactions.name','transaction.*')
        ->join('transactions as transaction', function ($join) {
            $join->on('transaction.invoice_id', '=', 'amount_transactions.invoice_id');
        })
        ->withoutGlobalScope('organisation_id')
        ->orderBy('amount_transactions.id', 'desc') 
        ->get();

        $fleet_array = array();

        if (is_object($transaction)) {
            foreach ($transaction as $key => $fleet1) {
                $fleet_array[] = $transaction[$key];
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

        return prepareResult(true, $data_array, [], "Transaction listing", $this->success, $pagination);


    }

    public function marketFleet()
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

        return prepareResult(true, $data_array, [], "Fleet listing", $this->success, $pagination);


    }




}