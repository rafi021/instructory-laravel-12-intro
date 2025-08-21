<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;


// Group


// Route::get('register', [RegisterController::class, 'create'])->name('register.form');
// Route::post('register', [RegisterController::class, 'store'])->name('register.store');
// Route::get('login', [LoginController::class, 'create'])->name('login');
// Route::post('login', [LoginController::class, 'store'])->name('login.store');
// Route::middleware(['auth'])->group(function () {
//     Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
//     require __DIR__ . '/task.php';
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
