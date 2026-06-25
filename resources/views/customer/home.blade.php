@extends('layouts.app')

@section('title', 'Home — MarketPlace')

@section('content')
{{-- Hero --}}
<section class="bg-gradient-to-br from-indigo-600 to-purple-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Shop from the Best Vendors</h1>
        <p class="text-indigo-100 text-lg mb-8">Thousands of products from verified sellers, delivered to your door.</p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center max-w-xl mx-auto">
            <form action="{{ route('products.index') }}" method="GET" class="flex-1 flex gap-2">
                <input type="text" name="q" placeholder="Search products..."
                    class="flex-1 px-4 py-3 rounded-lg text-gray-900 text-sm focus:outline-none">
                <button type="submit" class="bg-white text-indigo-600 font-semibold px-6 py-3 rounded-lg hover:bg-indigo-50 transition-colors">
                    Search
                </button>
            </form>
        </div>
    </div>
</section>

{{-- Categories --}}
@if($categories->isNotEmpty())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h2 class="text-2xl font-bold mb-6">Shop by Category</h2>
    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-4">
        @foreach($categories as $category)
            <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                class="group bg-white rounded-xl border border-gray-200 p-4 text-center hover:border-indigo-400 hover:shadow-sm transition-all">
                <div class="w-12 h-12 bg-indigo-100 rounded-full mx-auto mb-2 flex items-center justify-center">
                    <span class="text-indigo-600 text-xl">📦</span>
                </div>
                <p class="text-xs font-medium text-gray-700 group-hover:text-indigo-600 leading-tight">{{ $category->name }}</p>
                <p class="text-xs text-gray-400 mt-0.5">{{ $category->products_count }} items</p>
            </a>
        @endforeach
    </div>
</section>
@endif

{{-- Featured Products --}}
@if($featuredProducts->isNotEmpty())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Featured Products</h2>
        <a href="{{ route('products.index') }}" class="text-sm text-indigo-600 hover:underline">View all →</a>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($featuredProducts as $product)
            @include('components.product-card', ['product' => $product])
        @endforeach
    </div>
</section>
@endif

{{-- Featured Stores --}}
@if($featuredStores->isNotEmpty())
<section class="bg-white border-t border-b border-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold mb-6">Top Stores</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach($featuredStores as $store)
                <a href="{{ route('stores.show', $store) }}"
                    class="group bg-gray-50 rounded-xl border border-gray-200 p-4 text-center hover:border-indigo-400 hover:shadow-sm transition-all">
                    <div class="w-12 h-12 bg-indigo-600 rounded-full mx-auto mb-2 flex items-center justify-center text-white font-bold text-lg">
                        {{ strtoupper(substr($store->name, 0, 1)) }}
                    </div>
                    <p class="text-xs font-semibold text-gray-800 group-hover:text-indigo-600 truncate">{{ $store->name }}</p>
                    <p class="text-xs text-gray-400">{{ $store->products_count }} products</p>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA for vendors --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
    <div class="bg-indigo-600 rounded-2xl p-12 text-white">
        <h2 class="text-3xl font-bold mb-3">Start Selling Today</h2>
        <p class="text-indigo-100 mb-6">Join thousands of vendors and reach millions of customers.</p>
        <a href="{{ route('register') }}" class="bg-white text-indigo-600 font-semibold px-8 py-3 rounded-lg hover:bg-indigo-50 transition-colors inline-block">
            Become a Vendor
        </a>
    </div>
</section>
@endsection
