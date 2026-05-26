<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index', ['cart' => session('cart', [])]);
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $product = Product::findOrFail($data['product_id']);
        $quantity = (int) $data['quantity'];

        if (! $product->is_active || $product->stock < $quantity) {
            return back()->with('danger', 'Urun stokta yok.');
        }

        $cart = session('cart', []);
        $currentQuantity = (int) ($cart[$product->id]['quantity'] ?? 0);

        if ($product->stock < $currentQuantity + $quantity) {
            return back()->with('danger', 'Sepetteki adet stok miktarini asiyor.');
        }

        $cart[$product->id] = [
            'id' => $product->id,
            'title' => $product->title,
            'price' => (float) $product->price,
            'quantity' => $currentQuantity + $quantity,
        ];

        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Urun sepete eklendi.');
    }

    public function remove(int $productId)
    {
        $cart = session('cart', []);
        unset($cart[$productId]);
        session(['cart' => $cart]);

        return redirect()->route('cart.index');
    }
}

