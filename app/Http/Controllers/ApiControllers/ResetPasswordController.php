<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
/* use Illuminate\Support\Facades\Password; */
/* use Illuminate\Foundation\Auth\ResetsPasswords; */
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    public function resetPassword(Request $request)
    {
        $input = $request->json()->all();
        $validate = $this->validations($input, "reset");

        if ($validate["error"]) {
            return prepareResult(false, [], $validate['errors']->first(), "Error while validating reason", $this->unprocessableEntity);
        }

       $user = User::where("email", $request->email)
        ->first();
         if ($user) {
            $user->password = \Hash::make($request->password);
            $user->save();

            return prepareResult(true, [], [], "Password Updated successfully", $this->success);

        } else {
            return prepareResult(false, [], ["email" => "Unable to find user"], "User not found", $this->bed_request);
        }  
    }

    private function validations($input, $type)
    {
        $errors = [];
        $error = false;
        if ($type == "reset") {
            $validator = \Validator::make($input, [
                'email' => 'required',
                'password' => 'required'
                   
            ]);

            if ($validator->fails()) {
                $error = true;
                $errors = $validator->errors();
            }
        }

        return ["error" => $error, "errors" => $errors];
    }
}
