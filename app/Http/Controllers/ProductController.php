<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);

        return Inertia::render('products/Index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        return Inertia::render('products/Create', []);
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return Inertia::render('products/Edit', [
            'product' => $product,
        ]);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
}
