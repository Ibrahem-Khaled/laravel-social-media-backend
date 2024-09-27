<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\FollowRequest;
use App\Http\Requests\API\V1\User\CompleteProfileRequest;
use App\Http\Resources\API\V1\UserProfileResource;
use App\Http\Resources\API\V1\UserResource;
use App\Jobs\FollowJob;
use App\Jobs\UnfollowJob;
use App\Models\Following;
use App\Models\User;
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

    public function following(Request $request)
    {
        $user = $request->user();

        if ($user->following <= 0) {
            return $this->sendResponse(200, 'You are not following anyone', []);
        }

        $user->load('followingList', 'followingList.followingUser');

        $followingUsers = $user->followingList->map(function ($following) {
            return $following->followerUser;
        });

        return $this->sendResponse(200, 'List of users you are following', UserResource::collection($followingUsers));
    }

    public function followers(Request $request)
    {
        $user = $request->user();

        if ($user->followers <= 0) {
            return $this->sendResponse(200, 'You do not have any followers', []);
        }

        $user->load('followersList', 'followersList.followerUser');

        $followers = $user->followersList->map(function ($follower) {
            return $follower->followingUser;
        });

        return $this->sendResponse(200, 'List of users following you', UserResource::collection($followers));
    }


    public function follow(FollowRequest $request)
    {
        $user_id = auth()->id();
        $follower_id = $request->follower_id;

        if ($user_id == $follower_id) {
            return $this->sendResponse(400, 'You cannot follow yourself');
        }

        FollowJob::dispatch($user_id, $follower_id);

        return $this->sendResponse(201, 'User followed successfully');
    }

    public function unfollow(FollowRequest $request)
    {
        $user_id = auth()->id();
        $follower_id = $request->follower_id;

        if ($user_id == $follower_id) {
            return $this->sendResponse(400, 'You cannot unfollow yourself');
        }

        UnfollowJob::dispatch($user_id, $follower_id);

        return $this->sendResponse(200, 'User unfollowed successfully');
    }

    public function show(Request $request,User $user)
    {
        $user->load('posts','posts.user');

        return $this->sendResponse(200, $user->name . "'s profile", new UserProfileResource($user));
    }
}
