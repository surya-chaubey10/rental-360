<?php
namespace App\Http\Controllers\FrontControllers;
use App\Http\Controllers\Controller;
use App\Models\Organisation;
use Carbon\Carbon;
use App\Models\OrganisationMenu;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;                                              
use Illuminate\Support\Collection;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\RoleMenu;
use App\Models\RoleSubMenu;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageConfigs = ['pageHeader' => false]; 

        $path = public_path() . '/data/role-list';
      
        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }
       
        if (file_exists($path . '/' . getUser()->organisation_id . '_role.json')) {
            \File::delete($path . '/' . getUser()->organisation_id . '_role.json');
        }
        
        if (!file_exists($path . '/' . getUser()->organisation_id . '_role.json')) {
            $user = $this->jsonroleList();
            $data = array('data' => $user); 
            \File::put($path . '/' . getUser()->organisation_id . '_role.json', collect($data));
            return view('contact.roll.list');

        }
    }
    private function jsonroleList()
    {
           return Role::select('roles.*')
            ->where('organisation_id',getUser()->organisation_id)  
           ->orderBy('roles.id', 'desc')
           ->get();
           
            }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $org_menu = OrganisationMenu::with(
            'admin_menu:id,name',
            'org_sub_menu',
            'org_sub_menu.admin_sub_menu:id,name'
             )
             ->where('organisation_id',getUser()->organisation_id)
             ->where('deleted_at','=',null)
             ->get();

        return view('contact.roll.create',compact('org_menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  
     public function store(Request $request)
     {
          DB::beginTransaction();
         try{ 
             $data = new Role;
             $data->role_name = $request->role_name;
             $data->status = $request->status; 
             $data->organisation_id = getUser()->organisation_id; 
            
             $data->save();


             $menus = explode(',',$request->menu);
             $smenus = explode(',',$request->smenu);
             $sub_menus = explode(',',$request->sub_menu);
             $menu_namess = explode(',',$request->menu_name);
             $submenu_namess = explode(',',$request->submenu_name);
             $org_id = explode(',',$request->org_id);


             $role = RoleMenu::with('role_sub_menu')->where('role_id',$data->id)->where('organisation_id',getUser()->organisation_id)->get();
            
             if(is_object($role)){
                 //RoleMenu::where('role_id',$data->id)->where('organisation_id',getUser()->organisation_id)->delete();
                 $role = DB::table('role_menus')->where('role_id',$data->id)->where('organisation_id',getUser()->organisation_id)->delete();
                 $role =DB::table('role_sub_menus')->where('role_id',$data->id)->where('organisation_id',getUser()->organisation_id)->delete();
               //  $role = RoleSubMenu::where('role_id',$data->id)->where('organisation_id',getUser()->organisation_id)->delete();
                 
             }
 
 
            foreach($menus as $key1=> $menu){     
                 
                $role_menus                         = new RoleMenu;
                $role_menus->admin_menu_id          = $menu;
                $role_menus->role_id                = $data->id;
                $role_menus->admin_menu_name        = $menu_namess[$key1];
                $role_menus->organisation_id        = getUser()->organisation_id;
                
                $role_menus->save();
 
                if($request->smenu){
                    foreach($smenus as $key=> $smenu){
                    
                        if($menu==$smenu){
                            
                            $role_sub_menus = new RoleSubMenu;
                            $role_sub_menus->role_menu_id              = $role_menus->id;
                            $role_sub_menus->admin_sub_menu_id         = $sub_menus[$key];
                            $role_sub_menus->role_id                   = $data->id;
                            // $role_sub_menus->organisation_menu_id      = $org_id[$key];
                            $role_sub_menus->admin_submenu_name        = $submenu_namess[$key];
                            $role_sub_menus->organisation_id           = getUser()->organisation_id;
                            
                            $role_sub_menus->save();
                        } 
                    } 
                }   
 
            }

 
            DB::commit();
            return ajax_response(true, $data, [], "Role Saved Successfully", $this->success);
         }
         catch(\Exception $e){
             DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false,[],  $message , "Role Saved UnSuccessfully",$this->internal_server_error);
         }
     }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        DB::beginTransaction();
        try{ 
           
            $data = Role::find($request->updated_id);  
            $data->role_name = $request->role_name;
            $data->status = $request->status; 
           
            $data->save();


                $menus = explode(',',$request->menu);
                $smenus = explode(',',$request->smenu);
                $sub_menus = explode(',',$request->sub_menu);
                $menu_namess = explode(',',$request->menu_name);
                $submenu_namess = explode(',',$request->submenu_name);
                $org_id = explode(',',$request->org_id);


                $role = RoleMenu::with('role_sub_menu')->where('role_id',$data->id)->where('organisation_id',getUser()->organisation_id)->get();
            
                if(is_object($role)){
                    //RoleMenu::where('role_id',$data->id)->where('organisation_id',getUser()->organisation_id)->delete();
                    $role = DB::table('role_menus')->where('role_id',$data->id)->where('organisation_id',getUser()->organisation_id)->delete();
                    $role =DB::table('role_sub_menus')->where('role_id',$data->id)->where('organisation_id',getUser()->organisation_id)->delete();
                //  $role = RoleSubMenu::where('role_id',$data->id)->where('organisation_id',getUser()->organisation_id)->delete();
                    
                }


            foreach($menus as $key1=> $menu){     
                    
                $role_menus                         = new RoleMenu;
                $role_menus->admin_menu_id          = $menu;
                $role_menus->role_id                = $data->id;
                $role_menus->admin_menu_name        = $menu_namess[$key1];
                $role_menus->organisation_id        = getUser()->organisation_id;
                
                $role_menus->save();

                if($request->smenu){
                    foreach($smenus as $key=> $smenu){
                    
                        if($menu==$smenu){
                            
                            $role_sub_menus = new RoleSubMenu;
                            $role_sub_menus->role_menu_id              = $role_menus->id;
                            $role_sub_menus->admin_sub_menu_id         = $sub_menus[$key];
                            $role_sub_menus->role_id                   = $data->id;
                            // $role_sub_menus->organisation_menu_id      = $org_id[$key];
                            $role_sub_menus->admin_submenu_name        = $submenu_namess[$key];
                            $role_sub_menus->organisation_id           = getUser()->organisation_id;
                            
                            $role_sub_menus->save();
                        } 
                    } 
                }   

            }

         
            DB::commit();
            return ajax_response(true, $data, [], "Role Updated Successfully", $this->success);
         }
         catch(\Exception $e){
             DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false,[],  $message , "Role Updated UnSuccessfully",$this->internal_server_error);
         }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update($uuid)
    {
        $data = Role::where('uuid',$uuid)->first(); 

        $org_menu = OrganisationMenu::with(

            'admin_menu:id,name',
            'org_sub_menu',
            'org_sub_menu.admin_sub_menu:id,name'
             )
             ->where('organisation_id',getUser()->organisation_id)
             ->where('deleted_at','=',null)
             ->get();
        


        return view('contact.roll.edit',compact('data','org_menu'));  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $promotion = Role::where('uuid', $uuid)->first();
 
        if (is_object($promotion)) {
         
            $promotion->delete();
            return prepareResult(true, [], [], "Record delete successfully", $this->success);
        }

        return prepareResult(false, [], [], "Unauthorized access", $this->unauthorized);
    }
    public function roleStatus($id) {

        $value = Role::find($id);
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
