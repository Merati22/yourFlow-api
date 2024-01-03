<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WareController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {


    Route::prefix('user')->group(function () {

        Route::get('/', [UserController::class, 'showAuth']);
        Route::post('/logout', [UserController::class, 'logout']);

        // crud for tasks
        Route::prefix('tasks')->middleware('ability:employee')->group(function () {
            Route::get('/', [TaskController::class, 'indexAuth']);
            Route::post('/{activity}', [TaskController::class, 'createAuth']);
            Route::put('/{task}', [TaskController::class, 'updateAuth']);
            Route::delete('/{task}', [TaskController::class, 'deleteAuth']);
        });

    });


    Route::prefix('users')->middleware('ability:manager')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{user}', [UserController::class, 'show']);
        Route::post('/', [UserController::class, 'create']);
        Route::put('/{user}', [UserController::class, 'update']);
        Route::delete('/{user}', [UserController::class, 'delete']);
    });

    // crud for activities
    Route::prefix('activities')->middleware('ability:manager')->group(function () {
        Route::get('/', [ActivityController::class, 'index']);
        Route::get('/{activity}', [ActivityController::class, 'show']);
        Route::post('/', [ActivityController::class, 'create']);
        Route::put('/{activity}', [ActivityController::class, 'update']);
        Route::delete('/{activity}', [ActivityController::class, 'delete']);
    });

    // crud for tasks
    Route::prefix('tasks')->middleware('ability:manager')->group(function () {
        Route::get('/', [TaskController::class, 'index']);
        Route::post('/{activity}/{user}', [TaskController::class, 'create']);
        Route::get('/{task}', [TaskController::class, 'show']);
        Route::put('/{task}', [TaskController::class, 'update']);
        Route::delete('/{task}', [TaskController::class, 'delete']);
    });

    // crud for wares
    Route::prefix('wares')->middleware('ability:warehouse,manager')->group(function () {
        Route::get('/', [WareController::class, 'index']);
        Route::get('/{ware}', [WareController::class, 'show']);
        Route::post('/', [WareController::class, 'create']);
        Route::put('/{ware}', [WareController::class, 'update']);
        Route::delete('/{ware}', [WareController::class, 'delete']);
    });

});


