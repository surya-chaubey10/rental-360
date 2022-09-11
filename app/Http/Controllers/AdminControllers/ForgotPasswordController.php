<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Carbon;

class ForgotPasswordController extends Controller
{
    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $user = AdminUser::where('email', $request->email)->first();
        if ($user) {
            $t = Str::random(50);

            $pass = DB::table('password_resets')
                ->where('email', $request->email)
                ->first();

            if (!$pass) {
                DB::table('password_resets')
                    ->insert(
                        [
                            'email' => $request->email,
                            'token' => $t,
                            'created_at' => Carbon::now(),
                        ]
                    );
            } else {
                DB::table('password_resets')
                    ->where('email', $request->email)
                    ->update([
                        'token' => $t
                    ]);
            }

            $user->link = route('admin.reset.pass.view', $t) . "?email=" . $request->email;

            $data = json_decode(json_encode($user), true);

            Mail::send('emails.forgot', $data, function ($message) use ($data) {
                $message->to($data["email"], $data["email"])
                    ->subject('Reset Password Notification');
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Please check you email we sent you forget link',
                // 'redirect' => route('login')
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'User not found'
        ]);
    }

    /**
     * Validate the email for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }

    /**
     * Get the needed authentication credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only('email');
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return $request->wantsJson()
            ? new JsonResponse(['message' => trans($response)], 200)
            : back()->with('status', trans($response));
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'email' => [trans($response)],
            ]);
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }
}
