<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt(['name' => $request->name, 'password' => $request->password])) {
            $token = auth()->user()->createToken('pre-order')->accessToken;

            return response()->json([
                'user' => auth()->user(),
                'token' => $token,
                'message' => 'Successful auth',
            ]);
        }

        return response()->json(['message'  => 'Invalid password or username'], 401);
    }
}
