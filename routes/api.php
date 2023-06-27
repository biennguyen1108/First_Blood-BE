<?php


use App\Http\Controllers\BugController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
// Routes for users
    Route::controller(UserController::class)->group(function () {

        Route::get('users', 'index');
        Route::get('users/{id}', 'show');
        Route::post('users', 'store');
        Route::put('users/{id}', 'update');
        Route::delete('users/{id}', 'destroy');
    });

    // Routes for projects
    Route::get('projects', [ProjectController::class, 'index']);
    Route::get('projects/{id}', [ProjectController::class, 'show']);
    Route::post('projects', [ProjectController::class, 'store']);
    Route::put('projects/{id}', [ProjectController::class, 'update']);
    Route::delete('projects/{id}', [ProjectController::class, 'destroy']);

    //routes for Bugs
    Route::get('bugs', [BugController::class, 'index']);
    Route::get('bugs/{id}', [BugController::class, 'show']);
    Route::post('bugs', [BugController::class, 'store']);
    Route::put('bugs/{id}', [BugController::class, 'update']);
    Route::delete('bugs/{id}', [BugController::class, 'destroy']);


});


Route::post('login', [LoginController::class, 'login']);
Route::get('quan', [ProjectController::class, 'getProject']);



