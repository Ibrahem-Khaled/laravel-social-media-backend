<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\LoginRequest;
use App\Http\Requests\API\V1\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {

        if(!auth()->attempt($request->only('email', 'password'))){
            return $this->sendResponse(401, "Invalid credentials", null);
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
        $user = User::create($request->toArray());

        $token = $user->createToken('token')->plainTextToken;

        return $this->sendResponse(200, "Welcome to " . env('APP_NAME') . ", {$user->name}", ['token' => $token]);
    }
}
