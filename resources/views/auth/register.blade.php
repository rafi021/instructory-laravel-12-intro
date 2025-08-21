@extends('welcome')

@section('main-content')
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-50 to-blue-100">
        <div
            class="w-full max-w-xl bg-white rounded-2xl shadow-xl p-10 hover:transform hover:scale-110 transition duration-300">
            <h2 class="text-3xl font-extrabold mb-8 text-center text-gray-700 tracking-tight">Create Your Account</h2>
            <form method="POST" action="{{ route('register.store') }}" class="space-y-6">
                @csrf

                {{-- Name --}}
                <div>
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}"
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 bg-blue-50 @error('name') border-red-500 @enderror"
                        placeholder="Your full name">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 bg-blue-50 @error('email') border-red-500 @enderror"
                        placeholder="you@email.com">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                {{-- Phone --}}
                <div>
                    <label for="phone" class="block text-gray-700 font-semibold mb-2">Phone</label>
                    <input id="phone" name="phone" type="tel" value="{{ old('phone') }}"
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 bg-blue-50 @error('phone') border-red-500 @enderror"
                        placeholder="01923871623">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input id="password" name="password" type="password"
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 bg-blue-50 @error('password') border-red-500 @enderror"
                        placeholder="********">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 shadow-md">
                    Register
                </button>
            </form>
            <div class="mt-6 text-center text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-teal-600 hover:underline font-semibold">Login</a>
            </div>
        </div>
    </div>
@endsection
