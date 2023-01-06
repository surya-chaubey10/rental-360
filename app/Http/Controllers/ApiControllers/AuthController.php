<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
// use App\Models\LoginLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function validations($input, $type)
    {
        $errors = [];
        $error = false;
        if ($type == "login") {
            $validator = Validator::make($input, [
                'email' => 'required',
                'password' => 'required',
                'remember_me' => 'boolean',
            ]);

            if ($validator->fails()) {
                $error = true;
                $errors = $validator->errors();
            }

            return ["error" => $error, "errors" => $errors];
        }

        if ($type == "signup") {

            $validator = Validator::make($input, [
                'fullname' => 'required|string',
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|string|max:255|unique:users',
                'password' => 'required|string|confirmed',
                'mobile' => 'required|numeric|min:10',
                'country_id' => 'required'
            ]);
            if ($validator->fails()) {
                $error = true;
                $errors = $validator->errors();
            }

            return ["error" => $error, "errors" => $errors];

        }

    }


        /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {

        $input          = $request->json()->all();
        $validate       = $this->validations($input, "signup");
        
        if ($validate["error"]) {
            return prepareResult(false, [], $validate['errors']->first(), "Error while validating signup", $this->unprocessableEntity);
        }

        \DB::beginTransaction();
        try {
            $user = new User;
            $user->fullname = $request->fullname;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = \Hash::make($request->password);
            $user->api_token = \Str::random(35);
            $user->mobile = $request->mobile;
            $user->usertype = '4';
            $user->country_id = $request->country_id;
            $user->login_type = $request->login_type;
            $user->status = 0;
            $user->save();

            \DB::commit();
            return prepareResult(true, ["accessToken" => $user->createToken('authLoginToken')->accessToken, 'user_info' => $user, 'permissions-name' => $user->getPermissionNames()], [], "User created successfully", $this->success);
        } catch (\Exception $exception) {
            \DB::rollback();
            return prepareResult(false, [], $exception->getMessage(), "Oops!!!, something went wrong, please try again.", $this->internal_server_error);
        } catch (\Throwable $exception) {
            \DB::rollback();
            return prepareResult(false, [], $exception->getMessage(), "Oops!!!, something went wrong, please try again.", $this->internal_server_error);
        }
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     * @return [object] user
     */
    public function login(Request $request)
    {
        $input = $request->json()->all();
        $validate = $this->validations($input, "login");

        if ($validate["error"]) {
            return prepareResult(false, [], $validate['errors']->first(), "Error while validating user", $this->unprocessableEntity);
        }

        $user = User::where("email", $input['email'])
            ->first();

        if ($user) {
            if (Hash::check($input['password'], $user->password)) {
                if ($user->status == 1 && $user->usertype == 1 ) {
                    // LoginLog::create([
                    //     'user_id' => $user->id,
                    //     'ip' => $request->ip(),
                    // ]);

                    $token = $user->createToken($user->fullname);
                    $b_token = 'Bearer ' . $token->plainTextToken;
                    return prepareResult(true, [
                        "accessToken" => $b_token,
                    ], [], "User Logged in successfully", $this->success);
                } else {
                    return prepareResult(false, [], ["Inactivated" => "Your account is temporarily deactivated."], "Your account is temporarily deactivated, Please contact to admin.", $this->unauthorized);
                }
            } else {
                return prepareResult(false, [], ["password" => "Wrong passowrd"], "Password not matched", $this->unauthorized);
            }
        } else {
            return prepareResult(false, [], ["email" => "Unable to find user"], "User not found", $this->bed_request);
        }
    }



}
