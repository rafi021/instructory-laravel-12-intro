<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;


// Group
require __DIR__ . '/task.php';


Route::get('products', [ProductController::class, 'index'])->name('products.index');
