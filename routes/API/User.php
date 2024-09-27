<?php

use App\Http\Controllers\API\V1\User\CommentsController;
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

Route::get('profile/{user:slug}', [ProfileController::class, 'show']);

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
    Route::get('{post}/likes' , 'likes');
    Route::post('{post}/like' , 'like');
    Route::post('{post}/unlike' , 'unlike');


});

//Comments Routes
Route::group(['prefix' => 'comments' , 'as' => 'comments.' , 'controller' => CommentsController::class], function(){

    Route::post('', 'store')->name('store');
    Route::post('{comment}' , 'update');
    Route::delete('{comment}' , 'destroy');

});
