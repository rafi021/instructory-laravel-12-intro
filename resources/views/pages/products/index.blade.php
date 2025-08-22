@extends('welcome')
@section('main-content')
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-8 text-center">Our Products</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($products as $product)
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 flex flex-col">
                        <div class="aspect-w-4 aspect-h-3">
                            <img src="https://prd.place/400?id={{ $loop->index + 1 }}" alt="{{ $product['name'] }}"
                                class="object-cover rounded-t-2xl w-full h-48">
                        </div>
                        <div class="p-5 flex-1 flex flex-col">
                            <h2 class="text-lg font-semibold text-gray-900 mb-2 truncate">{{ $product['name'] }}</h2>
                            <div class="text-teal-600 font-bold text-xl mb-4">${{ number_format($product['price'], 2) }}
                            </div>
                            <div class="mt-auto">
                                <a href="#"
                                    class="inline-block w-full text-center bg-teal-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                                    Buy Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
