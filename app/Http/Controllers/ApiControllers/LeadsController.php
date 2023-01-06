<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
// use App\Models\LoginLog;
use App\Models\User;
use App\Models\LeadsModel;
use App\Models\LeadLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
class LeadsController extends Controller
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
        $leads = LeadsModel::select(
            'leads_models.id',
            'leads_models.first_name',
            'leads_models.last_name',
            'leads_models.mobile',
            'leads_models.source',
            'leads_models.assigned',
            'leads_models.status',
            'leads_models.created_at',
            'leads_models.comments',
            'user.fullname',
            )
          ->join('users as user', function ($join) {
            $join->on('user.id', '=', 'leads_models.assigned');
          })
          ->withoutGlobalScope('organisation_id')
         ->orderBy('leads_models.id', 'desc') 
         ->get();


        $fleet_array = array();

        if (is_object($leads)) {
            foreach ($leads as $key => $fleet1) {
                $fleet_array[] = $leads[$key];
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


    public function store(Request $request)
    {
        
        $created_user=auth('sanctum')->user()->id;
        $input = $request->all();
        $validate = $this-> leadsvalidations($input, "add");
       
        if ($validate["error"]) {
             
            return prepareResult(false, [], $validate['errors']->first(), "Error while validating signup", $this->unprocessableEntity);
         }


        DB::beginTransaction();
        try{

                $data = new LeadsModel;
                $data->first_name       = $request->first_name;
                $data->last_name        = $request->last_name;
                $data->mobile           = $request->mobile;
                $data->email            = $request->email;
                $data->source           = $request->source;
                $data->assigned         = $request->assigned;
                $data->status           = $request->status;
                $data->tags             = $request->tag;
                $data->type             = $request->type;
                $data->vehicle          = $request->brand_id;
                $data->model            = $request->model_id;
                $data->from             = $request->from;
                $data->to               = $request->to;
                $data->note             = $request->note;
                $data->twitter          = $request->twitter;
                $data->facebook         = $request->facebook;
                $data->instagram        = $request->instagram;
                $data->github           = $request->github;
                $data->codepen          = $request->codepen;
                $data->slack            = $request->slack;
                $data->created_user     =  $created_user; 
                $data->save();

                if(($data->status) && !empty($data))
                {

                    $email_exist = User::where('email',$data->email)->first();
                    if(!is_object($email_exist))
                    {

                        $user = new User;
                        $user->fullname      = $data->first_name.' '.$data->last_name;
                        $user->usertype      = 2;
                        $user->mobile        = $data->mobile;
                        $user->email         = $data->email;
                        $user->api_token     = \Str::random(35);
                        $user->password      = \Hash::make('123456');
                        $user->save();
                        
                        $Customer = new Customer;
                        $Customer->status           = 1;
                        $Customer->twitter          = $data->twitter;
                        $Customer->facebook         = $data->facebook;
                        $Customer->instagram        = $data->instagram;
                        $Customer->github           = $data->github;
                        $Customer->codepen          = $data->codepen;
                        $Customer->stack            = $data->slack;
                        $Customer->user_id          = $user->id;
                        $Customer->lead_id          = $data->id;
                        $Customer->save();
                    
                    }else{

                            $user = User::find($email_exist->id);
                            
                            $user->fullname      = $data->first_name.' '.$data->last_name;
                            $user->usertype      = 2;
                            $user->mobile        = $data->mobile;
                            $user->email         = $data->email;
                            $user->api_token     = \Str::random(35);
                            $user->password      = \Hash::make('123456');
                            $user->save();
                            
                            $customer = Customer::where('user_id',$user->id)->first();
                            $Customer = Customer::find($customer->id);
                            $Customer->status           = 1;
                            $Customer->twitter          = $data->twitter;
                            $Customer->facebook         = $data->facebook;
                            $Customer->instagram        = $data->instagram;
                            $Customer->github           = $data->github;
                            $Customer->codepen          = $data->codepen;
                            $Customer->stack            = $data->slack;
                            $Customer->user_id          = $user->id;
                            $Customer->lead_id          = $data->id;
                            $Customer->save();
                       
                       }

                }

                // code by surya  06/10/2022
                $lead_log = new LeadLog;
                $lead_log->lead_id              =    $data->id;
                $lead_log->created_user         =    $created_user;
                $lead_log->log                  =    'Lead created by '.getUser()->fullname.'.';
                $lead_log->save();

                // code end

                DB::commit();
              return prepareResult(true, [], [], "Leads Saved Successfully.", $this->success);
            } catch (\Exception $e) {
                DB::rollback();
                $message = $e->getMessage();
                return prepareResult(false, [], $message, "Oops!!!, something went wrong, please try again.", $this->internal_server_error);
            }
    }

    private function leadsvalidations($input,$type)
    {
        $validator = [];
        $errors = [];
        $error = false;
        if ($type == "add") {
            $validator = Validator::make($input, [
                 'first_name'                    => 'required', 
                 'last_name'                     => 'required', 
                 'mobile'                        => 'required', 
                 'email'                         => 'required', 
                 'source'                        => 'required',  
                 'assigned'                      => 'required', 
                 'status'                        => 'required', 
                 'type'                          => 'required' , 
                 'brand_id'                       => 'required' , 
                 'model_id'                         => 'required' , 
                 'from'                          => 'required', 
                 'to'                            => 'required'

                 
             ]);
            
        }  
 
        if ($validator->fails()) {
            $error = true;
            $errors = $validator->errors();
        }
         
        return ["error" => $error, "errors" => $errors];
    }




}