<?php

use App\Http\Controllers\API\V1\User\ProfileController as ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('', [ProfileController::class, 'profile']);
Route::post('complete-profile', [ProfileController::class, 'completeProfile']);
