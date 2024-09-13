<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {

        if(!auth()->attempt($request->only('email', 'password'))){
            return $this->sendResponse(401, "Invalid credentials", null);
        }

        $user = auth()->user();

        $token = $user->createToken('token')->plainTextToken;

        return $this->sendResponse(200, "Welcome Back, $user->name", ['token' => $token]);
    }
}
