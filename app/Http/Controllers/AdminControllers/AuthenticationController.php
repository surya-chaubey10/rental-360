<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthenticationController extends Controller
{

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */

    public function showLoginFormAdmin()
    {
        return view('auth.login');
    }

    public function Login(Request $request)
    {

        $this->validateLogin($request);


        $login_success = Auth::guard('admin_user')->attempt([
            'email' => request()->input('email'),
            'password' => request()->input('password')
        ], request()->input('keep_active'));

        if ($login_success) {
            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect()->intended(route('super.dashboard'));
        }

        return array(
            'status' => 'error',
            'message' => 'Authentication failed'
        );
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect(route('admin.login'));
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin_user');
    }

    public function showChangePassword()
    {
        return view('auth.passwords.change');
    }

    public function changePassword(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        $user = auth()->guard('admin_user')->user();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Password changed',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'User not found.',
        ]);
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [];
    }
}
