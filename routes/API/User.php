<?php

use App\Http\Controllers\API\V1\User\{CommentsController,PostsController,ProfileController,RoomsController,NotificationsController, SearchController};
use Illuminate\Support\Facades\Route;



Route::get('', [ProfileController::class, 'profile']);
Route::post('complete-profile', [ProfileController::class, 'completeProfile']);
Route::get('following', [ProfileController::class, 'following']);
Route::get('followers', [ProfileController::class, 'followers']);
Route::post('follow', [ProfileController::class, 'follow']);
Route::post('unfollow', [ProfileController::class, 'unfollow']);

Route::get('profile/{user:slug}', [ProfileController::class, 'show'])->name('profile.show');


//Notifications Routes
Route::group(['prefix' => 'notifications' , 'as' => 'notifications.' , 'controller' => NotificationsController::class], function(){

    Route::get('', 'index');
    Route::get('mark-all-as-read', 'markAllAsRead');
    Route::get('{id}', 'markAsRead');

});

//Search Route

Route::get('search', action: SearchController::class);

//Rooms Routes
Route::get('rooms', [RoomsController::class, 'index']);
Route::post('rooms/join',  [RoomsController::class, 'join'])->name('rooms.join');


//Posts Routes
Route::group(['prefix' => 'posts' , 'as' => 'posts.' , 'controller' => PostsController::class], function(){

    Route::get('', 'index');
    Route::get('{id}' , 'show')->name('show');
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
