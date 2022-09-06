<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function adminLogin(Request $request)
    {
        $login_success = Auth::guard('admin_user')->attempt([
            'email' => request()->input('email'),
            'password' => request()->input('password')
        ], request()->input('keep_active'));

        if ($login_success) {
            return array(
                'status' => 'success',
                'message' => 'Authenticated'
            );
        }

        return array(
            'status' => 'error',
            'message' => 'Authentication failed'
        );
    }
}
