<?php

use App\Http\Controllers\Auth\{LoginController, LogoutController, MeController, RegisterController};
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', MeController::class);
    Route::post('logout', LogoutController::class);
});

Route::post('login', LoginController::class);
Route::post('register', RegisterController::class);
