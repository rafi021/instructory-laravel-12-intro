<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/about-us-opurseldasdasda', function () {
    return view('about');
})->name('about');
Route::get('/contact-us', function () {
    return view('contact');
})->name('contact');
Route::get('/services', function () {
    return view('service');
})->name('service');
