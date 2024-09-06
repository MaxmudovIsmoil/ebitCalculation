<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\InstanceController;
use App\Http\Controllers\Admin\RoadController;
use App\Http\Controllers\Admin\RoadMapController;

Route::middleware(['IsAdmin'])->group(function () {

    
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/user/{id}', [UserController::class, 'getOne']);
    Route::post('/user/create', [UserController::class, 'store']);
    Route::put('/user/update/{id}', [UserController::class, 'update']);
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy']);

    Route::get('/instances', [InstanceController::class, 'index']);
    Route::get('/instance/{id}', [InstanceController::class, 'getOne']);
    Route::post('/instance/create', [InstanceController::class, 'store']);
    Route::put('/instance/update/{id}', [InstanceController::class, 'update']);
    Route::delete('/instance/delete/{id}', [InstanceController::class, 'destroy']);

    Route::get('/roads', [RoadController::class, 'index']);
    Route::get('/road/{id}', [RoadController::class, 'getOne']);
    Route::post('/road/create', [RoadController::class, 'store']);
    Route::put('/road/update/{id}', [RoadController::class, 'update']);
    Route::delete('/road/delete/{id}', [RoadController::class, 'destroy']);

    Route::get('/road-maps', [RoadMapController::class, 'index']);
    Route::get('/road-map/{id}', [RoadMapController::class, 'getOne']);
    Route::post('/road-map/create', [RoadMapController::class, 'store']);
    Route::put('/road-map/update/{id}', [RoadMapController::class, 'update']);
    Route::delete('/road-map/delete/{id}', [RoadMapController::class, 'destroy']);

});
