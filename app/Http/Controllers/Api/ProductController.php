<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //      $this->middleware('auth:sanctum'); 
    // }

    public function index()
    {
        // Ensure the user is authenticated
        if (auth()->check()) {
            // Return the products for the authenticated user
            return Product::all();
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
