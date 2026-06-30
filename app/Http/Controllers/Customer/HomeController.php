<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Banner;
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

        $dealProducts = Product::with(['store', 'category'])
            ->where('status', 'active')
            ->where('stock', '>', 0)
            ->whereNotNull('compare_price')
            ->whereColumn('compare_price', '>', 'price')
            ->latest()
            ->limit(10)
            ->get();

        if ($dealProducts->isEmpty()) {
            $dealProducts = Product::with(['store', 'category'])
                ->where('status', 'active')
                ->where('stock', '>', 0)
                ->latest()
                ->limit(10)
                ->get();
        }

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

        $banners = Banner::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $topRatedProducts = Product::with(['store', 'category'])
            ->where('status', 'active')
            ->where('stock', '>', 0)
            ->withAvg(['reviews' => function ($query) {
                $query->where('is_approved', true);
            }], 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->latest()
            ->limit(10)
            ->get();

        $electronicsCategory = Category::where('slug', 'electronics')->first();
        if ($electronicsCategory) {
            $electronicsNew = $electronicsCategory->products()->with(['store', 'category'])->where('status', 'active')->where('stock', '>', 0)->latest()->limit(7)->get();
            $electronicsBest = $electronicsCategory->products()->with(['store', 'category'])->where('status', 'active')->where('stock', '>', 0)->withCount('orderItems')->orderByDesc('order_items_count')->latest()->limit(7)->get();
            $electronicsPopular = $electronicsCategory->products()->with(['store', 'category'])->where('status', 'active')->where('stock', '>', 0)->withAvg(['reviews' => function($q) { $q->where('is_approved', true); }], 'rating')->orderByDesc('reviews_avg_rating')->latest()->limit(7)->get();
        } else {
            $electronicsNew = Product::with(['store', 'category'])->where('status', 'active')->where('stock', '>', 0)->latest()->limit(7)->get();
            $electronicsBest = Product::with(['store', 'category'])->where('status', 'active')->where('stock', '>', 0)->withCount('orderItems')->orderByDesc('order_items_count')->latest()->limit(7)->get();
            $electronicsPopular = Product::with(['store', 'category'])->where('status', 'active')->where('stock', '>', 0)->withAvg(['reviews' => function($q) { $q->where('is_approved', true); }], 'rating')->orderByDesc('reviews_avg_rating')->latest()->limit(7)->get();
        }

        return view('customer.home', compact(
            'featuredProducts', 'dealProducts', 'categories', 
            'featuredStores', 'sliders', 'banners', 'topRatedProducts',
            'electronicsCategory', 'electronicsNew', 'electronicsBest', 'electronicsPopular'
        ));
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
