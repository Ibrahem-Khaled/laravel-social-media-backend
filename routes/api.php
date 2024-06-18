<?php

use App\Http\Controllers\api\authController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\RoomsController;
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

    //this is for room only route
    Route::apiResource('rooms', RoomsController::class);

});
