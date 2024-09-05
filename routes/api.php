<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


//Route::post('login', [AuthController::class, 'login'])->name('login');

//Route::middleware(['auth:sanctum', 'cors'])->group(function () {
//
//    Route::get('profile', [AuthController::class, 'profile']);
//    Route::post('user/change', [AuthController::class, 'profileUpdate']);
//
//    Route::get('/cables/count', [CableController::class, 'getAllCount']);
//    Route::get('cables/{limit?}', [CableController::class, 'index'])
//        ->where('limit', '[0-9]+');
//    Route::get('cable/{id}', [CableController::class, 'getOne']);
//    Route::post('cable/create', [CableController::class, 'store']);
//    Route::post('cable/update', [CableController::class, 'update']);
//    Route::delete('/delete/{id}', [CableController::class, 'destroy']);
//
//    Route::get('getCableChanges/{id}', [CableChangeController::class, 'getCableChanges']);
//
//    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
//
//});
