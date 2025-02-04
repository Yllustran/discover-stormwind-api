<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

// Accessible to everyone
Route::post('/login', [AuthController::class, 'login']);

// Only accessible via JWT
Route::middleware('auth:api')->group(function() {
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/currentuser', [UserController::class, 'currentUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
});