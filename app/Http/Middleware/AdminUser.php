<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Auth;

class AdminUser extends Middleware
{
  public function handle($request, Closure $next, ...$guards)
  {
    if (!Auth::guard('admin_user')->user()) {

      $admin_route = 'storeadmin';

      if (!request()->ajax()) {

        return redirect($admin_route . '/login');
      }

      $data = array(
        'status' => 'redirect',
        'message' => url($admin_route . '/login')
      );

      echo json_encode($data);
      exit();
    }

    return $next($request);
  }
}
