<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Rooms;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RoomController extends Controller
{
    //


    public function listRooms(){

        $rooms = Rooms::with('user' , 'category')->get();

        return view('admin.roomsList' , compact('rooms'));
    }


    public function addRoom(){
        $users = User::all();
        $ctegories = Category::all();
        return view('admin.roomsAdd' , compact('users' ,'ctegories'));
    }

    public function createNewRoom(Request $request){

        // dd ($request) ;
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image'

        ]);


        $room = Rooms::create([
            'name' => $validatedData['name'],
            'password' => Hash::make($validatedData['password']),
            'status' => $request['status'],
            'room_id' => $request['room_id'],
            'category_id' => $request['category_id'],
            'slug' => $request['slug'],
            'image' =>$validatedData['image'],

        ]);

        return redirect()->back();

    }


    public function deleteRoom(Request $request){
        $room = Rooms::destroy($request->id);
        return $request->id;
    }

    public function editRoom(Request $request){
        $users = User::all();
        $ctegories = Category::all();
        $room = Rooms::findOrFail($request->id);

        return view('admin.roomsEdit' , compact('users' ,'ctegories' ,'room'));
    }

    public function updateRoom(Request $request){



        $room = Rooms::findOrFail($request->id);

        $room->update([
            'name' => $request['name'],
            'user_id' => $request['user_id'],
            'category' => $request['category_id'],
            'status' => $request['status'],
            'slug' => $request['slug'],
            'image' => $request['image']

        ]);

        return redirect()->back();

    }
}
