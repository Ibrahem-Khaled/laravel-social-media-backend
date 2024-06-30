<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CountryController extends Controller
{
    //


    public function listCountries(){

        $countries = Country::get();

        return view('admin.countriesList' , compact('countries'));
    }


    public function addcountry(){


        return view('admin.countriesAdd' );
    }

    public function createNewcountry(Request $request){

        // dd ($request) ;
        $validatedData = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'cca2' => 'required',
            'code' => 'required',
            'flag' => 'nullable|image',


        ]);


        $country = Country::create([

            'name' => $validatedData['name'],
            'status' => $validatedData['status'],
            'cca2' => $validatedData['cca2'],
            'country_code' => $validatedData['code'],
            'flag' => $validatedData['flag'],



        ]);

        return redirect()->back();

    }


    public function deletecountry(Request $request){
        $country = Country::destroy($request->id);
        return $request->id;
    }

    public function editcountry(Request $request){
        $country = Country::findOrFail($request->id);
        $users = User::all();
        $posts = Posts::all();

        return view('admin.countriesEdit' , compact('country' , 'users' , 'posts'));
    }

    public function updatecountry(Request $request){



        $country = Country::findOrFail($request->id);

        $validatedData = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'cca2' => 'required',
            'code' => 'required',
            'flag' => 'nullable'

        ]);


        $country->update([

            'name' => $validatedData['name'],
            'status' => $validatedData['status'],
            'cca2' => $validatedData['cca2'],
            'country_code' => $validatedData['code'],
            'flag' => $request['flag'],



        ]);



        return redirect()->back();

    }
}
