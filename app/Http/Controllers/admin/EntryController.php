<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Entry;
use App\Models\User;
use Illuminate\Http\Request;

class EntryController extends Controller
{

    public function listEntries(){

        $entries = Entry::get();

        return view('admin.entriesList' , compact('entries'));
    }


    public function addEntry(){
        $users = User::all();
        $ctegories = Category::all();
        return view('admin.entriesAdd' , compact('users' ,'ctegories'));
    }

    public function createNewEntry(Request $request){

        // dd ($request) ;
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|string ',


        ]);


        $entry = Entry::create([
            'title' => $validatedData['title'],
            'price' => $validatedData['price'],
            'expire' => $request['expire'],
            'image' =>$request['image'],
            'video' =>$request['video'],

        ]);

        return redirect()->back();

    }


    public function deleteEntry(Request $request){
        $entry = Entry::destroy($request->id);
        return $request->id;
    }

    public function editEntry(Request $request){
        $users = User::all();
        $ctegories = Category::all();
        $entry = Entry::findOrFail($request->id);

        return view('admin.entriesEdit' , compact('users' ,'ctegories' ,'entry'));
    }

    public function updateEntry(Request $request){


        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|string ',


        ]);



        $entry = Entry::findOrFail($request->id);

        $entry->update([
            'title' => $validatedData['title'],
            'title' => $validatedData['title'],
            'price' => $validatedData['price'],
            'expire' => $request['expire'],
            'image' =>$request['image'],
            'video' =>$request['video'],


        ]);

        return redirect()->back();

    }
}
