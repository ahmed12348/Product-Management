<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10); // Paginate the product list
        return view('dashboard.products.index', compact('products'));
    }

    // Show the form for creating a new product.
    public function create()
    {
        return view('dashboard.products.create');
    }

    // Store a newly created product in the database.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);
    
        // Store product
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);
    
        // Redirect or return response
        return redirect()->route('dashboard.products.index')->with('success', 'Product created successfully!');
    
    }

    // Display the specified product.
    public function show(Product $product)
    {
        return view('dashboard.products.show', compact('product'));
    }

    // Show the form for editing the specified product.
    public function edit(Product $product)
    {
        return view('dashboard.products.edit', compact('product'));
    }

    // Update the specified product in the database.
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $product->update($request->all());

        return redirect()->route('dashboard.products.index')->with('success', 'Product updated successfully.');
    }

    // Remove the specified product from the database.
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('dashboard.products.index')->with('success', 'Product deleted successfully.');
    }
}
