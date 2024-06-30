<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{
    //


    public function listPosts(){

        $posts = Posts::with('user' )->get();

        return view('admin.postsList' , compact('posts'));
    }


    public function addPost(){

        $users = User::all();
        return view('admin.postsAdd' , compact('users'));
    }

    public function createNewPost(Request $request){

        // dd ($request) ;
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image',
            'body' => 'nullable',


        ]);


        $post = Posts::create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'user_id' => $request['user_id'],
            'status' => $request['status'],
            'image' =>$validatedData['image'],

        ]);

        return redirect()->back();

    }


    public function deletePost(Request $request){
        $post = Posts::destroy($request->id);
        return $request->id;
    }

    public function editPost(Request $request){
        $post = Posts::findOrFail($request->id);
        $users = User::all();
        return view('admin.postsEdit' , compact('post' , 'users'));
    }

    public function updatePost(Request $request){



        $post = Posts::findOrFail($request->id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image',
            'body' => 'nullable',
        ]);


        $post->update([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'user_id' => $request['user_id'],
            'status' => $request['status'],
            'image' =>$request['image'],

        ]);


        return redirect()->back();

    }
}
