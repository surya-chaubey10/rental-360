<?php

namespace App\Http\Controllers\FrontControllers;
use App\Http\Controllers\Controller;
use App\Models\LeadsModel;
use App\Models\User;
use App\Models\Customer;    
use App\Models\VehicleModel;
use App\Models\VehicleBrand;
use App\Models\LeadLog;
use App\Models\LeadsComments;
use App\Models\Notifications;
use App\Models\CompanyActivity;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadsModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response 
     */

    public function leads_list()
    {
        
        $pageConfigs = ['pageHeader' => false];

        $path = public_path() . '/data/lead-json';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }

        if (file_exists($path . '/' . getUser()->organisation_id . '_lead-list.json')) {
            \File::delete($path . '/' . getUser()->organisation_id . '_lead-list.json');
        }

        if (!file_exists($path . '/' . getUser()->organisation_id . '_lead-list.json')) {
            $user = $this->jsonLeadList();
            $data = array('data' => $user);
            
            \File::put($path . '/' . getUser()->organisation_id . '_lead-list.json', collect($data));
        }

        return view('leads.list');   

    }

    private function jsonLeadList()
    {
       return LeadsModel::select(
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
            'leads_models.uuid',
            )
          ->leftjoin('users as user', function ($join) {
            $join->on('user.id', '=', 'leads_models.assigned');
          })
          ->where('leads_models.organisation_id', getUser()->organisation_id)
         ->orderBy('leads_models.id', 'desc') 
         ->get()->all();
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
       // $created_user=getUser();
        $brand_name = DB::table('vehicle_brands')->select('id','brand_name')->where('status',1)->whereIn('organisation_id',array(0,getUser()->organisation_id) )->get();
         
        $user_name = DB::table('users')->select('id','fullname')->where('usertype',4)->where('organisation_id', getUser()->organisation_id)->get();
        // dd($created_user);
        return view('leads.create',compact('brand_name','user_name'));   
    }
    public function leadsGride() 
    {
        return view('leads.gride');  

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $created_user=getUser();
        $input = $request->all();
        $validate = $this-> leadsvalidations($input, "add");
       
        if ($validate["error"]) {
             
            return ajax_response(false, [], $validate['errors']->first(), "Error while validating leads", $this->success);
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
                $data->vehicle          = $request->vehicle_id;
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
                $data->organisation_id = getUser()->organisation_id;
                $data->created_user     =  $created_user->id; 
               
                $data->save();

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

                // code by surya  06/10/2022
                $lead_log = new LeadLog;
                $lead_log->lead_id              =    $data->id;
                $lead_log->created_user         =    getUser()->id;
                $lead_log->log                  =    'Lead created by '.getUser()->fullname.'.';
                $lead_log->save();

                // code end

                if($data){
                    $notifications = new Notifications;
                    $notifications->messages          = "Leads created by ".getUser()->fullname; 
                    $notifications->read              = '0';
                    $notifications->unread            = '1';
                    $notifications->user_id           = getUser()->id;
                    $notifications->organisation_id   = getUser()->organisation_id;
                    $notifications->url               = 'http://127.0.0.1:8000/leads-view/';
                    $notifications->notification_id   = $data->uuid;
                    $notifications->save();

                    $adminactivity = new CompanyActivity;
                    $adminactivity->messages          = "Leads created by ".getUser()->fullname; 
                    $adminactivity->created_user           = getUser()->id;
                    $adminactivity->organisation_id   = getUser()->organisation_id;
                    $adminactivity->save();

               }

                DB::commit();
              return ajax_response(true, $data, [], "Leads Saved Successfully", $this->success);
            } catch (\Exception $e) {
                DB::rollback();
                $message = $e->getMessage();
                return ajax_response(false, [], [], $message, $this->internal_server_error);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LeadsModel  $leadsModel
     * @return \Illuminate\Http\Response
     */
    public function view($uuid)
    {

        $leads_data = LeadsModel::where('leads_models.uuid', $uuid)->get()->first();

        $brand_name = DB::table('vehicle_brands')->select('id','brand_name')->where('id',$leads_data->vehicle)->get()
        ->first();
    
        $model_name = VehicleModel::select('id','model_name')->where('id',$leads_data->model)->get()->first();
        $user_name = DB::table('users')->select('id','fullname')->where('id',$leads_data->assigned)->where('usertype',4)->get()->first();

        $logs = LeadLog::select('log')->where('lead_id',$leads_data->id)->get();


        $return = array();
        $getdata = LeadsComments::where('lead_id', '=', $leads_data->id)->get();
        if (count($getdata) > 0)
        {
            $user = User::where('id', '=', $getdata[0]->user_id)->get();
            $name= substr($user[0]->fullname, 0, 1);
            foreach ($getdata as $data) 
            {
              $return[]=[
                "comments" => $data->comments,
                "name" => $name,
                "time" => $data->created_at->diffForHumans()
              ];
             }
        }    

        return view('leads.view',compact('brand_name','user_name','leads_data','model_name','logs','return'));   
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LeadsModel  $leadsModel
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $brand_name = DB::table('vehicle_brands')->select('id','brand_name')->where('status',1)->get();

        $leads_data = LeadsModel::where('leads_models.uuid', $uuid)->get()->first();
    
        $user_name = DB::table('users')->select('id','fullname')->where('usertype',4)->where('organisation_id', getUser()->organisation_id)->get();
        return view('leads.edit',compact('brand_name','user_name','leads_data'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LeadsModel  $leadsModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       

        $updated_user=getUser();
        $input = $request->all();
        $validate = $this->leadsvalidationsupdate($input, "add");
       
        if ($validate["error"]) {
             
            return ajax_response(false, [], $validate['errors']->first(), "Error while validating updateleads", $this->success);
         }

        DB::beginTransaction();
        try{
              
                $data = LeadsModel::find($request->updated_id);

                $data->first_name       = $request->first_name;
                $data->last_name        = $request->last_name;
                $data->mobile           = $request->mobile;
                $data->email            = $request->email;
                $data->source           = $request->source;
                $pre_assign_user        = $data->assigned;
                $data->assigned         = $request->assigned;
                $data->status           = $request->status;
                $data->tags             = $request->tag;
                $data->type             = $request->type;
                $data->vehicle          = $request->vehicle_id;
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
                $data->updated_user     = $updated_user->id;
              
                $data->save();

            // code by -- surya -- 06/10/2022
          
                $lead_log = new LeadLog;
                $lead_log->lead_id          =    $data->id;
                $lead_log->created_user     =    getUser()->id;

                if($pre_assign_user == $request->assigned)
                {

                    $lead_log->log    =    'Lead updated by '.getUser()->fullname.'.';
                    
                }else
                {

                    $pre_assign = User::select('fullname')->where('id','=',$pre_assign_user)->first();
                   
                    $now_assign = User::select('fullname')->where('id','=',$request->assigned)->first();

                    $lead_log->log    =    'Lead assigned from '.$pre_assign->fullname.' to '.$now_assign->fullname.'.';

                }
               
                $lead_log->save();
          // code end -- surya
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

                if($data){
                    $notifications = new Notifications;
                    $notifications->messages          = "Leads updated by ".getUser()->fullname; 
                    $notifications->read              = '0';
                    $notifications->unread            = '1';
                    $notifications->user_id           = getUser()->id;
                    $notifications->organisation_id   = getUser()->organisation_id;
                    $notifications->url               = 'leads-view/';
                    $notifications->notification_id   = $data->uuid;
                    $notifications->save();

                    $adminactivity = new CompanyActivity;
                    $adminactivity->messages          = "Leads updated by ".getUser()->fullname; 
                    $adminactivity->created_user           = getUser()->id;
                    $adminactivity->organisation_id   = getUser()->organisation_id;
                    $adminactivity->save();

                }

                DB::commit();
                return ajax_response(true, $data, [], "Leads Updated Successfully", $this->success);

            } catch (\Exception $e) {
                DB::rollback();
                $message = $e->getMessage();
                return ajax_response(false, [], [], $message, $this->internal_server_error);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LeadsModel  $leadsModel
     * @return \Illuminate\Http\Response
     */
    public function importleads()
    {
        DB::beginTransaction();
        try{

            $fileName = $_FILES["leads_details"]["tmp_name"];

            
            if ($_FILES["leads_details"]["size"] > 0) {

                $file = fopen($fileName, "r");
                $i = 0;

                while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                    if($i > 0){

                        $vehicle_brand = VehicleBrand::select('id')->where('brand_name', 'like', '%' . $column[9] . '%')->first();

                        $vehicle_model = VehicleModel::select('id')->where('model_name', 'like', '%' . $column[10] . '%')->get()->first();

                        $data = new LeadsModel;
                        $data->first_name       = $column[0];
                        $data->last_name        = $column[1];
                        $data->mobile           = $column[2];
                        $data->email            = $column[3];
                        $data->source           = ($column[4] == 'Social Media' ? 1 : ($column[4] == 'Google' ? 2 : ($column[4] == 'Direct' ? 3 : ($column[4] == 'Other' ? 4 : '' ))));
                        // $data->assigned         = $column[5];
                        $data->status           = $this->importStatusName($column[6]);
                        $data->tags             = $column[7];
                        $data->type             = ($column[8] == 'Self Drive' ? 1 : ($column[8] == 'Car with Driver' ? 2 : ($column[8] == 'Limousine' ? 3 : '')));
                        $data->vehicle          = $vehicle_brand->id;
                        $data->model            = $vehicle_model->id;
                        // $data->from             = $column[11];
                        // $data->to               = $column[12];
                        $data->note             = $column[13];
                        $data->twitter          = $column[14];
                        $data->facebook         = $column[15];
                        $data->instagram        = $column[16];
                        $data->github           = $column[17];
                        $data->codepen          = $column[18];
                        $data->slack            = $column[19];

                        $data->save();

                    }

                $i++;
                    
                    
                }
            }
            
            DB::commit();
            // return ajax_response(true, $data, [], "Leads Updated Successfully", $this->success);
            return redirect(route('leads-list'));


        } catch (\Exception $e) {
            DB::rollback();
            // $message = $e->getMessage();
            // return ajax_response(false, [], [], $message, $this->internal_server_error);
            return redirect(route('leads-list'));

        }
        
    }
    
    public function updatestatus(Request $request)
    {

                $data = LeadsModel::find($request->updateid);

                $pre_status = $data->status;
                $change_status = $request->change_status;

                $data->status   = $request->change_status;
                $data->save();

                $lead_log = new LeadLog;
                $lead_log->lead_id              =    $data->id;
                $lead_log->created_user         =    getUser()->id;
                $lead_log->log                  =    'Lead change from '.$this->statusName($pre_status).' to '.$this->statusName($change_status).' by '.getUser()->fullname.'.';
                $lead_log->save();

                $adminactivity = new CompanyActivity;
                $adminactivity->messages          = 'Lead change from '.$this->statusName($pre_status).' to '.$this->statusName($change_status).' by '.getUser()->fullname;
                $adminactivity->created_user           = getUser()->id;
                $adminactivity->organisation_id   = getUser()->organisation_id;
                $adminactivity->save();

              if(!empty($data))
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

            return redirect(route('leads-list'));
        
    }
    public function delete($uuid)
    {
        $lead = LeadsModel::where('uuid', $uuid)->first();

        if (is_object($lead)) {
            $lead->delete();

            $adminactivity = new CompanyActivity;
            $adminactivity->messages          = 'Lead deleted by '.getUser()->fullname;
            $adminactivity->created_user           = getUser()->id;
            $adminactivity->organisation_id   = getUser()->organisation_id;
            $adminactivity->save();

        }
        return ajax_response(true, [], [], "Leads Deleted Successfully", $this->success);
    }

    // code by -- surya -- 06/10/2022
    private function statusName($status){
        switch($status) {
            case($status == 0):
 
                $msg = 'Pending';
 
                break;
 
            case($status == 1):
 
                $msg = 'Qualified';
 
                break;

            case($status == 2):

                $msg = 'Disqualified';
    
                break;

            case($status == 3):

                $msg = 'Contacted';
    
                break;

            case($status == 4):

                $msg = 'Proposal sent';
    
                break;

            case($status == 5):

                $msg = 'Converted';
    
                break;
 
            default:
                $msg = 'Status not found.';
        }
 
        return $msg;
    }
    
    // code end -- surya


    // code by surya -- 07/10/2022

    private function importStatusName($status){
        switch($status) {
            case($status == 'Pending'):
 
                $msg = 0;
 
                break;
 
            case($status == 'Qualified'):
 
                $msg = 1;
 
                break;

            case($status == 'Disqualified'):

                $msg = 2;
    
                break;

            case($status == 'Contacted'):

                $msg = 3;
    
                break;

            case($status == 'Proposal sent'):

                $msg = 4;
    
                break;

            case($status == 'Converted'):

                $msg = 5;
    
                break;
 
            default:
                $msg = 'Status not found.';
        }
 
        return $msg;
    }

    // end
    public function updatecomment(Request $request)
    {
                $data = new LeadsComments;
                $data->comments   = $request->comment;
                $data->lead_id    = $request->update_id; 
                $data->user_id    = getUser()->id;
                
                $data->save();

            return redirect(route('leads-list'));
    }
    public function getcomments($lead_id)
    {
        $return = array();
        $getdata = LeadsComments::where('lead_id', '=', $lead_id)->get();
        $return['status'] = false;
        $return['html'] = '<ul class="timeline ms-50">';
        if (count($getdata) > 0) {
            $user = User::where('id', '=', $getdata[0]->user_id)->get();
            $name= substr($user[0]->fullname, 0, 1);
            foreach ($getdata as $data) {
                
                $return['html'] .= '<li class="timeline-item">
                                      <span class="timeline-point timeline-point-info timeline-point-indicator"></span>
                                      <div class="timeline-event">
                                      <h6>'.$data->comments.'</h6>
                                      <div class="avatar-wrapper">
                                        <div class="avatar me-1">
                                        <span class="avatar-content">'.$name.'</span>
                                        </div>
                                        <span class="avatar-content" style="float: right;">'.$data->created_at->diffForHumans().'</span>
                                    </div>' ; 
                                    
                                    

                $return['html'] .= '</div> </li>';
              }
                $return['status'] = true;    
            }
            $return['html'] .= '</ul>';
         return response()->json($return);
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
             ]);
            
        }  
 
        if ($validator->fails()) {
            $error = true;
            $errors = $validator->errors();
        }
         
        return ["error" => $error, "errors" => $errors];
    }

    private function leadsvalidationsupdate($input,$type)
    {
        $validator = [];
        $errors = [];
        $error = false;
        if ($type == "add") {
            $validator = Validator::make($input, [
                 'first_name'                    => 'required', 
                 'last_name'                     => 'required', 
                 'mobile'                        => 'required', 
                 'email'                         => 'required'
             ]);
            
        }  
 
        if ($validator->fails()) {
            $error = true;
            $errors = $validator->errors();
        }
         
        return ["error" => $error, "errors" => $errors];
    }
    
}
