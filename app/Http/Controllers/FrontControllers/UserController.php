<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Country;
use App\Models\OrganisationMenu;
use App\Models\OrganisationSubMenu;
use App\Models\Role;
use App\Models\RoleMenu;
use App\Models\Notifications;
use App\Models\RoleSubMenu;
use App\Models\UserPermission;
use App\Models\SubmenuAction;
use App\Models\AdminMenu;
use App\Models\AdminSubMenu;
use App\Models\UsersDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
   {
    public function index()
      {
        $pageConfigs = ['pageHeader' => false];

        $path = public_path() . '/data/user-json';

        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
          } 
        if (file_exists($path . '/' . getUser()->organisation_id . '_user-list.json')) {
            \File::delete($path . '/' . getUser()->organisation_id . '_user-list.json');
           } 
        if (!file_exists($path . '/' . getUser()->organisation_id . '_user-list.json')) {
            $user = $this->jsonUserList();
            $data = array('data' => $user);
            \File::put($path . '/' . getUser()->organisation_id . '_user-list.json', collect($data));
            } 

        return view('users.list', ['pageConfigs' => $pageConfigs]);
      }

    private function jsonUserList()
        {
            return User::select('users.uuid','users.id', 'users.fullname', 'roles.name as role', 'users.email', 'users.mobile', 'users.status')
            ->leftJoin('default_roles as roles', function ($join) {
            $join->on('roles.id', '=', 'users.usertype'); })
            ->where('usertype', 4)
            ->where('users.is_deleted','=','0') 
            ->orderBy('users.id', 'desc') 
            ->get(); 
        }

        public function create()
        { 
              
               $country = Country::select('id', 'name')->get();
               $customer_type = Role::select('id', 'role_name')->where('organisation_id',getUser()->organisation_id)->get();
               
              return view('users.create',compact('country','customer_type'));    
         } 

        
 
    public function store(Request $request)
       { 
      //  dd($request);
        $created_user=getUser();
      
         DB::beginTransaction();
          try { 
            
            $input = $request->all();
            $validate = $this->validations($input, "add");
            if ($validate["error"]) {
             
               return ajax_response(false, [],$validate['errors']->first(), "Error while validating user", $this->success);
            }

          //  $contactss=implode(",",$request->contact_option);

            $user = new User;
            $user->fullname          = $request->fullname;
         //   $user->username        = $request->username;
            $user->email             = $request->email;
            $user->status            = $request->status;
            $user->role_id           = $request->role;
            $user->usertype          = 4;
            $user->mobile            = $request->contact;
            $user->api_token         = \Str::random(35);
            $user->password          = $request->password;
            $user->country_id        = $request->country;
            $user->created_user      = $created_user->id;
            $user->save();  
             
        /*     $user_details = new UsersDetails;
            $user_details->user_id           = $user->id;
            $user_details->dob               = $request->birth_date;
            $user_details->gender            = $request->gender;
            $user_details->website           = $request->website;
           
            $user_details->language          = $request->language[0];
            $user_details->address1          = $request->address_line1;
            $user_details->address2          = $request->address_line2;
            $user_details->postcode          = $request->post_code;
            $user_details->city              = $request->city;
            $user_details->state             = $request->state;
            $user_details->twitter           = $request->twitter;
            $user_details->facebook          = $request->facebook;
            $user_details->instagram         = $request->instagram;
            $user_details->github            = $request->github;
            $user_details->codepen           = $request->codepen;
            $user_details->stack             = $request->stack;
            $user_details->contact_option    =$contactss; */
           // $user_details->save();  
 
           $menuid = $request->menu_id;
           $submenuid = $request->submenu_id;
           $url = $request->urllink;
             if($submenuid){
              
                foreach($submenuid as $key => $submenuid){
                    if(isset($url[$submenuid])){   
                    $userpermission = new UserPermission;
                    $userpermission->role_id = $request->role_id;
                    $userpermission->menu_id = $menuid[$key];
                    $userpermission->sub_menu_id = $submenuid;
                    $userpermission->organisation_id =  getUser()->organisation_id;
                    $userpermission->created_user =  getUser()->id;
                    $userpermission->user_id = $user->id;
        
                    if(isset($url[$submenuid][1])){ 
                        $userpermission->view_url =  $url[$submenuid][1];
                    }else{
                        $userpermission->view_url =  null;
                    }
                    if(isset($url[$submenuid][2])){ 
                        $userpermission->create =  $url[$submenuid][2];
                    }else{
                        $userpermission->create =  null; 
                    }
                    if(isset($url[$submenuid][3])){ 
                        $userpermission->edit_url =  $url[$submenuid][3];
                    }else{
                        $userpermission->edit_url =  null;
                    }
                    if(isset($url[$submenuid][4])){ 
                        $userpermission->delete =  $url[$submenuid][4];
                    }else{
                        $userpermission->delete =  null;
                    }
                       
                    $userpermission->save(); 

                    
                }   
               
                   
               }  
                $notifications = new Notifications;
                    $notifications->messages          = "User created by ".getUser()->fullname; 
                    $notifications->read              = '0';
                    $notifications->unread            = '1';
                    $notifications->user_id           = getUser()->id;
                    $notifications->organisation_id   = getUser()->organisation_id;
                    $notifications->url               = 'users-view/';
                    $notifications->notification_id   = $user->uuid;
                   
                    $notifications->save();
             }

            DB::commit();
            return ajax_response(true, $user, [], "User Saved Successfully", $this->success);
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
               // 'username'          => 'required',
                 'email'            => 'required',
                'contact'             => 'required' 
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
              $user = User::select('users.id','users.uuid','users.country_id','users.role_id as roleId','users.usertype','users.username','users.password','users.fullname', 'roles.name as role', 'users.email', 'users.mobile', 'users.status','details.user_id','details.dob','details.gender','details.website','details.image','details.language','details.address1','details.address2','details.postcode','details.city'
              ,'details.state' ,'details.twitter' ,'details.facebook' ,'details.instagram'  ,'details.github' ,'details.codepen'  ,'details.stack'  ,'details.contact_option'  )
              ->leftJoin('default_roles as roles', function ($join) {
              $join->on('roles.id', '=', 'users.role_id');
              })
              ->leftJoin('users_details as  details', function ($join) {
                $join->on('details.user_id', '=', 'users.id');
                })
              ->where('users.uuid',$uuid)->first(); 
          
              $country = Country::select('id', 'name')->get();

            //   $customer_type = Role::select('roles.id', 'role_name')
            //     ->leftJoin('users as  users', function ($join) {
            //      $join->on('users.role_id', '=', 'roles.id');
            //      })
            //     ->where('users.uuid',$uuid)->get();
              $customer_type = Role::select('id', 'role_name')->where('organisation_id',getUser()->organisation_id)->get(); 
                
             return view('users.edit',compact('user','country','customer_type'));    
        } 

        public function update(Request $request)
       { 

       //  dd($request);
        $created_user=getUser();

       /*  if ($request->language != null) {
            $language = implode(',', $request->language);
        } else {
            $language = null;
        }
        if ($request->contact_option != null) {
            $contact_option = implode(',', $request->contact_option);
        } else {
            $contact_option = null;
        }

        $path = public_path('../public/images/users_images/');
        if (! file_exists($path) ) {
            mkdir($path, 0777, true);
         }

        $file = $request->file('image'); 
        $fileName='';
        
        if($file!=''){
            $fileName = uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($path, $fileName);
        }
        elseif($file==''){
            $old_image = DB::table('users_details')->select('users_details.image')->where('user_id', $request->user_updated_id)->first();
            $fileName= $old_image->image ;
        }else{
            $fileName='';  
        } */
 
         DB::beginTransaction(); 
          try {  
            
            // $input = $request->all();
            // $validate = $this->validations($input, "add");
            // if ($validate["error"]) {
             
            //    return ajax_response(false, [],$validate['errors']->first(), "Error while validating user", $this->success);
            // }
            // $user = new User;
            $user =  User::find($request->user_updated_id);
            $user->fullname      = $request->fullname;
          //  $user->username      = $request->username;
            $user->email         = $request->email;
            $user->usertype      = 4;
            $user->mobile        = $request->contact;
            $user->api_token     = \Str::random(35); 
            $user->password          = $request->password;
          //  $user->country_id    = $request->country;
            $user->created_user  = $created_user->id;
            $user->save();


          /*   DB::table('users_details')
                ->where('user_id', $request->user_updated_id)   
                ->limit(1)   
                ->update(array(
                    'dob'               => $request->birth_date,
                    'gender'            => $request->gender,
                    'website'           => $request->website,
                    'image'             => $fileName,
                    'language'          => $language,
                    'address1'          => $request->address_line1,
                    'address2'          => $request->address_line2,
                    'postcode'          => $request->post_code,
                    'city'              => $request->city,
                    'state'             => $request->state,
                    'twitter'           => $request->twitter,
                    'facebook'          => $request->facebook,
                    'instagram'         => $request->instagram,
                    'github'            => $request->github,
                    'codepen'           => $request->codepen,
                    'stack'             => $request->stack,
                    'contact_option'    => $contact_option
                ));   */
                
                $get_userpermission = UserPermission::where('user_id','=',$request->user_updated_id)->get();
                if(!empty($get_userpermission)){
                    foreach($get_userpermission as $permission){
                        $permission->delete();
                    }
                    
                }
                $menuid = $request->menu_id;
                $submenuid = $request->submenu_id;
                $url = $request->urllink;
                  if($submenuid && !empty($url)){
                   
                     foreach($submenuid as $key => $submenuid){

                    if(isset($url[$submenuid])){
                            $userpermission = new UserPermission;
                            $userpermission->role_id = $request->role_id;
                            $userpermission->menu_id = $menuid[$key];
                            $userpermission->sub_menu_id = $submenuid;
                            $userpermission->organisation_id =  getUser()->organisation_id;
                            $userpermission->created_user =  getUser()->id;
                            $userpermission->user_id = $user->id;
                
                            if(isset($url[$submenuid][1])){ 
                                $userpermission->view_url =  $url[$submenuid][1];
                            }else{
                                $userpermission->view_url =  null;
                            }
                            if(isset($url[$submenuid][2])){ 
                                $userpermission->create =  $url[$submenuid][2];
                            }else{
                                $userpermission->create =  null; 
                            }
                            if(isset($url[$submenuid][3])){ 
                                $userpermission->edit_url =  $url[$submenuid][3];
                            }else{
                                $userpermission->edit_url =  null;
                            }
                            if(isset($url[$submenuid][4])){ 
                                $userpermission->delete =  $url[$submenuid][4];
                            }else{
                                $userpermission->delete =  null;
                            }
                            $userpermission->save(); 
                           
                        }
                       
                       
                     }     
                     $notifications = new Notifications;
                     $notifications->messages          = "User Updated by ".getUser()->fullname; 
                     $notifications->read              = '0';
                     $notifications->unread            = '1';
                     $notifications->user_id           = getUser()->id;
                     $notifications->organisation_id   = getUser()->organisation_id;
                     $notifications->url               = 'users-view/';
                     $notifications->notification_id   = $user->uuid;
                     $notifications->save();
                  }

 
            DB::commit();
            return ajax_response(true, $user, [], "User Saved Successfully", $this->success);
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

        public function destroy($uuid)
        {
            $User = User::where('uuid', $uuid)->first();
            $User->is_deleted    ='1';
            $User->save(); 
            // if (is_object($User)) {
            //     $User->delete(); 
            // }

            return ajax_response(true, [], [], "User Deleted Successfully", $this->success);
        }

      public function all_submenu($role_type)
       {
           $all_submenu=RoleSubMenu::select('*')->with('user_submenuaction')
           ->where('role_sub_menus.role_id',$role_type) 
           ->where('role_sub_menus.organisation_id', getUser()->organisation_id) 
           ->get();
   
          $html='';   
          if($all_submenu)
            {
             foreach($all_submenu as $key=>$submenu){
                   $html .= '<tr>';
                   if($submenu->user_submenuaction){ 

                       $html .= '<td class="text-start">'.$submenu->user_submenuaction[0]->name.'</td>
                                 <input type="hidden" id="role_id" name="role_id" value="'.$role_type.'">
                                 <input type="hidden" id="menu_id" name="menu_id[]" value="'.$submenu->role_menu_id.'">
                                 <input type="hidden" id="submenu_id" name="submenu_id[]" value="'.$submenu->id.'">  
                                 ';

                      foreach($submenu->user_submenuaction as $key2=>$data){
                           
                            $html .= '<td>
                                    <div class="d-flex justify-content-center">
                                    <input class="form-check-input check_permission" name="urllink['.$submenu->id.']['.$data->order.']" type="checkbox" data-id="'.$data->id.''.$data->order.'" id="defaultCheck'.$data->id.''.$data->order.'" value="'.$data->action_url.'" >
                                    </div>
                                   
                                </td>';
                           
                          }
                        }      
                         // <input type="hidden" id="role_id" name="'.$submenu->user_submenuaction[0]->name.''.$data->order.'" value="'.$data->action_url.'">  
                                $html .= '<tr>'; 
                    } 
                    $return['html'] = $html;
            
                    echo json_encode($return);die;
                }
    }  

    public function fetchall_submenu($role_type,$user_id)
    {
        $all_submenu=RoleSubMenu::select('*')->with('user_submenuaction')
        ->where('role_sub_menus.role_id',$role_type) 
        ->where('role_sub_menus.organisation_id', getUser()->organisation_id) 
        ->get();
       
        $user_permission = UserPermission::where('user_id','=',$user_id)->get();
       // dd($user_permission);
         $selecturl = array();
        if($user_permission){
            foreach($user_permission as $permission){
           
                $selecturl[$permission->sub_menu_id][1] = $permission->view_url;
                $selecturl[$permission->sub_menu_id][2] = $permission->create;
                $selecturl[$permission->sub_menu_id][3] = $permission->edit_url;
                $selecturl[$permission->sub_menu_id][4] = $permission->delete;
            }

        }
       $html='';  
       if($all_submenu)
         {
          foreach($all_submenu as $key=>$submenu){
                $html .= '<tr>';
                if($submenu->user_submenuaction){ 

                    $html .= '<td class="text-start">'.$submenu->user_submenuaction[0]->name.'</td>
                              <input type="hidden" id="role_id" name="role_id" value="'.$role_type.'">
                              <input type="hidden" id="menu_id" name="menu_id[]" value="'.$submenu->role_menu_id.'">
                              <input type="hidden" id="submenu_id" name="submenu_id[]" value="'.$submenu->id.'">  
                              ';

                   foreach($submenu->user_submenuaction as $key2=>$data){

                          $select='';
                          if($user_permission){
                            $select=isset($selecturl[$submenu->id][$data->order]) ? 'checked' :'';
                          }
                        
                         $html .= '<td>
                                 <div class="d-flex justify-content-center">
                                 <input class="form-check-input check_permission" '.$select.' name="urllink['.$submenu->id.']['.$data->order.']" type="checkbox" data-id="'.$data->id.''.$data->order.'" id="defaultCheck'.$data->id.''.$data->order.'" value="'.$data->action_url.'" >
                                 </div>
                                
                             </td>';
                        
                       }
                     }      
                      // <input type="hidden" id="role_id" name="'.$submenu->user_submenuaction[0]->name.''.$data->order.'" value="'.$data->action_url.'">  
                             $html .= '<tr>'; 
                 } 
                 $return['html'] = $html;
         
                 echo json_encode($return);die;
             }
    } 

    public function viewuser($uuid)
    { 
        $user = User::select('users.id','users.uuid','users.country_id','users.role_id as roleId','users.usertype','users.username','users.fullname', 'roles.name as role', 'users.email', 'users.mobile', 'users.status','details.user_id','details.dob','details.gender','details.website','details.image','details.language','details.address1','details.address2','details.postcode','details.city'
        ,'details.state' ,'details.twitter' ,'details.facebook' ,'details.instagram'  ,'details.github' ,'details.codepen'  ,'details.stack'  ,'details.contact_option'  )
        ->leftJoin('default_roles as roles', function ($join) {
        $join->on('roles.id', '=', 'users.role_id');
        })
        ->leftJoin('users_details as  details', function ($join) {
          $join->on('details.user_id', '=', 'users.id');
          })
        ->where('users.uuid',$uuid)->first(); 
          

        $country = Country::select('id', 'name')->get();
        $customer_type = Role::select('id', 'role_name')->where('organisation_id',getUser()->organisation_id)->get(); 
      
        $all_submenu = UserPermission::select('user_permissions.*','sub_menus.name')
                     ->leftJoin('role_sub_menus as role_sub_menus', function ($join) {
                        $join->on('role_sub_menus.id', '=', 'user_permissions.sub_menu_id');
                     })   
                    ->leftJoin('admin_sub_menus as sub_menus', function ($join) {
                        $join->on('sub_menus.id', '=', 'role_sub_menus.admin_sub_menu_id');
                     }) 
                    ->where('user_permissions.user_id','=',$user->id)->get();
      
                    
       return view('users.user-view',compact('user','country','customer_type','all_submenu'));    
  } 
 
  public function userStatus($id) {

    $value = User::find($id);
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
