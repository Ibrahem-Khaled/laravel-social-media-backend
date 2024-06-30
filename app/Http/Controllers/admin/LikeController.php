<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Likes;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LikeController extends Controller
{
    //


    public function listLikes(){

        $likes = Likes::with('user' , 'post' )->get();

        return view('admin.likesList' , compact('likes'));
    }


    public function addLike(){

        $users = User::all();
        $posts = Posts::all();
        return view('admin.likesAdd' , compact('users','posts'));
    }

    public function createNewLike(Request $request){

        // dd ($request) ;
        $validatedData = $request->validate([
            'user_id' => 'required',
            'post_id' => 'required'


        ]);


        $like = Likes::create([

            'post_id' => $validatedData['post_id'],
            'user_id' => $request['user_id'],


        ]);

        return redirect()->back();

    }


    public function deleteLike(Request $request){
        $like = Likes::destroy($request->id);
        return $request->id;
    }

    public function editLike(Request $request){
        $like = Likes::findOrFail($request->id);
        $users = User::all();
        $posts = Posts::all();

        return view('admin.likesEdit' , compact('like' , 'users' , 'posts'));
    }

    public function updateLike(Request $request){



        $like = Likes::findOrFail($request->id);

        $like->update([
            'post_id' => $request['post_id'],
            'user_id' => $request['user_id'],
        ]);

        return redirect()->back();

    }
}
