@extends('welcome')
@section('main-content')
    <div class="container mx-auto max-w-2xl py-12 px-4">
        <div class="bg-white shadow-xl rounded-2xl p-8">
            <h1 class="text-3xl font-extrabold text-indigo-700 mb-8 flex items-center gap-2">
                <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Create New Task
            </h1>
            <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-900 mb-1">Task Name</label>
                    <input id="name" type="text" name="name" placeholder="Enter task name"
                        class="w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 py-2 px-3 text-base text-gray-900 placeholder-gray-400 @error('name') border-red-500 ring-red-100 @enderror"
                        value="{{ old('name') }}" />
                    @error('name')
                        <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="date" class="block text-sm font-medium text-gray-900 mb-1">Task Date</label>
                    <input id="date" type="date" name="date"
                        class="w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 py-2 px-3 text-base text-gray-900 placeholder-gray-400 @error('date') border-red-500 ring-red-100 @enderror"
                        value="{{ old('date') }}" />
                    @error('date')
                        <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-900 mb-1">Task Image</label>
                    <input id="image" type="file" name="image"
                        class="dropify w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 py-2 px-3 text-base text-gray-900 placeholder-gray-400 @error('image') border-red-500 ring-red-100 @enderror" />
                    @error('image')
                        <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-end gap-x-4 mt-8">
                    <a href="{{ route('tasks.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg shadow transition">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Save Task
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
