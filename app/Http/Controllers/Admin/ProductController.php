<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        return view('admin.products.form', ['product' => null]);
    }

    public function store(Request $request)
    {
        Product::create($this->validatedProductData($request));

        return redirect()->route('admin.dashboard')->with('success', 'Urun kaydedildi.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $product->update($this->validatedProductData($request, $product));

        return redirect()->route('admin.dashboard')->with('success', 'Urun kaydedildi.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Urun silindi.');
    }

    private function validatedProductData(Request $request, ?Product $product = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'author' => ['required', 'string', 'max:140'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image_url' => ['nullable', 'string', 'max:500'],
            'image_file' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $fileName = uniqid('book_', true) . '.' . strtolower($file->getClientOriginalExtension() ?: 'jpg');
            $file->move(public_path('uploads'), $fileName);
            $data['image_url'] = 'uploads/' . $fileName;
        } elseif (empty($data['image_url']) && $product) {
            $data['image_url'] = $product->image_url;
        } elseif (empty($data['image_url'])) {
            $data['image_url'] = 'https://picsum.photos/seed/book/600/800';
        }

        $data['is_active'] = $request->boolean('is_active');
        unset($data['image_file']);

        return $data;
    }
}

