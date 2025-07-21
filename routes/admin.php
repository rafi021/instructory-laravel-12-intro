<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');
    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');
    Route::get('/about', function () {
        return view('about');
    })->name('about');
});
