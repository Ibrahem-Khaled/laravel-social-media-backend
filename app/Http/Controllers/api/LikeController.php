<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Likes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{
    // GET /api/likes
    public function index()
    {
        $likes = Likes::with('user', 'post')->get();
        return response()->json($likes, 200);
    }

    // POST /api/likes
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $like = Likes::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ]);

        return response()->json($like, 201);
    }

    // GET /api/likes/{id}
    public function show($id)
    {
        $like = Likes::with('user', 'post')->find($id);

        if (!$like) {
            return response()->json(['message' => 'Like not found'], 404);
        }

        return response()->json($like, 200);
    }

    // PUT /api/likes/{id}
    public function update(Request $request, $id)
    {
        $like = Likes::find($id);

        if (!$like) {
            return response()->json(['message' => 'Like not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $like->update([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ]);

        return response()->json($like, 200);
    }

    // DELETE /api/likes/{id}
    public function destroy($id)
    {
        $like = Likes::find($id);

        if (!$like) {
            return response()->json(['message' => 'Like not found'], 404);
        }

        $like->delete();
        return response()->json(['message' => 'Like deleted'], 200);
    }
}
