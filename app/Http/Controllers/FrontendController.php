<?php

namespace App\Http\Controllers;

use App\Billing\PaymentGateway;
use App\Facades\Math;
use App\Models\Category;
use App\Models\Post;
use App\Models\Teacher;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function home()
    {
        $categories = Category::with(['posts:id,category_id,title'])
            ->withCount('posts')
            ->get();

        $teacher = Teacher::first();
        dd($teacher->parents()->get());

        // return $categories;
        return view('home', compact('categories'));
    }
    public function about(Request $request)
    {
        dd($request);
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


    public function transaction()
    {
        return Math::add(5, 10);
    }
}
