<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\LoginRequest;
use App\Http\Requests\API\V1\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Str;
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

        $slug = Str::slug($request->name, '-');
        $request['slug'] = $this->generate($slug);

        $user = User::create(
            [
                'name' => $request->name,
                'slug' => $request->slug,
                'email' => $request->email,
                'password' => $request->password,
            ]
        );

        $token = $user->createToken('token')->plainTextToken;

        return $this->sendResponse(201, "Welcome to " . env('APP_NAME') . ", {$user->name}", ['token' => $token]);
    }
}
