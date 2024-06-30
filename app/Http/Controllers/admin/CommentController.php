<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CommentController extends Controller
{
    //


    public function listComments(){

        $comments = Comments::with('user' , 'post' )->get();

        return view('admin.commentsList' , compact('comments'));
    }


    public function addComment(){

        $users = User::all();
        $posts = Posts::all();
        return view('admin.commentsAdd' , compact('users','posts'));
    }

    public function createNewComment(Request $request){

        // dd ($request) ;
        $validatedData = $request->validate([
            'user_id' => 'required',
            'post_id' => 'required',
            'body' => 'required',


        ]);


        $comment = Comments::create([

            'post_id' => $validatedData['post_id'],
            'user_id' => $request['user_id'],
            'status' => $request['status'],
            'body' => $request['body'],


        ]);

        return redirect()->back();

    }


    public function deleteComment(Request $request){
        $comment = Comments::destroy($request->id);
        return $request->id;
    }

    public function editComment(Request $request){
        $comment = Comments::findOrFail($request->id);
        $users = User::all();
        $posts = Posts::all();

        return view('admin.commentsEdit' , compact('comment' , 'users' , 'posts'));
    }

    public function updateComment(Request $request){



        $comment = Comments::findOrFail($request->id);

        $comment->update([
            'post_id' => $request['post_id'],
            'user_id' => $request['user_id'],
            'status' => $request['status'],
            'body' => $request['body'],

        ]);

        return redirect()->back();

    }
}
