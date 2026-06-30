<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
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
        $pendingOrders = Order::where('status', 'pending')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        $totalCategories = Category::count();

        // Extra Sales Metrics
        $totalProductSale = OrderItem::whereHas('order', function($q) {
            $q->whereNotIn('status', ['cancelled', 'refunded']);
        })->sum('quantity');

        $thisMonthSale = OrderItem::whereHas('order', function($q) {
            $q->whereNotIn('status', ['cancelled', 'refunded'])
              ->whereMonth('created_at', now()->month)
              ->whereYear('created_at', now()->year);
        })->sum('quantity');

        $thisYearProductSale = OrderItem::whereHas('order', function($q) {
            $q->whereNotIn('status', ['cancelled', 'refunded'])
              ->whereYear('created_at', now()->year);
        })->sum('quantity');

        $todayPendingEarning = Order::where('status', 'pending')
            ->whereDate('created_at', now()->today())
            ->sum('total');

        $thisMonthEarning = Order::whereNotIn('status', ['cancelled', 'refunded'])
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total');

        $thisYearEarning = Order::whereNotIn('status', ['cancelled', 'refunded'])
            ->whereYear('created_at', now()->year)
            ->sum('total');

        // Chart Data (Monthly Orders, Customer & Vendor Registrations, Product Additions)
        $monthlyOrders = [];
        $monthlyUsers = [];
        $monthlyProducts = [];
        $monthlyVendors = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyOrders[] = Order::whereMonth('created_at', $m)->whereYear('created_at', now()->year)->count();
            $monthlyUsers[] = User::where('role', 'customer')->whereMonth('created_at', $m)->whereYear('created_at', now()->year)->count();
            $monthlyProducts[] = Product::whereMonth('created_at', $m)->whereYear('created_at', now()->year)->count();
            $monthlyVendors[] = User::where('role', 'vendor')->whereMonth('created_at', $m)->whereYear('created_at', now()->year)->count();
        }

        $recentOrders = Order::with('user', 'items')->latest()->limit(5)->get();
        $recentVendors = Store::with('user')->latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalVendors', 'pendingVendors',
            'totalProducts', 'totalOrders', 'totalRevenue',
            'pendingOrders', 'deliveredOrders', 'cancelledOrders',
            'totalCategories', 'totalProductSale', 'thisMonthSale',
            'thisYearProductSale', 'todayPendingEarning', 'thisMonthEarning',
            'thisYearEarning', 'monthlyOrders', 'monthlyUsers', 'monthlyProducts', 'monthlyVendors',
            'recentOrders', 'recentVendors'
        ));
    }
}
