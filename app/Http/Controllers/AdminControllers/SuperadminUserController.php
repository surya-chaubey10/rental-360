<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\Country;
use App\Models\SuperadminMenu;
use App\Models\SuperadminRole;
use App\Models\SuperadminRoleMenu;
use App\Models\SuperadminRoleSubMenu;
use App\Models\SuperadminSubMenu;
use App\Models\SuperadminUser;
use App\Models\SuperadminUserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SuperadminUserController extends Controller
{
    public function index()
    {
    //   $pageConfigs = ['pageHeader' => false];

    //   $path = public_path() . '/data/user-json';

    //   if (!file_exists($path)) {
    //       \File::makeDirectory($path, 0777, true, true);
    //     }
    //   if (file_exists($path . '/' . getUser()->organisation_id . '_user-list.json')) {
    //       \File::delete($path . '/' . getUser()->organisation_id . '_user-list.json');
    //      }
    //   if (!file_exists($path . '/' . getUser()->organisation_id . '_user-list.json')) {
    //       $admin_user = $this->jsonUserList();
    //       $data = array('data' => $admin_user);
    //       \File::put($path . '/' . getUser()->organisation_id . '_user-list.json', collect($data));
    //       }

    //   return view('admin.superadminuser.list', ['pageConfigs' => $pageConfigs]);



    $pageConfigs = ['pageHeader' => false];
    $path = public_path() . '/data/superadmin-user';
    if (!file_exists($path)) {
        \File::makeDirectory($path, 0777, true, true);
    }
    if (file_exists($path . '/' . 'superadmin-user-data.json')) {
        \File::delete($path . '/' . 'superadmin-user-data.json');
    }
    if (!file_exists($path . '/' . 'superadmin-user-data.json')) {
        $user = $this->jsonuserList();
        $data = array('data' => $user);
        // dd($data);
        \File::put($path . '/' . 'superadmin-user-data.json', collect($data));


    }
      return view('superadminuser.list');
    }

  private function jsonUserList()
      {
        return AdminUser::select('admin_users.id','admin_users.uuid','admin_users.fullname','admin_users.email','admin_users.status','admin_users.email','admin_users.mobile','superadmin_roles.role_name')
        ->leftJoin('superadmin_roles', 'admin_users.role_id','=', 'superadmin_roles.id')->get();

      }

      public function create()
      {

             $country = Country::select('id', 'name')->get();
             $customer_type = SuperadminRole::select('id', 'role_name')->get();

            return view('superadminuser.create',compact('country','customer_type'));
       }



  public function store(Request $request)
     {

       DB::beginTransaction();
        try {
          $input = $request->all();
          $validate = $this->validations($input, "add");
          if ($validate["error"]) {

             return ajax_response(false, [],$validate['errors']->first(), "Error while validating user", $this->success);
          }


          $admin_user                    = new AdminUser;
          $admin_user->fullname          = $request->fullname;
          $admin_user->email             = $request->email;
          $admin_user->status            = $request->status;
          $admin_user->role_id           = $request->role;
          $admin_user->mobile            = $request->contact;
          $admin_user->password          = Hash::make($request->password);
          $admin_user->user_password          =$request->password;
        //   $admin_user->created_user      = Auth::user()->id;
         //   $admin_user->country_id        = $request->country;
         //   $admin_user->usertype          = 4;
         //   $admin_user->api_token         = \Str::random(35);
         //   $admin_user->username        = $request->username;

          $admin_user->save();



        $menuid = $request->menu_id;
        $submenuid = $request->submenu_id;
        $url = $request->urllink;
          if($submenuid){

             foreach($submenuid as $key => $submenuid){
                 if(isset($url[$submenuid])){
                 $userpermission = new SuperadminUserPermission;
                 $userpermission->role_id = $request->role_id;
                 $userpermission->menu_id = $menuid[$key];
                 $userpermission->sub_menu_id = $submenuid;
                //  $userpermission->organisation_id =  getUser()->organisation_id;
                //  $userpermission->created_user =  getUser()->id;
                 $userpermission->user_id = $admin_user->id;

                 if(isset($url[$submenuid][1])){
                     $userpermission->view_url =  $url[$submenuid][1];
                 }else{
                     $userpermission->view_url =  null;
                 }
                 if(isset($url[$submenuid][2])){
                     $userpermission->create_url =  $url[$submenuid][2];
                 }else{
                     $userpermission->create_url =  null;
                 }
                 if(isset($url[$submenuid][3])){
                     $userpermission->edit_url =  $url[$submenuid][3];
                 }else{
                     $userpermission->edit_url =  null;
                 }
                 if(isset($url[$submenuid][4])){
                     $userpermission->delete_url =  $url[$submenuid][4];
                 }else{
                     $userpermission->delete_url =  null;
                 }

                 $userpermission->save();
             }
            }
          }
          DB::commit();
          return ajax_response(true, $admin_user, [], "Admin User Saved Successfully", $this->success);
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
        $admin_user = AdminUser::select('admin_users.id','admin_users.user_password','admin_users.status','admin_users.uuid','admin_users.role_id as roleId','admin_users.fullname','admin_users.email','admin_users.mobile' )
        // ->leftJoin('default_roles as roles', function ($join) {
        // $join->on('roles.id', '=', 'users.role_id');
        // })
        ->where('admin_users.uuid',$uuid)->first();

        $country = Country::select('id', 'name')->get();
        $user_types = SuperadminRole::select('id','role_name')->get();
        $user_permission = SuperadminUserPermission::where('user_id',$admin_user->id)->get();

           return view('superadminuser.edit',compact('admin_user','user_types','user_permission'));
      }

      public function update(Request $request)
     {

        $created_user=getUser();
    //   dd($created_user);

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

            // dd($request->user_updated_id);
          $admin_user =  AdminUser::find($request->user_updated_id);
          $admin_user->fullname          = $request->fullname;
          $admin_user->email             = $request->email;
          $admin_user->status            = $request->status;
          $admin_user->role_id           = $request->role;
          $admin_user->mobile            = $request->contact;
          $admin_user->password          = Hash::make($request->password);
          $admin_user->user_password          =$request->password;

         //   $admin_user->created_user      = Auth::user()->id;
         //   $admin_user->country_id        = $request->country;
         //   $admin_user->usertype          = 4;
         //   $admin_user->api_token         = \Str::random(35);
         //   $admin_user->username        = $request->username;

          $admin_user->save();



              $get_superadminuserpermission = SuperadminUserPermission::where('user_id','=',$request->user_updated_id)->get();
              if(!empty($get_superadminuserpermission)){
                  foreach($get_superadminuserpermission as $permission){
                      $permission->delete();
                  }

              }
              $menuid = $request->menu_id;
              $submenuid = $request->submenu_id;
              $url = $request->urllink;
                if($submenuid && !empty($url)){

                   foreach($submenuid as $key => $submenuid){

                  if(isset($url[$submenuid])){
                          $superadminUserPermission = new SuperadminUserPermission;
                          $superadminUserPermission->role_id = $request->role_id;
                          $superadminUserPermission->menu_id = $menuid[$key];
                          $superadminUserPermission->sub_menu_id = $submenuid;
                        //   $superadminUserPermission->organisation_id =  getUser()->organisation_id;
                        //   $superadminUserPermission->created_user =  getUser()->id;
                          $superadminUserPermission->user_id = $admin_user->id;

                          if(isset($url[$submenuid][1])){
                              $superadminUserPermission->view_url =  $url[$submenuid][1];
                          }else{
                              $superadminUserPermission->view_url =  null;
                          }
                          if(isset($url[$submenuid][2])){
                              $superadminUserPermission->create_url =  $url[$submenuid][2];
                          }else{
                              $superadminUserPermission->create_url =  null;
                          }
                          if(isset($url[$submenuid][3])){
                              $superadminUserPermission->edit_url =  $url[$submenuid][3];
                          }else{
                              $superadminUserPermission->edit_url =  null;
                          }
                          if(isset($url[$submenuid][4])){
                              $superadminUserPermission->delete_url =  $url[$submenuid][4];
                          }else{
                              $superadminUserPermission->delete_url =  null;
                          }

                          $superadminUserPermission->save();
                      }
                   }
                }


          DB::commit();
          return ajax_response(true, $admin_user, [], "Admin User Updated Successfully", $this->success);
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
          $admin_user = AdminUser::where('uuid', $uuid)->first();
          $admin_user->is_deleted    ='1';
          $admin_user->save();
          // if (is_object($admin_user)) {
          //     $admin_user->delete();
          // }

          return ajax_response(true, [], [], "User Deleted Successfully", $this->success);
      }


      public function all_submenu($role_type)
      {
          $all_submenu=SuperadminRoleSubMenu::select('*')->with('user_submenuaction')
          ->where('role_id',$role_type)
          ->get();

         $html='';
         if($all_submenu)
           {

            foreach($all_submenu as $key=>$submenu){
                // print_r($submenu);
                  $html .= '<tr>';
                  if($submenu->user_submenuaction){

                      $html .= '
                                <td class="text-start ">'.$submenu->admin_submenu_name.'</td>
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

    $all_submenu=SuperadminRoleSubMenu::select('*')->with('user_submenuaction')
    ->where('role_id',$role_type)
    ->get();


       $user_permission = SuperadminUserPermission::where('user_id','=',$user_id)->get();
      // dd($user_permission);
        $selecturl = array();
       if($user_permission){
           foreach($user_permission as $permission){

               $selecturl[$permission->sub_menu_id][1] = $permission->view_url;
               $selecturl[$permission->sub_menu_id][2] = $permission->create_url;
               $selecturl[$permission->sub_menu_id][3] = $permission->edit_url;
               $selecturl[$permission->sub_menu_id][4] = $permission->delete_url;
           }

       }
      $html='';
      if($all_submenu)
        {
         foreach($all_submenu as $key=>$submenu){
               $html .= '<tr>';
               if($submenu->user_submenuaction){

                $html .= '<td class="text-start">'.$submenu->admin_submenu_name.'</td>
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
      $admin_user = AdminUser::select('admin_users.id','admin_users.uuid','admin_users.country_id','admin_users.role_id as roleId','admin_users.usertype','admin_users.username','admin_users.fullname', 'roles.name as role', 'admin_users.email', 'admin_users.mobile', 'admin_users.status','details.user_id','details.dob','details.gender','details.website','details.image','details.language','details.address1','details.address2','details.postcode','details.city'
      ,'details.state' ,'details.twitter' ,'details.facebook' ,'details.instagram'  ,'details.github' ,'details.codepen'  ,'details.stack'  ,'details.contact_option'  )
      ->leftJoin('default_roles as roles', function ($join) {
      $join->on('roles.id', '=', 'admin_users.role_id');
      })
      ->leftJoin('users_details as  details', function ($join) {
        $join->on('details.user_id', '=', 'admin_users.id');
        })
      ->where('admin_users.uuid',$uuid)->first();


      $country = Country::select('id', 'name')->get();
      $customer_type = SuperadminRole::select('id', 'role_name')->where('organisation_id',getUser()->organisation_id)->get();

      $all_submenu = SuperadminUserPermission::select('user_permissions.*','sub_menus.name')
                   ->leftJoin('role_sub_menus as role_sub_menus', function ($join) {
                      $join->on('role_sub_menus.id', '=', 'user_permissions.sub_menu_id');
                   })
                  ->leftJoin('admin_sub_menus as sub_menus', function ($join) {
                      $join->on('sub_menus.id', '=', 'role_sub_menus.admin_sub_menu_id');
                   })
                  ->where('user_permissions.user_id','=',$admin_user->id)->get();


     return view('admin_users.user-view',compact('user','country','customer_type','all_submenu'));
}

public function userStatus($id) {

  $value = AdminUser::find($id);
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
