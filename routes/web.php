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

    $products = [
        [
            'title' => 'Laptop',
            'category' => [
                'name' => 'Electronics',
            ],
            'price' => 1200,
            'description' => 'A high-performance laptop for professionals.',
            'images' => ['https://example.com/laptop.jpg']
        ],
        [
            'title' => 'Smartphone',
            'category' => [
                'name' => 'Electronics',
            ],
            'price' => 800,
            'description' => 'A latest model smartphone with advanced features.',
            'images' => ['https://example.com/laptop.jpg']
        ],
        [
            'title' => 'Headphones',
            'category' => [
                'name' => 'Electronics',
            ],
            'price' => 150,
            'description' => 'Noise-cancelling headphones for an immersive experience.',
            'images' => ['https://example.com/laptop.jpg']
        ]
    ];

    // return $data;
    // return response($data)
    //     ->header('Content-Type', 'application/json')
    //     ->header('shop_id', 812312)
    //     ->header('shop_name', 'Mahmud Ibrahim')
    //     ->cookie('MyIDCard', '123343453465465', 3600);
    $isMissing = true;
    if (!$isMissing) {
        return view('home', compact('data', 'products'));
    } else {
        return redirect()->route('about');
    }
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


Route::get('download', function () {
    return response()->download(public_path('laravel_book.pdf'), 'Laravel New Book.pdf', [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="Laravel New Book.pdf"'
    ])->setStatusCode(200, 'Download Successful');
});
