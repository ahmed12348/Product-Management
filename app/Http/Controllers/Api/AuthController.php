<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
         // Validate incoming request
         $credentials = $request->only('email', 'password');

         if (Auth::attempt($credentials)) {
             $user = Auth::user();
 
             // Generate an API token
             $token = $user->createToken('API Token')->plainTextToken;
 
             // Return success response with token
             return response()->json([
                 'message' => 'Login successful',
                 'token' => $token,
                 'user' => $user
             ], 200);
         } else {
             return response()->json(['message' => 'Unauthorized'], 401);
         }
    }
}
