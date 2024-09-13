<?php

use App\Http\Controllers\API\V1\User\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('', [ProfileController::class, 'profile']);
