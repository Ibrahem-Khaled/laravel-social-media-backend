<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // GET /api/categories
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    // POST /api/categories
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image',
            'status' => 'required|in:active,inactive',
            'slug' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $category = Category::create([
            'name' => $request->name,
            'status' => $request->status,
            'slug' => $request->slug,
            'image' => $request->image,
        ]);

        return response()->json($category, 201);
    }

    // GET /api/categories/{id}
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($category, 200);
    }

    // PUT /api/categories/{id}
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'slug' => 'required|string|max:255',
            'image' => 'nullable|image'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $category->update([
            'name' => $request->name,
            'status' => $request->status,
            'slug' => $request->slug,
            'image' => $request->image,
        ]);

        return response()->json($category, 200);
    }

    // DELETE /api/categories/{id}
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete();
        return response()->json(['message' => 'Category deleted'], 200);
    }
}

