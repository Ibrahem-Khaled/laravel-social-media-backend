<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Entry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EntryController extends Controller
{
    // GET /api/entries
    public function index()
    {
        $entries = Entry::all();
        return response()->json($entries, 200);
    }

    // POST /api/entries
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'expire' => 'nullable|date',
            'image' => 'nullable|image',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $entry = Entry::create([
            'title' => $request->title,
            'price' => $request->price,
            'expire' => $request->expire,
            'image' => $request->image,
            'video' => $request->video
        ]);

        return response()->json($entry, 201);
    }

    // GET /api/entries/{id}
    public function show($id)
    {
        $entry = Entry::find($id);

        if (!$entry) {
            return response()->json(['message' => 'Entry not found'], 404);
        }

        return response()->json($entry, 200);
    }

    // PUT /api/entries/{id}
    public function update(Request $request, $id)
    {
        $entry = Entry::find($id);

        if (!$entry) {
            return response()->json(['message' => 'Entry not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'expire' => 'nullable|date',
            'image' => 'nullable|image',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $entry->update([
            'title' => $request->title,
            'price' => $request->price,
            'expire' => $request->expire,
            'image' => $request->image,
            'video' => $request->video
        ]);

        return response()->json($entry, 200);
    }

    // DELETE /api/entries/{id}
    public function destroy($id)
    {
        $entry = Entry::find($id);

        if (!$entry) {
            return response()->json(['message' => 'Entry not found'], 404);
        }

        $entry->delete();
        return response()->json(['message' => 'Entry deleted'], 200);
    }
}
