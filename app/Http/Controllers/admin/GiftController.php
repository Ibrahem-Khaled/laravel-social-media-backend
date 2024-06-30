<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GiftController extends Controller
{
    //


    public function listGifts(){

        $gifts = Gift::get();

        return view('admin.giftsList' , compact('gifts'));
    }


    public function addGift(){
        $users = User::all();
        $ctegories = Category::all();
        return view('admin.giftsAdd' , compact('users' ,'ctegories'));
    }

    public function createNewGift(Request $request){

        // dd ($request) ;
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|string ',
            'image' => 'nullable|image',
            'video' => 'nullable',

        ]);


        $gift = Gift::create([
            'title' => $validatedData['title'],
            'price' => $validatedData['price'],
            'video' => $validatedData['video'],
            'image' =>$validatedData['image'],

        ]);

        return redirect()->back();

    }


    public function deleteGift(Request $request){
        $gift = Gift::destroy($request->id);
        return $request->id;
    }

    public function editGift(Request $request){
        $users = User::all();
        $ctegories = Category::all();
        $gift = Gift::findOrFail($request->id);

        return view('admin.giftsEdit' , compact('users' ,'ctegories' ,'gift'));
    }

    public function updateGift(Request $request){



        $gift = Gift::findOrFail($request->id);

        $gift->update([
            'title' => $request['title'],
            'price' => $request['price'],
            'video' => $request['video'],
            'image' =>$request['image'],

        ]);

        return redirect()->back();

    }
}
