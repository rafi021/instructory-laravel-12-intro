<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        // ds($request->validated());
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $token  = Auth::user()->createToken('api');
            return response()->json([
                'message' => 'Login successful',
                'token' => $token->plainTextToken
            ]);
        }
        return response()->json(['message' => 'Invalid credentials'], 401);
    }


    public function adminStore(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            redirect()->route('admin.dashboard');
        }
    }
}
