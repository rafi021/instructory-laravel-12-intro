<?php

use Illuminate\Support\Facades\Route;

use App\CategroyEnum;

Route::get('/', function () {

    $data = [
        'name' => 'VendyBazzar',
        'address' => 'Dhaka',
        'phone' => '123123123'
    ];

    /*Create a associative array of products */
    $products = [
        [
            "id" => 91,
            "title" => "Efficient 2-Slice Toaster",
            "slug" => "efficient-2-slice-toaster",
            "price" => 48,
            "description" => "Enhance your morning routine with our sleek 2-slice toaster, featuring adjustable browning controls and a removable crumb tray for easy cleaning. This compact and stylish appliance is perfect for any kitchen, ensuring your toast is always golden brown and delicious.",
            "category" => [
                "id" => 18,
                "name" => "Electronics",
                "slug" => "electronics",
                "image" => "https://i.imgur.com/ZANVnHE.jpeg",
                "creationAt" => "2025-07-19T09:03:44.000Z",
                "updatedAt" => "2025-07-19T09:03:44.000Z"
            ],
            "images" => [
                "https://i.imgur.com/keVCVIa.jpeg",
                "https://i.imgur.com/afHY7v2.jpeg",
                "https://i.imgur.com/yAOihUe.jpeg"
            ],
            "creationAt" => "2025-07-19T09:03:49.000Z",
            "updatedAt" => "2025-07-19T09:03:49.000Z"
        ],
        [
            "id" => 92,
            "title" => "Sleek Comfort-Fit Over-Ear Headphones",
            "slug" => "sleek-comfort-fit-over-ear-headphones",
            "price" => 28,
            "description" => "Experience superior sound quality with our Sleek Comfort-Fit Over-Ear Headphones, designed for prolonged use with cushioned ear cups and an adjustable, padded headband. Ideal for immersive listening, whether you're at home, in the office, or on the move. Their durable construction and timeless design provide both aesthetically pleasing looks and long-lasting performance.",
            "category" => [
                "id" => 18,
                "name" => "Electronics",
                "slug" => "electronics",
                "image" => "https://i.imgur.com/ZANVnHE.jpeg",
                "creationAt" => "2025-07-19T09:03:44.000Z",
                "updatedAt" => "2025-07-19T09:03:44.000Z"
            ],
            "images" => [
                "https://i.imgur.com/SolkFEB.jpeg",
                "https://i.imgur.com/KIGW49u.jpeg",
                "https://i.imgur.com/mWwek7p.jpeg"
            ],
            "creationAt" => "2025-07-19T09:03:49.000Z",
            "updatedAt" => "2025-07-19T09:03:49.000Z"
        ],
        [
            "id" => 93,
            "title" => "Sleek Wireless Computer Mouse",
            "slug" => "sleek-wireless-computer-mouse",
            "price" => 100,
            "description" => "Experience smooth and precise navigation with this modern wireless mouse, featuring a glossy finish and a comfortable ergonomic design. Its responsive tracking and easy-to-use interface make it the perfect accessory for any desktop or laptop setup. The stylish blue hue adds a splash of color to your workspace, while its compact size ensures it fits neatly in your bag for on-the-go productivity.",
            "category" => [
                "id" => 18,
                "name" => "Electronics",
                "slug" => "electronics",
                "image" => "https://i.imgur.com/ZANVnHE.jpeg",
                "creationAt" => "2025-07-19T09:03:44.000Z",
                "updatedAt" => "2025-07-19T09:03:44.000Z"
            ],
            "images" => [
                "https://i.imgur.com/w3Y8NwQ.jpeg"
            ],
            "creationAt" => "2025-07-19T09:03:49.000Z",
            "updatedAt" => "2025-07-19T09:16:06.000Z"
        ]
    ];




    return view('home', compact('data', 'products'));
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
