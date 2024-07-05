<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RoomsController extends Controller
{
    public function index()
    {
        return Rooms::all();
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        if(!$request->user_id){
            $user = auth()->guard('api')->user();
            $request['user_id'] = $user->id;
        }
       $request['password'] = Hash::make($request['password']);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'user_id' => 'required|integer',
            'slug' => 'required|string|max:255|unique:rooms,slug',
            'image' => 'nullable|image',
            'password' => 'nullable|string',
            'category_id' => 'required|integer',
        ]);

        $room = Rooms::create($validatedData);
        return response()->json($room, 201);
    }

    // Display the specified resource.
    public function show($id)
    {
        $room = Rooms::findOrFail($id);
        return response()->json($room);
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {

        if(!$request->user_id){
            $user = auth()->guard('api')->user();
            $request['user_id'] = $user->id;
        }
       $request['password'] = Hash::make($request['password']);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'user_id' => 'required|integer',
            'slug' => 'required|string|max:255|unique:rooms,slug,' . $id,
            'image' => 'nullable|string',
            'password' => 'nullable|string',
            'category_id' => 'required|integer',
        ]);

        $room = Rooms::findOrFail($id);
        $room->update($validatedData);
        return response()->json($room);
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $room = Rooms::findOrFail($id);
        $room->delete();
        return response()->json(null, 204);
    }
}
