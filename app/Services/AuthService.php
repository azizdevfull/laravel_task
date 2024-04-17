<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthService
{
    public function signUp($request)
    {
        $user = User::create($request->validated());

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->success($token, 'User logged in successfully', 201);
    }

    public function login($request)
    {
        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            $user = User::where('phone', $request->phone)->first();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->success($token, 'User logged in successfully');
        }
        return response()->error('Unauthenticated', 401);
    }
}
