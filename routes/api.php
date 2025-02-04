<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\API\CategoryController;



// Accessible to everyone ///
////////////////////////////

// LOGIN // 
Route::post('/login', [AuthController::class, 'login']);

// Category  // 
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);



// Only accessible via JWT //
////////////////////////////

Route::middleware('auth:api')->group(function() {

    // Auth // 
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/currentuser', [UserController::class, 'currentUser']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Category  // 
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
});
