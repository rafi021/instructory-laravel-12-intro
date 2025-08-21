<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegisterRequest;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        ds($request->all());
        // 1. User Create
        $user = User::create([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'phone' => $request->validated('phone'),
            'password' => Hash::make($request->validated('password')),
        ]);

        ds($user);

        // 2. Then login the user
        Auth::login($user);
        // 3. redirect
        Alert::success('Registration Successful', 'You have successfully registered and logged in.');
        return redirect()->route('tasks.index');
    }
}
