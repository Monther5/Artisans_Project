<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('tasks',[TaskController::class,'store'] );
Route::get('tasks',[TaskController::class,'index'] );
Route::put('tasks/{id}',[TaskController ::class,'update']);
Route::get('tasks/{id}',[TaskController::class,'show'] );
Route::delete('tasks/{id}',[TaskController::class,'destroy'] );
// Route::apiResource('tasks', TaskController::class);
Route::post('Profile', [ProfileController::class,'store'] );

Route::get('Profile/{id}', [ProfileController::class,'show'] );

Route::get('user/{id}/profile', [UserController::class,'getProfile'] );
Route::put('Profile/{id}', [ProfileController::class,'update'] );
Route::get('user/{id}/task', [UserController::class,'getTask'] );
Route::get('task/{id}/user', [TaskController::class,'getTaskuser'] );

