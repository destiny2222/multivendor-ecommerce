<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalUsers = User::where('role', 'customer')->count();
        $totalVendors = User::where('role', 'vendor')->count();
        $pendingVendors = Store::where('status', 'pending')->count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::whereNotIn('status', ['cancelled', 'refunded'])->sum('total');

        $recentOrders = Order::with('user', 'items')->latest()->limit(5)->get();
        $recentVendors = Store::with('user')->latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalVendors', 'pendingVendors',
            'totalProducts', 'totalOrders', 'totalRevenue',
            'recentOrders', 'recentVendors'
        ));
    }
}
