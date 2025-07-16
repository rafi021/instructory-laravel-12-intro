<?php

use Illuminate\Support\Facades\Route;

use App\CategroyEnum;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('/', 'home')->name('home');

Route::get('/about-us-opurseldasdasda', function () {
    return view('about');
})->name('about');
Route::get('/contact-us', function () {
    return view('contact');
})->name('contact');

Route::get('/services', function () {
    return view('service');
})->name('service');


Route::get('/user/{id}/{name}', function (string $id, string $name) {
    return [
        'id' => $id,
        'name' => $name
    ];
})->where(['id' =>  '[0-9]+', 'name' => '[A-Za-z]+']);

Route::get('/category/{category}', function (string $category) {
    return $category;
})->whereIn('category', CategroyEnum::cases());
