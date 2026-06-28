<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredProducts = Product::with(['store', 'category'])
            ->where('status', 'active')
            ->where('stock', '>', 0)
            ->latest()
            ->limit(8)
            ->get();

        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->withCount('products')
            ->orderBy('sort_order')
            ->limit(8)
            ->get();

        $featuredStores = Store::where('status', 'active')
            ->withCount('products')
            ->latest()
            ->limit(6)
            ->get();

        $sliders = \App\Models\Slider::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('customer.home', compact('featuredProducts', 'categories', 'featuredStores', 'sliders'));
    }

    public function store(Store $store): View
    {
        abort_if($store->status !== 'active', 404);

        $products = $store->products()
            ->where('status', 'active')
            ->with('category')
            ->latest()
            ->paginate(12);

        return view('customer.store', compact('store', 'products'));
    }
}
