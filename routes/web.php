<?php

use Illuminate\Support\Facades\Route;

use App\CategroyEnum;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    // dd(
    //     $request,
    //     $request->path(),
    //     $request->is('/'),
    //     $request->fullUrl(),
    //     $request->host(),
    //     $request->ip(),
    //     $request->httpHost(),
    //     $request->schemeAndHttpHost(),


    //     $request->header('User-Agent'),
    //     $request->routeIs('home'),
    //     $request->header('X-Header_name', 'default_value'),
    //     $request->bearerToken(), //----> API building
    // );

    $data = [
        "Name" => "Mahmud Ibrahim",
        "Age" => 37,
    ];

    // return $data;
    return response($data)
        ->header('Content-Type', 'application/json')
        ->header('shop_id', 812312)
        ->header('shop_name', 'Mahmud Ibrahim')
        ->cookie('MyIDCard', '123343453465465', 3600);



    return view('home', compact('data', 'products'));
})->name('home');













Route::get('/about-us', function () {
    return view('about');
})->name('about');
Route::get('/contact-us', function () {
    return view('contact');
})->name('contact');

Route::get('/services', function (Request $request) {


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
