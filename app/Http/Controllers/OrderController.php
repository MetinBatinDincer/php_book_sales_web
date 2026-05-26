<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkoutForm(Request $request)
    {
        $cart = session('cart', []);

        if (! $cart) {
            return redirect()->route('cart.index')->with('warning', 'Sepetiniz bos.');
        }

        return view('cart.checkout', [
            'cart' => $cart,
            'user' => $request->user(),
        ]);
    }

    public function checkout(Request $request)
    {
        $data = $request->validate([
            'shipping_address' => ['required', 'string'],
            'card_number' => ['required', 'string'],
            'cvv' => ['required', 'string'],
        ]);

        $cart = session('cart', []);

        if (! $cart) {
            return redirect()->route('cart.index')->with('warning', 'Sepetiniz bos.');
        }

        DB::transaction(function () use ($request, $cart, $data) {
            $user = User::whereKey($request->user()->id)->lockForUpdate()->firstOrFail();
            $preparedItems = [];
            $total = 0;

            foreach ($cart as $item) {
                $product = Product::whereKey($item['id'])->lockForUpdate()->firstOrFail();
                $quantity = (int) $item['quantity'];

                if (! $product->is_active || $product->stock < $quantity) {
                    abort(422, $product->title . ' icin yeterli stok yok.');
                }

                $lineTotal = (float) $product->price * $quantity;
                $total += $lineTotal;

                $preparedItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'unit_price' => (float) $product->price,
                ];
            }

            $walletUsed = min((float) $user->wallet_balance, $total);
            $cardPaid = $total - $walletUsed;

            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $total,
                'wallet_used' => $walletUsed,
                'card_paid' => $cardPaid,
                'shipping_address' => $data['shipping_address'],
                'status' => 'pending',
            ]);

            foreach ($preparedItems as $preparedItem) {
                $product = $preparedItem['product'];

                $order->items()->create([
                    'product_id' => $product->id,
                    'product_title' => $product->title,
                    'quantity' => $preparedItem['quantity'],
                    'unit_price' => $preparedItem['unit_price'],
                ]);

                $product->decrement('stock', $preparedItem['quantity']);
            }

            if ($walletUsed > 0) {
                $user->decrement('wallet_balance', $walletUsed);
            }
        });

        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Siparisiniz alindi.');
    }

    public function index(Request $request)
    {
        $orders = $request->user()
            ->orders()
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Request $request, Order $order)
    {
        abort_unless($request->user()->isAdmin() || $order->user_id === $request->user()->id, 403);

        return view('orders.show', [
            'order' => $order->load('items'),
        ]);
    }

    public function cancel(Request $request, Order $order)
    {
        abort_unless($order->user_id === $request->user()->id, 403);

        if (! $order->canBeCancelledByUser()) {
            return back()->with('danger', 'Bu siparis iptal edilemez.');
        }

        DB::transaction(function () use ($order) {
            $lockedOrder = Order::with('items')
                ->whereKey($order->id)
                ->lockForUpdate()
                ->firstOrFail();

            if (! $lockedOrder->canBeCancelledByUser()) {
                abort(422, 'Bu siparis iptal edilemez.');
            }

            $lockedOrder->update(['status' => 'cancelled']);
            User::whereKey($lockedOrder->user_id)->increment('wallet_balance', $lockedOrder->total_amount);

            foreach ($lockedOrder->items as $item) {
                if ($item->product_id) {
                    Product::whereKey($item->product_id)->increment('stock', $item->quantity);
                }
            }
        });

        return redirect()->route('orders.index')->with('success', 'Siparis iptal edildi ve tutar site bakiyenize aktarildi.');
    }

    public function confirmDelivery(Request $request, Order $order)
    {
        abort_unless($order->user_id === $request->user()->id, 403);

        if ($order->canBeConfirmedByUser()) {
            $order->update(['status' => 'completed']);

            return redirect()->route('orders.index')->with('success', 'Teslim alma onaylandi.');
        }

        return redirect()->route('orders.index');
    }
}

