<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    // GET /api/countries
    public function index()
    {
        $countries = Country::all();
        return response()->json($countries, 200);
    }

    // POST /api/countries
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'cca2' => 'required|string|max:2',
            'country_code' => 'required|string|max:10',
            'flag' => 'required|image'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $country = Country::create([
            'name' => $request->name,
            'status' => $request->status,
            'cca2' => $request->cca2,
            'country_code' => $request->country_code,
            'flag' => $request->flag
        ]);

        return response()->json($country, 201);
    }

    // GET /api/countries/{id}
    public function show($id)
    {
        $country = Country::find($id);

        if (!$country) {
            return response()->json(['message' => 'Country not found'], 404);
        }

        return response()->json($country, 200);
    }

    // PUT /api/countries/{id}
    public function update(Request $request, $id)
    {
        $country = Country::find($id);

        if (!$country) {
            return response()->json(['message' => 'Country not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'cca2' => 'required|string|max:2',
            'country_code' => 'required|string|max:10',
            'flag' => 'nullable|image'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $country->update([
            'name' => $request->name,
            'status' => $request->status,
            'cca2' => $request->cca2,
            'country_code' => $request->country_code,
            'flag' => $request->flag
        ]);

        return response()->json($country, 200);
    }

    // DELETE /api/countries/{id}
    public function destroy($id)
    {
        $country = Country::find($id);

        if (!$country) {
            return response()->json(['message' => 'Country not found'], 404);
        }

        $country->delete();
        return response()->json(['message' => 'Country deleted'], 200);
    }
}
