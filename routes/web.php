<?php

use Illuminate\Support\Facades\Route;

use App\CategroyEnum;

Route::get('/', function () {

    $data = [
        'name' => 'VendyBazzar',
        'address' => 'Dhaka',
        'phone' => '123123123'
    ];
    return view('home', compact('data'));
})->name('home');


Route::get('/about-us', function () {
    return view('about');
})->name('about');
Route::get('/contact-us', function () {
    return view('contact');
})->name('contact');

Route::get('/services', function () {

    $services = [
        'web development',
        'mobile development',
        'digital marketing',
        'ui-ux design'
    ];

    $isServices = false;


    


    return view('service', compact('services', 'isServices'));
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
