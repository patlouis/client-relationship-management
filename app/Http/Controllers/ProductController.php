<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
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
}
