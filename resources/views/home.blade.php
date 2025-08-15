@extends('welcome')
@section('main-content')
    <br>
    <br>
    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            {{-- <h2 class="text-2xl font-bold tracking-tight text-gray-900">Customers also purchased</h2> --}}
            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @forelse ($categories as $key => $category)
                    <div class="group relative">
                        <h1 class="text-2xl underline">{{ $loop->index + 1 }}.{{ $category->name }} - Post Count:
                            <span>{{ $category->posts_count }}</span>
                        </h1>
                        <ul>
                            @foreach ($category->posts as $key => $post)
                                <li class="ps-3 text-xs">{{ $post->title }}</li>
                            @endforeach
                        </ul>

                        <br>
                    <div @empty <li class="ps-3">No post</li>
                @endforelse
            </div>
        </div>
    </div>
@endsection
