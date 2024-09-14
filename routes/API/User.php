<?php

use App\Http\Controllers\API\V1\User\ProfileController as ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('', [ProfileController::class, 'profile']);
Route::post('complete-profile', [ProfileController::class, 'completeProfile']);
Route::get('following', [ProfileController::class, 'following']);
Route::get('followers', [ProfileController::class, 'followers']);
Route::post('follow', [ProfileController::class, 'follow']);
Route::post('unfollow', [ProfileController::class, 'unfollow']);
