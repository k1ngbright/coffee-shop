<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuController;

Route::get('/', function () {
    return redirect()->route('orders.create');
});

// Order routes
Route::resource('orders', OrderController::class)->only(['index', 'create', 'store', 'show']);
Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
Route::post('/orders/apply-coupon', [OrderController::class, 'applyCoupon'])->name('orders.apply-coupon');

// Menu routes (แก้ไขลำดับเส้นทางอย่างถูกต้องเพื่อไม่ให้ระบบหลงพาร์ท)
Route::prefix('admin')->group(function () {
    Route::get('/menu', [MenuController::class, 'index'])->name('admin.menu.index');
    Route::get('/menu/create', [MenuController::class, 'create'])->name('admin.menu.create');
    Route::post('/menu', [MenuController::class, 'store'])->name('admin.menu.store');
    
    // 🛠️ ย้ายกลุ่มที่มีเงื่อนไข {id} มาไว้ด้านล่างสุดทั้งหมด เพื่อไม่ให้เบียดบังเส้นทางหลักด้านบน
    Route::get('/menu/{id}', [MenuController::class, 'show'])->name('admin.menu.show');
    Route::get('/menu/{id}/edit', [MenuController::class, 'edit'])->name('admin.menu.edit');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('admin.menu.update');
    Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('admin.menu.destroy');
});