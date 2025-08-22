<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;


// Group
require __DIR__ . '/task.php';


Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware('guest:admin')->group(function () {
    Route::get('/admin/login', [LoginController::class, 'adminLoginForm'])->name('admin.login');
    Route::post('/admin/login', [LoginController::class, 'adminStore'])->name('admin.login.store');
});


Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [LoginController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [LoginController::class, 'adminLogout'])->name('admin.logout');
});
