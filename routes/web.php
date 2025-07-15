<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/* 1. Create route defination
2. Create a view file
*/
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact-us', function () {
    return view('contact');
});
Route::get('/services', function () {
    return view('service');
});
