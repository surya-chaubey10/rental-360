<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;    
use App\Models\UserPermission;
use App\Models\SubmenuAction;

class LoginRolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $current_page = $_SERVER['REQUEST_URI'];
        $current_page1 = explode('/', str_replace('?', '/',$current_page));

        $role = getUser()->role_id;

        if(getUser()->usertype == 1){

            return $next($request);

        }else if(getUser()->usertype == 4){


            $submenu_action = SubmenuAction::select('*')->where('action_url',$current_page1[1])->first();

            // Order key value means => 1 = list, 2 = create, 3 = edit_url, 4 = delete, 0 = else url

        if(is_object($submenu_action)){

            $query = UserPermission::select('*')
                    // ->where('menu_id',$submenu_action->menu_id)
                    // ->where('sub_menu_id',$submenu_action->submenu_id)
                    ->where('user_id',getUser()->id);

            if($submenu_action->order == 1){
               
                $userPermission = $query->where('view_url',$current_page1[1])->first();

                if(is_object($userPermission)){
                    return $next($request);
                }
                return redirect()->back()->with('NotPermission', 'Access Denied, Please Contact To System Admin !!');


            }

            if($submenu_action->order == 2){

                $userPermission = $query->where('create',$current_page1[1])->first();

                if(is_object($userPermission)){
                    return $next($request);
                }
                
                return redirect()->back()->with('NotPermission', 'Access Denied, Please Contact To System Admin !!');
            }

            if($submenu_action->order == 3){
                $userPermission = $query->where('edit_url',$current_page1[1])->first();

                if(is_object($userPermission)){
                    return $next($request);
                }
                return redirect()->back()->with('NotPermission', 'Access Denied, Please Contact To System Admin !!');

            }

            if($submenu_action->order == 4){

               
                $userPermission = $query->where('delete',$current_page1[1])->first();

                if(is_object($userPermission)){
                    return $next($request);
                }

                return ajax_response(false, [], [], "Access Denied, Please Contact To System Admin !!", []);

            }


            return $next($request);

        }

            return $next($request);

        }

    }
}
