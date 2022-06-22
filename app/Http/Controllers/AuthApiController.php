<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthApiController
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
            return response()->json(['success' => false, 'message' => 'Username or password is incorrect!']);
        $user = Auth::user();
        $accessToken = $user->createToken('access_token')->plainTextToken;
        return response()->json(['success' => true, 'access_token' => $accessToken]);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout successfully!']);
    }

    public function user(Request $request)
    {
        return $request->user();
    }
}
