<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $input = $request->json()->all();
        $validate = $this->validations($input, "forgot");

        if ($validate["error"]) {
            return prepareResult(false, [], $validate['errors']->first(), "Error while validating user", $this->unprocessableEntity);
        }

        $user = User::where('email', $request->email)->first();
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

            $user->link = route('reset.pass.view', $t) . "?email=" . $request->email;

            $data = json_decode(json_encode($user), true);

            Mail::send('emails.forgot', $data, function ($message) use ($data) {
                $message->to($data["email"], $data["email"])
                    ->subject('Reset Password Notification');
            });

            return prepareResult(true, [], [], "Please check you email we sent you forget link", $this->success);
        }

        return prepareResult(false, [], ['error' => 'User not found.'], "User not found.", $this->unprocessableEntity);
    }

    private function validations($input, $type)
    {
        $errors = [];
        $error = false;
        if ($type == "forgot") {
            $validator = Validator::make($input, [
                'email' => 'required'
            ]);

            if ($validator->fails()) {
                $error = true;
                $errors = $validator->errors();
            }
        }

        return ["error" => $error, "errors" => $errors];
    }
}
