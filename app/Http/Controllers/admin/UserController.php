<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Gift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //


    public function listUsers(){

        $users = User::all();

        return view('admin.usersList' , compact('users'));
    }


    public function addUser(){

        return view('admin.usersAdd');
    }

    public function createNewUser(Request $request){

        // dd ($request) ;
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image'

        ]);


        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $request['role'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'gender' => $request['gender'],
            'date_of_birth' => $request['birthDay'],
            'slug' => $request['slug'],
            'image' =>$validatedData['image'],

        ]);

        return redirect()->back();

    }


    public function deleteUser(Request $request){
        $user = User::destroy($request->id);
        return $request->id;
    }

    public function editUser(Request $request){
        $user = User::findOrFail($request->id);

        return view('admin.usersEdit' , compact('user'));
    }

    public function updateUser(Request $request){



        $user = User::findOrFail($request->id);

        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => $request['role'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'gender' => $request['gender'],
            'date_of_birth' => $request['birthDay'],
            'slug' => $request['slug'],
            'image' => $request['image']

        ]);

        return redirect()->back();

    }
    public function listAllGifts(){
        $users = Gift::with('senders','recipients')->get();


        return view('admin.usersGiftsList' , compact('users'));
    }
}
