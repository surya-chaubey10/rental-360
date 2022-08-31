<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminUser
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
        if (!Auth::guard('admin_user')->user()) {
            if (!request()->ajax()) {

                return redirect('/storeadmin/login');
            }

            $data = array(
                'status' => 'redirect',
                'message' => url('/storeadmin/login')
            );

            echo json_encode($data);
            exit();
        }
        return $next($request);
    }
}
