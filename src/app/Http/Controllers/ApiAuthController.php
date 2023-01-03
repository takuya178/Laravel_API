<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoginResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = User::where('email', $request->email)->first();
            $user->tokens()->delete();
            $token = $user->createToken('token')->plainTextToken;
            return new LoginResource([
                'token' => $token,
                'user' => $user
            ]);
        } else {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }
    }

    public function register(Request $request)
    {
        
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->noContent();
    }
}
