<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        // ds($request->all());
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Alert::success('Login Successful', 'You have successfully logged in.');
            return redirect()->route('tasks.index');
        } else {
            Alert::error('Login Failed', 'Invalid credentials. Please try again.');
            return redirect()->back()->withInput($request->only('email'));
        }
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Alert::success('Logout Successful', 'You have successfully logged out.');
        return redirect()->route('login');
    }
}
