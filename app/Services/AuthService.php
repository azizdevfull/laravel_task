<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthService
{
    public function signUp($request)
    {
        User::create($request->validated());

        return response()->success(null, 'User registered successfully', 201);
    }

    public function login($request)
    {
        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            $user = User::where('phone', $request->phone)->first();
            $user->last_login_at = now();
            $user->update();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->success($token, 'User logged in successfully');
        }
        return response()->error('Unauthenticated', 401);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->success(null, 'User logged out successfully');
    }
}
