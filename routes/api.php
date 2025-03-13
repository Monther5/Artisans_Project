<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::post('tasks',[TaskController::class,'store'] );
// Route::get('tasks',[TaskController::class,'index'] );
// Route::put('tasks/{id}',[TaskController ::class,'update']);
// Route::get('tasks/{id}',[TaskController::class,'show'] );

Route::post('register', [UserController::class,'register'] );
Route::post('login', [UserController::class,'login'] );


Route::middleware('auth:sanctum')->group(function () {
Route::delete('tasks/{id}',[TaskController::class,'destroy'] );
Route::get('task/{id}/user', [TaskController::class,'getTaskuser'] );
Route::post('task/{id}/category', [TaskController::class,'AddCategoryToTask'] );
Route::apiResource('tasks', TaskController::class)->middleware('auth:sanctum');
Route::get('tasks/priority', [TaskController::class,'OrderTaskByPriority'] );

Route::put('Profile/{id}', action: [ProfileController::class,'update'] );
Route::post('Profile', [ProfileController::class,'store'] );
Route::get('Profile/{id}', [ProfileController::class,'show'] );


Route::post('logout', [UserController::class,'logout'] );


Route::get('task/all', [TaskController::class,'getAllTask'] )->middleware('CheckUser');

Route::get('user/{id}/profile', [UserController::class,'getProfile'] );
Route::get('user/{id}/task', [UserController::class,'getTask'] );

Route::post('task/{id}/favorite', [TaskController::class,'AddToFavorite'] );
Route::delete('task/{id}/favorite', [TaskController::class,'RemoveFromFavorite'] );
});



