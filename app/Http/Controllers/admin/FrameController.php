<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Frame;
use App\Models\User;
use Illuminate\Http\Request;

class FrameController extends Controller
{
    //


    public function listFrames(){

        $frames = Frame::get();

        return view('admin.framesList' , compact('frames'));
    }


    public function addFrame(){
        $users = User::all();
        $ctegories = Category::all();
        return view('admin.framesAdd' , compact('users' ,'ctegories'));
    }

    public function createNewFrame(Request $request){

        // dd ($request) ;
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|string ',


        ]);


        $frame = Frame::create([
            'title' => $validatedData['title'],
            'price' => $validatedData['price'],
            'expire' => $request['expire'],
            'image' =>$request['image'],

        ]);

        return redirect()->back();

    }


    public function deleteFrame(Request $request){
        $frame = Frame::destroy($request->id);
        return $request->id;
    }

    public function editFrame(Request $request){

        $users = User::all();

        return view('admin.framesEdit' , compact('frame'));
    }

    public function updateFrame(Request $request){

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|string ',


        ]);


        $frame = Frame::findOrFail($request->id);

        $frame->update([
            'title' => $validatedData['title'],
            'price' => $validatedData['price'],
            'expire' => $request['expire'],
            'image' =>$request['image'],

        ]);

        return redirect()->back();

    }
}
