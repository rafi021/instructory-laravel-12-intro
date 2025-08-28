<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;


// Group
require __DIR__ . '/task.php';


Route::get('products', [ProductController::class, 'index'])
    ->name('products.index');

Route::post('order-place', [OrderController::class, 'orderStore'])
    ->name('order.store');

Route::get('notifications/mark-as-read', [OrderController::class, 'markAsRead'])->name('notifications.markAllRead');
