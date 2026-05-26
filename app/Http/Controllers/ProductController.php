<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->when($request->filled('q'), function ($query) use ($request) {
                $keyword = '%' . $request->query('q') . '%';

                $query->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', $keyword)
                        ->orWhere('author', 'like', $keyword);
                });
            })
            ->latest()
            ->get();

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        abort_unless($product->is_active && $product->stock > 0, 404);

        return view('products.show', compact('product'));
    }
}

