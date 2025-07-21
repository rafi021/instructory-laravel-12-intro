<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $products = [];
        return view('home', compact('products'));
    }
    public function about()
    {
        return view('about');
    }
    public function contact()
    {
        return view('contact');
    }
    public function service()
    {
        $isServices = true;
        $services = [
            'Web Development',
            'Mobile App Development',
            'SEO Services',
            'Digital Marketing',
        ];
        return view('service', compact('isServices', 'services'));
    }
}
