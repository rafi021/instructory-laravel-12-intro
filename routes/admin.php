<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserInfoController;

Route::prefix('')->group(function () {
    Route::get('/', [FrontendController::class, 'home'])->name('home');
    Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
    Route::get('/about', [FrontendController::class, 'about'])->name('about');
    Route::get('/service', [FrontendController::class, 'service'])->name('service');
    Route::get('/transaction', [FrontendController::class, 'transaction'])->name('service');
    Route::get('/user-info', UserInfoController::class);
});
