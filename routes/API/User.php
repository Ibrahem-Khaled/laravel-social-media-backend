<?php

use App\Http\Controllers\API\V1\User\PostsController;
use App\Http\Controllers\API\V1\User\ProfileController;
use App\Http\Controllers\API\V1\User\RoomsController;
use Illuminate\Support\Facades\Route;



Route::get('', [ProfileController::class, 'profile']);
Route::post('complete-profile', [ProfileController::class, 'completeProfile']);
Route::get('following', [ProfileController::class, 'following']);
Route::get('followers', [ProfileController::class, 'followers']);
Route::post('follow', [ProfileController::class, 'follow']);
Route::post('unfollow', [ProfileController::class, 'unfollow']);

//Rooms Routes
Route::get('rooms', [RoomsController::class, 'index']);
Route::post('rooms/join',  [RoomsController::class, 'join']);


//Posts Routes
Route::group(['prefix' => 'posts' , 'as' => 'posts.' , 'controller' => PostsController::class], function(){

    Route::get('', 'index');
    Route::get('{id}' , 'show');
    Route::post('', 'store');
    Route::post('{post}' , 'update');
    Route::delete('{post}' , 'destroy');

});
