<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\ForgotPasswordRequest;
use App\Http\Requests\API\V1\LoginRequest;
use App\Http\Requests\API\V1\RegisterRequest;
use App\Models\User;
use App\Notifications\API\V1\ForgotPasswordNotification;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {

        if(!auth()->attempt($request->only('email', 'password'))){
            return $this->sendResponse(401, "Invalid credentials", null);
        }

        if(!auth()->user()->status){
            return $this->sendResponse(403, 'Your account is not disabled. Please contact the administrator.');
        }

        $user = auth()->user();

        $user->update(
            [
                'last_login_at' => now(),
                'last_login_ip' => $request->ip()
            ]
        );

        $token = $user->createToken('token')->plainTextToken;

        return $this->sendResponse(200, "Welcome Back, $user->name", ['token' => $token]);
    }

    public function register(RegisterRequest $request)
    {

        $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]
        );

        $token = $user->createToken('token')->plainTextToken;

        return $this->sendResponse(201, "Welcome to " . env('APP_NAME') . ", {$user->name}", ['token' => $token]);
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        $user->update(
            [
                'otp_code' => rand(10000, 99999),
            ]
        );

        $user->notify(new ForgotPasswordNotification($user));

        $token = $user->createToken('forgot-password')->plainTextToken;


        return $this->sendResponse(200, 'We have sent the reset password code to your email', ['token' => $token]);
    }

    public function code(Request $request)
    {
        $request->validate(
            [
                'code' => 'required|numeric|digits:5'
            ]
        );

        $user = $request->user();


        if($user->otp_code != $request->code){
            return $this->sendResponse(401, 'Invalid otp code');
        }

        $user->update(
            [
                'otp_code' => null
            ]
        );

        return $this->sendResponse(200, 'Code is correct');
    }

    public function resetPassword(Request $request)
    {
        $request->validate(
            [
                'password' => [
                    'bail',
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                    Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised()
                    ]
            ]
        );

        $user = $request->user();

        $user->update(
            [
                'password' => $request->password
            ]
        );

        return $this->sendResponse(200, 'Password has been reset');
    }
}
