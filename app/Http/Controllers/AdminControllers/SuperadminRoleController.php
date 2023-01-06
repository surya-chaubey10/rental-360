<?php
namespace App\Http\Controllers\AdminControllers;
use App\Http\Controllers\Controller;
use App\Models\SuperadminMenu;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;                                              
use Illuminate\Support\Collection;  
use App\Models\SuperadminRole;
use App\Models\SuperadminRoleMenu;
use App\Models\SuperadminRoleSubMenu;
use App\Models\SuperadminSubMenu;
use Illuminate\Http\Request;
class SuperadminRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageConfigs = ['pageHeader' => false]; 
        $path = public_path() . '/data/superadmin-role';
        if (!file_exists($path)) {
            \File::makeDirectory($path, 0777, true, true);
        }
        if (file_exists($path . '/' . 'superadmin-role-data.json')) {
            \File::delete($path . '/' . 'superadmin-role-data.json');
        }
        if (!file_exists($path . '/' . 'superadmin-role-data.json')) {
            $user = $this->jsonroleList();
            $data = array('data' => $user);
            // dd($data);
            \File::put($path . '/' . 'superadmin-role-data.json', collect($data));
            

        }
        return view('superadminrole.list');
    }
    private function jsonroleList()
    {
           return SuperadminRole::all();
         
        //    ->orderBy('superadmin_roles.id', 'desc')
        //    ->get();
        //    dd($return);
            }
   
    public function create()
    {
        $super_menu = SuperadminMenu::with('sub_menu')->get();
        return view('superadminrole.create', compact('super_menu'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
        $data = new SuperadminRole;
        $data->role_name = $request->role_name;
        $data->status    = $request->status;
        $data->save();


     
        $menus = explode(',',$request->menu);
        if($request->smenu){
            $smenus = explode(',',$request->smenu);      
        }          
        $sub_menus = explode(',',$request->sub_menu);

        foreach($menus as $menu){
            $menu_name = SuperadminMenu::select('name')->where('id', $menu)->first();
                // dd($menu_name->name);
            $role_menu                   = new SuperadminRoleMenu();
            $role_menu->role_id  = $data->id;
            $role_menu->admin_menu_name  = $menu_name->name;
            $role_menu->admin_menu_id    = $menu;
            $role_menu->save();
        }

        foreach($smenus as $key => $smenu){
            $submenu_name = SuperadminSubMenu::select('name')->where('id', $sub_menus[$key])->first();
            $role_sub_menu         = new SuperadminRoleSubMenu();
            $role_sub_menu->role_id      = $data->id;
            $role_sub_menu->role_menu_id = $smenu;
            $role_sub_menu->admin_submenu_name = $submenu_name->name;
            $role_sub_menu->admin_sub_menu_id    = $sub_menus[$key];
            $role_sub_menu->save();
        }

        DB::commit();
        return ajax_response(true, $data, [], " Superadmin Role Saved Successfully", $this->success);
     }
     catch(\Exception $e){
         DB::rollback();
        $message = $e->getMessage();
        return ajax_response(false,[],  $message , "Superadmin Role Saved UnSuccessfully",$this->internal_server_error);
     }
    }

   
    public function show(Superadmin_Role $superadmin_Role)
    {
        //
    }

        public function update($uuid)
        {

            $data = SuperadminRole::where('uuid',$uuid)->where('deleted_at','=',null)->first();
            $menus = SuperadminMenu::with('sub_menu')->get();
            $SuperadminRoleMenu = SuperadminRoleMenu::where('role_id',$data->id)->get();
            $SuperadminRoleSubMenu = SuperadminRoleSubMenu::where('role_id',$data->id)->get();
 
            $inserted_menu = array();
            $inserted_subMenu = array();

            foreach($SuperadminRoleMenu as $set_menu){
                $inserted_menu[] = $set_menu->admin_menu_id;

            }
            // dd($inserted_menu);
            foreach($SuperadminRoleSubMenu as $set_sub_menu){

                $inserted_subMenu[] = $set_sub_menu->admin_sub_menu_id;
            }
        
        return view('superadminrole.edit',compact('data','inserted_subMenu','inserted_menu','menus'));  
    }

    public function edit(Request $request)
    {
        DB::beginTransaction();
        try{
            $data = SuperadminRole::find($request->updated_id);  
            $data->role_name = $request->role_name;
            $data->status = $request->status; 
            $data->save();

            // $menus = explode(',',$request->menu);
            // if($request->smenu){
            //     $smenus = explode(',',$request->smenu);
            // }
          
            // $sub_menus = explode(',',$request->sub_menu);

            //  SuperadminRoleMenu::where('role_id',$data->id)->delete();
            //  SuperadminRoleSubMenu::where('role_id',$data->id)->delete();

            // foreach($menus as $menu){
            //     $menu_name = SuperadminMenu::select('name')->where('id', $menu)->first();                
            //     $role_menu                   = new SuperadminRoleMenu();
            //     $role_menu->role_id  = $data->id;
            //     $role_menu->admin_menu_name  = $menu_name->name;
            //     $role_menu->admin_menu_id    = $menu;
            //     $role_menu->save();
            // }

            // foreach($smenus as $key => $smenu){
            //     $submenu_name = SuperadminSubMenu::select('name')->where('id', $smenu)->first();
                
            //     $role_sub_menu                       = new SuperadminRoleSubMenu();
            //     $role_sub_menu->role_id      = $data->id;
            //     $role_sub_menu->role_menu_id = $smenu;
            //     $role_sub_menu->admin_submenu_name = $submenu_name->name;
            //     $role_sub_menu->admin_sub_menu_id    = $sub_menus[$key];
            //     $role_sub_menu->save();
            // }
            $menus = explode(',',$request->menu);
            if($request->smenu){
                $smenus = explode(',',$request->smenu);      
            }
              
            $sub_menus = explode(',',$request->sub_menu);
            SuperadminRoleMenu::where('role_id',$data->id)->delete();
            SuperadminRoleSubMenu::where('role_id',$data->id)->delete();
            foreach($menus as $menu){
                $menu_name = SuperadminMenu::select('name')->where('id', $menu)->first();
                    // dd($menu_name->name);
                $role_menu                   = new SuperadminRoleMenu();
                $role_menu->role_id  = $data->id;
                $role_menu->admin_menu_name  = $menu_name->name;
                $role_menu->admin_menu_id    = $menu;
                $role_menu->save();
            }
    
            foreach($smenus as $key => $smenu){
                $submenu_name = SuperadminSubMenu::select('name')->where('id', $sub_menus[$key])->first();
                $role_sub_menu         = new SuperadminRoleSubMenu();
                $role_sub_menu->role_id      = $data->id;
                $role_sub_menu->role_menu_id = $smenu;
                $role_sub_menu->admin_submenu_name = $submenu_name->name;
                $role_sub_menu->admin_sub_menu_id    = $sub_menus[$key];
                $role_sub_menu->save();
            }

            DB::commit();
            return ajax_response(true, $data, [], " Superadmin Role Update Successfully", $this->success);
         }
         catch(\Exception $e){
             DB::rollback();
            $message = $e->getMessage();
            return ajax_response(false,[],  $message , "Superadmin Role Update UnSuccessfully",$this->internal_server_error);
         }
        //
    }

    public function delete($uuid)
    {
        $promotion = SuperadminRole::where('uuid', $uuid)->first();
 
        if (is_object($promotion)) {
         
            $promotion->delete();
            return prepareResult(true, [], [], "Record delete successfully", $this->success);
        }

        return prepareResult(false, [], [], "Unauthorized access", $this->unauthorized);
    }
    public function roleStatus($id) {

        $value = SuperadminRole::find($id);
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