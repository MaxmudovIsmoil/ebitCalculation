<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\OrderActionController;
use App\Http\Controllers\OrderFileController;
use App\Http\Controllers\LocaleController;

Route::get('/', function () {
    if (!Auth::check()) {
        return redirect('login');
    }
    if(Auth::user()->rule === "1") {
        return redirect()->intended('/admin/orders');
    }
    return redirect()->intended('order');
});

Route::get('login', function () {
    return view('auth.login');
});

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth', 'IsActive'])->group(function () {

    // Order
    Route::get('order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/one/{id}', [OrderController::class, 'getOne'])->name('order.getOne');
    Route::post('/order/create', [OrderController::class, 'store'])->name('order.store');
    Route::put('/order/update/{id}', [OrderController::class, 'update'])->name('order.update');

    // order detail
    Route::get('/order-detail/{orderId}', [OrderDetailController::class, 'index'])->name('orderDetail');
    Route::post('/order-detail/create', [OrderDetailController::class, 'store'])->name('orderDetail.store');
    Route::post('/order-detail/update/{id}', [OrderDetailController::class, 'update']);
    Route::delete('/order-detail/delete/{id}', [OrderDetailController::class, 'destroy']);

    // order file
    Route::get('/order/get-file/{id}', [OrderFileController::class, 'getFiles'])->name('orderFiles');
    Route::post('/order-file/create', [OrderFileController::class, 'store'])->name('orderFile.store');
    Route::delete('/order-file/delete/{id}', [OrderFileController::class, 'destroy']);

    // order action
//    Route::get('/order/action/{orderId}', [OrderActionController::class, 'getOrderAction'])->name('order_action');
    Route::put('/order-action/{orderId}', [OrderActionController::class, 'action'])->name('order.action');


    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    // user profile
    Route::post('/user/profile', [AuthController::class, 'profile'])->name('user.profile');
    Route::get('locale/{lang}', [LocaleController::class, 'lang'])->name('locale');
});

//Route::get('/{any}', function () {
//    return view('app');
//})->where('any', '.*');
