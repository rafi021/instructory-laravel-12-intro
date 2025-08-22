<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest('id')->paginate(10); // Assuming Product model exists
        return view('pages.products.index', compact('products'));
    }
}
