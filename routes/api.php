<?php

use App\Http\Controllers\MoviesController;
use App\Http\Controllers\Auth\{LoginController, LogoutController, MeController, RegisterController};
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('me', MeController::class);
    Route::post('logout', LogoutController::class);

    Route::prefix('movies')->group(function () {
        Route::get('', [MoviesController::class, 'index']);
        Route::get('track/{movie:track_id}', [MoviesController::class, 'show']);
        Route::post('create', [MoviesController::class, 'store']);
        Route::put('{movie:track_id}', [MoviesController::class, 'update']);
        Route::delete('{movie:track_id}', [MoviesController::class, 'destroy']);
    });
});

Route::post('login', LoginController::class);
Route::post('register', RegisterController::class);
