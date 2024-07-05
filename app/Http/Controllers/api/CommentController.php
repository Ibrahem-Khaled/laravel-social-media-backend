<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    // GET /api/comments
    public function index()
    {
        $comments = Comments::with('user', 'post')->get();
        return response()->json($comments, 200);
    }

    // POST /api/comments
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
            'body' => 'required|string',
            'status' => 'nullable|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $comment = Comments::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'status' => $request->status,
            'body' => $request->body,
        ]);

        return response()->json($comment, 201);
    }

    // GET /api/comments/{id}
    public function show($id)
    {
        $comment = Comments::with('user', 'post')->find($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        return response()->json($comment, 200);
    }

    // PUT /api/comments/{id}
    public function update(Request $request, $id)
    {
        $comment = Comments::find($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
            'body' => 'required|string',
            'status' => 'nullable|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $comment->update([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'status' => $request->status,
            'body' => $request->body,
        ]);

        return response()->json($comment, 200);
    }

    // DELETE /api/comments/{id}
    public function destroy($id)
    {
        $comment = Comments::find($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $comment->delete();
        return response()->json(['message' => 'Comment deleted'], 200);
    }
}
