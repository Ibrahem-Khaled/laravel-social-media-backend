<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Posts::all();
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'image' => 'nullable|string',
            'user_id' => 'required|integer',
        ]);

        $post = Posts::create($validatedData);
        return response()->json($post, 201);
    }

    // Display the specified resource.
    public function show($id)
    {
        $post = Posts::findOrFail($id);
        return response()->json($post);
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'image' => 'nullable|string',
            'user_id' => 'required|integer',
        ]);

        $post = Posts::findOrFail($id);
        $post->update($validatedData);
        return response()->json($post);
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $post = Posts::findOrFail($id);
        $post->delete();
        return response()->json(null, 204);
    }
}
