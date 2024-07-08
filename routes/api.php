<?php

use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\api\authController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\EntryController;
use App\Http\Controllers\API\GiftController;
use App\Http\Controllers\API\LikeController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\RoomsController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [authController::class, 'login']);
Route::post('register', [authController::class, 'register']);

Route::group([], function () {
    Route::post('logout', [authController::class, 'logout']);
    Route::get('user', [authController::class, 'getAuthenticatedUser']);

    //this is for posts only route
    Route::apiResource('posts', PostController::class);
    Route::post('posts/update/{id}' ,[PostController::class,'update'] );


    //this is for room only route
    Route::apiResource('rooms', RoomsController::class);
    Route::post('rooms/update/{id}' ,[RoomsController::class,'update'] );

    Route::apiResource('categories', CategoryController::class);
    Route::post('categories/update/{id}' ,[CategoryController::class,'update'] );

    Route::apiResource('comments', CommentController::class);
    Route::post('comments/update/{id}' ,[CommentController::class,'update'] );

    Route::apiResource('countries', CountryController::class);
    Route::post('countries/update/{id}' ,[CountryController::class,'update'] );

    Route::apiResource('entries', EntryController::class);
    Route::post('entries/update/{id}' ,[EntryController::class,'update'] );

    Route::apiResource('gifts', GiftController::class);
    Route::post('gifts/update/{id}' ,[GiftController::class,'update'] );

    Route::apiResource('likes', LikeController::class);
    Route::post('likes/update/{id}' ,[LikeController::class,'update'] );

    Route::post('/frames/{frameId}/buy', [UserController::class, 'buyFrame'])->middleware('auth:api');

    Route::middleware('auth:api')->group(function () {
        Route::post('chats', [ChatController::class, 'store']);
        Route::post('chats/{chat}/messages', [MessageController::class, 'store']);
        Route::get('chats', [ChatController::class, 'index']);
        Route::get('chats/{chat}/messages', [MessageController::class, 'index']);
    });






});
