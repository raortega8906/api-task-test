<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return 'Hello API TASK';
})->name('api');

// Auth Routes Public
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// Middleware to protect routes
Route::middleware(['auth:api', 'is_admin'])->group(function () {

    // Auth Routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'me']);

    // Category Routes
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    // Task Routes
    Route::get('/categories/{id}/tasks', [TaskController::class, 'index']);
    Route::post('/categories/{id}/tasks', [TaskController::class, 'store']);
    Route::get('/categories/{id}/tasks/{idTask}', [TaskController::class, 'show']);
    Route::put('/categories/{id}/tasks/{idTask}', [TaskController::class, 'update']);
    Route::delete('/categories/{id}/tasks/{idTask}', [TaskController::class, 'destroy']);
    
});