<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\User\CompleteProfileRequest;
use App\Http\Resources\API\V1\UserResource;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(Request $request)
    {
        $user = $request->user();

        return $this->sendResponse(200, $user->name . "'s profile", new UserResource($user));
    }

    public function completeProfile(CompleteProfileRequest $request)
    {
        $user = $request->user();

        $user->update($request->toArray());

        return $this->sendResponse(200, 'Profile updated successfully', new UserResource($user));
    }
}
