<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return redirect()->route('orders.create');
});

// Order routes
Route::resource('orders', OrderController::class)->only(['index', 'create', 'store', 'show']);
Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
Route::post('/orders/apply-coupon', [OrderController::class, 'applyCoupon'])->name('orders.apply-coupon');
