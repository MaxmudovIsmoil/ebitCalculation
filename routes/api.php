<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderActionController;


Route::post('login', [AuthController::class, 'login'])->name('login');

//Route::middleware(['auth:sanctum', 'cors'])->group(function () {
//    Route::get('profile', [AuthController::class, 'profile']);
//    Route::post('user/change', [AuthController::class, 'profileUpdate']);

    Route::get('orders/{limit?}', [OrderController::class, 'index'])->where('limit', '[0-9]+');
    Route::get('order/{id}', [OrderController::class, 'getOne']);
    Route::post('order/create', [OrderController::class, 'store']);
    Route::post('order/update', [OrderController::class, 'update']);

//    Route::get('order-detail/{id}', [OrderDetailController::class, 'index'])->where('limit', '[0-9]+');
    Route::get('order-action/{id}', [OrderActionController::class, 'index'])->where('limit', '[0-9]+');
    Route::get('order-road', [OrderRoadMapRunController::class, 'index'])->where('limit', '[0-9]+');

//    Route::get('getCableChanges/{id}', [CableChangeController::class, 'getCableChanges']);
//    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
//});
