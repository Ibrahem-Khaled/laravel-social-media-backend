<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    //


    public function listCategories(){

        $categories = Category::all();

        return view('admin.categoriesList' , compact('categories'));
    }


    public function addCategory(){

        return view('admin.categoriesAdd');
    }

    public function createNewCategory(Request $request){

        // dd ($request) ;
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image'

        ]);


        $category = Category::create([
            'name' => $validatedData['name'],
            'status' => $request['status'],
            'slug' => $request['slug'],
            'image' =>$validatedData['image'],

        ]);

        return redirect()->back();

    }


    public function deleteCategory(Request $request){
        $category = Category::destroy($request->id);
        return $request->id;
    }

    public function editCategory(Request $request){
        $category = Category::findOrFail($request->id);

        return view('admin.categoriesEdit' , compact('category'));
    }

    public function updateCategory(Request $request){



        $category = Category::findOrFail($request->id);

        $category->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => $request['role'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'gender' => $request['gender'],
            'date_of_birth' => $request['birthDay'],
            'slug' => $request['slug'],
            'image' => $request['image']

        ]);

        return redirect()->back();

    }
}
