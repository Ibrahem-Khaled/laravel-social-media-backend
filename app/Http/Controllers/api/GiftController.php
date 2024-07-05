<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GiftController extends Controller
{
    // GET /api/gifts
    public function index()
    {
        $gifts = Gift::all();
        return response()->json($gifts, 200);
    }

    // POST /api/gifts
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'image' => 'nullable|image',
            'video' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $gift = Gift::create([
            'title' => $request->title,
            'price' => $request->price,
            'image' => $request->image,
            'video' => $request->video
        ]);

        return response()->json($gift, 201);
    }

    // GET /api/gifts/{id}
    public function show($id)
    {
        $gift = Gift::find($id);

        if (!$gift) {
            return response()->json(['message' => 'Gift not found'], 404);
        }

        return response()->json($gift, 200);
    }

    // PUT /api/gifts/{id}
    public function update(Request $request, $id)
    {
        $gift = Gift::find($id);

        if (!$gift) {
            return response()->json(['message' => 'Gift not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'image' => 'nullable|image',
            'video' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $gift->update([
            'title' => $request->title,
            'price' => $request->price,
            'image' => $request->image,
            'video' => $request->video
        ]);

        return response()->json($gift, 200);
    }

    // DELETE /api/gifts/{id}
    public function destroy($id)
    {
        $gift = Gift::find($id);

        if (!$gift) {
            return response()->json(['message' => 'Gift not found'], 404);
        }

        $gift->delete();
        return response()->json(['message' => 'Gift deleted'], 200);
    }
}
