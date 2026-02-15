<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // 1. Import Category Model
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        // 2. Eager load 'category' to avoid N+1 queries
        $products = Product::with('category')->latest()->paginate(10);

        return Inertia::render('products/Index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        return Inertia::render('products/Create', [
            // 3. Pass categories for the dropdown
            'categories' => Category::all(['id', 'name']),
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return Inertia::render('products/Edit', [
            'product' => $product,
            // 4. Pass categories here too
            'categories' => Category::all(['id', 'name']),
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
