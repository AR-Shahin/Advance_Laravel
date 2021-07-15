<?php

use App\Http\Controllers\VueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Composition Api

Route::get('todos', [VueController::class, 'index']);
Route::post('todos', [VueController::class, 'store']);
Route::post('todo-toggle/{id}', [VueController::class, 'toggle']);
Route::delete('todos/{id}', [VueController::class, 'destroy']);
