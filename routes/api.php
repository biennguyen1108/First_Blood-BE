<?php

use App\Http\Controllers\BugController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::middleware(['check-role:2'])->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('users', 'index');
            Route::get('user/{id}', 'show');
            Route::put('user/{id}', 'update');
            Route::delete('user/{id}', 'destroy');
        });

        Route::controller(ProjectController::class)->group(function () {
            Route::get('projects', 'index');
            Route::post('project', 'store');
            Route::get('project/{id}', 'show');
            Route::put('project/{id}', 'update');
            Route::delete('project/{id}', 'destroy');
        });
        Route::controller(BugController::class)->group(function () {
            Route::get('bugs', 'index');
            Route::get('bug/{id}', 'show');
            Route::post('bug', 'store');
            Route::put('bug/{id}', 'update');
            Route::delete('bug/{id}', 'destroy');
        });
    });

    Route::get('project_byuser',[\App\Http\Controllers\GetProjectUser::class,'index']);

    Route::get('current-user',[UserController::class,'getCurrentUser']);

});

//Route::get('project/bug/{id}',[BugController::class,'BugByProject']);
Route::get('project/bug/{id}',[BugController::class,'BugFilter']);
Route::get('project/member/{id}',[UserController::class,'getUserByProject']);
Route::get('steps/{id}',[BugController::class,'getStep']);

Route::post('login', [LoginController::class, 'login']);
Route::post('user', [UserController::class, 'store']);
Route::post('create_role_user', [\App\Http\Controllers\RoleUserController::class, 'store']);
Route::post('add_member',[ProjectController::class,'addUserIntoProject']);


