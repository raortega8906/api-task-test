<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Hello API TASK';
})->name('api');

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