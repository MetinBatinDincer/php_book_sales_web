<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function next(Order $order)
    {
        $flow = config('bookstore.admin_flow');
        $index = array_search($order->status, $flow, true);

        if ($index !== false && isset($flow[$index + 1])) {
            $order->update(['status' => $flow[$index + 1]]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Siparis sureci ilerletildi.');
    }
}

