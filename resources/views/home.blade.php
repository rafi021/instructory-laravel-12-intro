@extends('welcome')
@section('main-content')
    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Customers also purchased</h2>
            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @forelse ($products as $key => $product)
                    <x-product-card :product="$product" class="group relative" />
                @empty
                    <li class="ps-3">No Products</li>
                @endforelse
            </div>
        </div>
    </div>
@endsection
