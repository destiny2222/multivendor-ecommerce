<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $store = auth()->user()->store;

        if (! $store) {
            return view('vendor.setup');
        }

        $totalProducts = $store->products()->count();
        $activeProducts = $store->products()->where('status', 'active')->count();
        $totalOrders = OrderItem::where('store_id', $store->id)->count();
        $pendingOrders = OrderItem::where('store_id', $store->id)->where('status', 'pending')->count();
        $totalRevenue = OrderItem::where('store_id', $store->id)
            ->whereHas('order', fn ($q) => $q->whereNotIn('status', ['cancelled', 'refunded']))
            ->sum('subtotal');

        $recentOrders = OrderItem::where('store_id', $store->id)
            ->with('order.user', 'product')
            ->latest()
            ->limit(5)
            ->get();

        return view('vendor.dashboard', compact(
            'store', 'totalProducts', 'activeProducts',
            'totalOrders', 'pendingOrders', 'totalRevenue', 'recentOrders'
        ));
    }
}
