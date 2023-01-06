<?php

namespace App\Http\Controllers\FrontControllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleMenu;
use App\Models\RoleSubMenu;
use App\Models\OrganisationMenu;
use App\Models\OrganisationSubMenu;
use App\Models\RolePermision;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class RolePermisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::select('id', 'role_name')->where('organisation_id',getUser()->organisation_id)->get();
       
        $org_menu = OrganisationMenu::with(
            'admin_menu:id,name',
            'org_sub_menu',
            'org_sub_menu.admin_sub_menu:id,name'
             )
             ->where('organisation_id',getUser()->organisation_id)
             ->where('deleted_at','=',null)
             ->get();
            
       return view('contact.permision.create',compact('role','org_menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
         DB::beginTransaction();
         try {
            
            $menus = explode(',',$request->menu);
            $smenus = explode(',',$request->smenu);
            $sub_menus = explode(',',$request->sub_menu);
            $menu_namess = explode(',',$request->menu_name);
            $submenu_namess = explode(',',$request->submenu_name);
            $org_id = explode(',',$request->org_id);
             
            $role = RoleMenu::with('role_sub_menu')->where('role_id',$request->role_id)->where('organisation_id',getUser()->organisation_id)->get();
            
            if(is_object($role)){
                //RoleMenu::where('role_id',$request->role_id)->where('organisation_id',getUser()->organisation_id)->delete();
                $role = DB::table('role_menus')->where('role_id',$request->role_id)->where('organisation_id',getUser()->organisation_id)->delete();
                $role =DB::table('role_sub_menus')->where('role_id',$request->role_id)->where('organisation_id',getUser()->organisation_id)->delete();
              //  $role = RoleSubMenu::where('role_id',$request->role_id)->where('organisation_id',getUser()->organisation_id)->delete();
                
            }


            foreach($menus as $key1=> $menu){     
                
                $role_menus                         = new RoleMenu;
                $role_menus->admin_menu_id          = $menu;
                $role_menus->role_id                = $request->role_id;
                $role_menus->admin_menu_name        = $menu_namess[$key1];
                $role_menus->organisation_id        = getUser()->organisation_id;
                 
                $role_menus->save();

                if($request->smenu){
                foreach($smenus as $key=> $smenu){
                   
                if($menu==$smenu){
                   
                    $role_sub_menus = new RoleSubMenu;
                    $role_sub_menus->role_menu_id              = $role_menus->id;
                    $role_sub_menus->admin_sub_menu_id         = $sub_menus[$key];
                    $role_sub_menus->role_id                   = $request->role_id;
                    // $role_sub_menus->organisation_menu_id      = $org_id[$key];
                    $role_sub_menus->admin_submenu_name        = $submenu_namess[$key];
                    $role_sub_menus->organisation_id           = getUser()->organisation_id;
                    
                    $role_sub_menus->save();
                } 
            } 
        }   

            }
      
             
             DB::commit();
             return ajax_response(true, $role_menus, [], "Role Permission Saved Successfully", $this->success);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RolePermision  $rolePermision
     * @return \Illuminate\Http\Response
     */
    public function show(RolePermision $rolePermision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RolePermision  $rolePermision
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $roless = Role::select('id', 'role_name')->where('organisation_id',$id)->get();
      
    //      $role = RoleMenu::with(
    //             'role_sub_menu',
    //             'role'
    //              )
    //              ->where('organisation_id',$id)
    //              ->get();
             
    //     return view('contact.permision.edit',compact('role','roless'));
    // }

    public function get_role_base_data($id,$madul,$submadul)
    {
       
        $roless = Role::select('id', 'role_name')->where('id',$id)->where('deleted_at','=',null)->get();
      
        $role = RoleMenu::with(
            'role_sub_menu',
            'role'
             )
             ->where('role_id',$id)
             ->where('deleted_at','=',null)
             ->get();
          
        return response()->json($role);
    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RolePermision  $rolePermision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RolePermision $rolePermision)
    {
       
        DB::beginTransaction();
        try {
           
           $menus = explode(',',$request->menu);
           $smenus = explode(',',$request->smenu);
           $sub_menus = explode(',',$request->sub_menu);
           $menu_namess = explode(',',$request->menu_name);
           $submenu_namess = explode(',',$request->submenu_name);
           $org_id = explode(',',$request->org_id);
           
          
           foreach($menus as $key1 => $menu){
               $role_menus                         = RoleMenu::find($request->updated_id);
               $role_menus->admin_menu_id          = $menu;
               $role_menus->role_id                = $request->role_id;
               $role_menus->admin_menu_name        = $menu_namess[$key1];
               $role_menus->organisation_id        = getUser()->organisation_id;
               $role_menus->save();
           }
           
           foreach($smenus as $key => $smenu){
               $role_sub_menus = RoleSubMenu::find($request->updated_id_submenu);
               $role_sub_menus->role_menu_id              = $smenu;
               $role_sub_menus->admin_sub_menu_id         = $sub_menus[$key];
               $role_sub_menus->role_id                   = $request->role_id;
               $role_sub_menus->organisation_menu_id      = $org_id[$key];
               $role_sub_menus->admin_submenu_name        = $submenu_namess[$key];
               $role_sub_menus->organisation_id           = getUser()->organisation_id;
               $role_sub_menus->save();
           }
    
 
            DB::commit();
            return ajax_response(true, $role_sub_menus, [], "Role Permission Saved Successfully", $this->success);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RolePermision  $rolePermision
     * @return \Illuminate\Http\Response
     */
    public function destroy(RolePermision $rolePermision)
    {
        //
    }
}
