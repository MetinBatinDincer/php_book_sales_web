<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'products' => Product::latest()->get(),
            'orders' => Order::with('user')->latest()->get(),
            'users' => User::orderBy('role')->orderBy('name')->get(),
        ]);
    }
}

