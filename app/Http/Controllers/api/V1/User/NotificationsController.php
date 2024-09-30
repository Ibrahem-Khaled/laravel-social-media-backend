<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\NotificationsResource;
use App\Models\Post;
use App\Notifications\PostLikedNotification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index(Request $request)
    {
        $notifications = $request->user()->notifications()->paginate(10);

        return $this->sendResponse(200, 'Notifications fetched successfully', NotificationsResource::collection($notifications));
    }

    public function markAsRead(Request $request, $id)
    {
        $request->user()->notifications()->where('id', $id)->first()->markAsRead();

        return $this->sendResponse(200, 'Notification marked as read successfully');
    }

    public function markAllAsRead(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();

        return $this->sendResponse(200, 'All notifications marked as read successfully');
    }

}
