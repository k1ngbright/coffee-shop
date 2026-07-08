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

// Menu routes (แก้ไข: เพิ่มเส้นทางสำหรับการ ดู, แก้ไข และอัปเดตเมนูให้ครบถ้วน)
Route::prefix('admin')->group(function () {
    Route::get('/menu', [MenuController::class, 'index'])->name('admin.menu.index');
    Route::get('/menu/create', [MenuController::class, 'create'])->name('admin.menu.create');
    Route::post('/menu', [MenuController::class, 'store'])->name('admin.menu.store');
    
    // 🛠️ 3 เส้นทางที่เพิ่มเข้ามาใหม่เพื่อขจัดบั๊กหน้า Edit พังครับ
    Route::get('/menu/{id}', [MenuController::class, 'show'])->name('admin.menu.show');
    Route::get('/menu/{id}/edit', [MenuController::class, 'edit'])->name('admin.menu.edit');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('admin.menu.update');
    
    Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('admin.menu.destroy');
});