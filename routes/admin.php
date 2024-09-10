<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\InstanceController;
use App\Http\Controllers\Admin\RoadController;
use App\Http\Controllers\Admin\RoadMapController;

Route::middleware(['IsAdmin'])->group(function () {

    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/get-users', [UserController::class, 'getUsers'])->name('getUsers');
    Route::get('/user/{id}', [UserController::class, 'getOne'])->name('user.getOne');
    Route::post('/user/create', [UserController::class, 'store'])->name('user.store');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/instances', [InstanceController::class, 'index'])->name('instance.index');
    Route::get('/get-instances', [InstanceController::class, 'getInstances'])->name('getInstances');
    Route::get('/instance/{id}', [InstanceController::class, 'getOne'])->name('instance.getOne');
    Route::post('/instance/create', [InstanceController::class, 'store'])->name('instance.store');
    Route::put('/instance/update/{id}', [InstanceController::class, 'update'])->name('instance.update');
    Route::delete('/instance/delete/{id}', [InstanceController::class, 'destroy'])->name('instance.destroy');

    Route::get('/roads', [RoadController::class, 'index'])->name('road.index');
    Route::get('/get-roads', [RoadController::class, 'getRoads'])->name('getRoads');
    Route::get('/road/{id}', [RoadController::class, 'getOne'])->name('road.getOne');
    Route::post('/road/create', [RoadController::class, 'store'])->name('road.store');
    Route::put('/road/update/{id}', [RoadController::class, 'update'])->name('road.update');
    Route::delete('/road/delete/{id}', [RoadController::class, 'destroy'])->name('road.destroy');

    Route::get('/road-maps', [RoadMapController::class, 'index'])->name('road-map.index');
    Route::get('/road-map/{id}', [RoadMapController::class, 'getOne'])->name('road-map.getOne');
    Route::post('/road-map/create', [RoadMapController::class, 'store'])->name('road-map.store');
    Route::put('/road-map/update/{id}', [RoadMapController::class, 'update'])->name('road-map.update');
    Route::delete('/road-map/delete/{id}', [RoadMapController::class, 'destroy'])->name('road-map.destroy');

});
