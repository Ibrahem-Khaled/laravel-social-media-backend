<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\JoinRoomRequest;
use App\Http\Resources\API\V1\RoomResource;
use App\Models\Rooms;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function index()
    {
        $rooms = Rooms::with('user', 'category')->active()->latest()->get();

        return $this->sendResponse(200, 'Rooms retrieved successfully.' , RoomResource::collection($rooms));
    }

    public function join(JoinRoomRequest $request)
    {
        $room = Rooms::where('slug', $request->room)->first();

        if($room->password && $room->password !== $request->password) {
            return $this->sendResponse(401, 'The password is incorrect.');
        }

        return $this->sendResponse(200, 'You have joined the room successfully.');
    }
}
