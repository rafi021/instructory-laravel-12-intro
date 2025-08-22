<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

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
}
