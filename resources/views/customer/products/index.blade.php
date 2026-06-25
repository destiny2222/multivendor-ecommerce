@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-8">

        {{-- Filters Sidebar --}}
        <aside class="w-full lg:w-56 flex-shrink-0">
            <div class="bg-white rounded-xl border border-gray-200 p-5 sticky top-20">
                <h3 class="font-semibold text-gray-800 mb-4">Filters</h3>
                <form action="{{ route('products.index') }}" method="GET" id="filterForm">
                    @if(request('q'))
                        <input type="hidden" name="q" value="{{ request('q') }}">
                    @endif

                    <div class="mb-5">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Category</label>
                        <div class="space-y-1.5">
                            <label class="flex items-center gap-2 cursor-pointer text-sm">
                                <input type="radio" name="category" value="" {{ !request('category') ? 'checked' : '' }}
                                    class="text-indigo-600" onchange="this.form.submit()">
                                <span>All Categories</span>
                            </label>
                            @foreach($categories as $cat)
                                <label class="flex items-center gap-2 cursor-pointer text-sm">
                                    <input type="radio" name="category" value="{{ $cat->slug }}"
                                        {{ request('category') === $cat->slug ? 'checked' : '' }}
                                        class="text-indigo-600" onchange="this.form.submit()">
                                    <span>{{ $cat->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Price Range</label>
                        <div class="flex gap-2">
                            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min"
                                class="w-full border border-gray-300 rounded-lg px-2 py-1.5 text-sm">
                            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max"
                                class="w-full border border-gray-300 rounded-lg px-2 py-1.5 text-sm">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 text-white text-sm py-2 rounded-lg hover:bg-indigo-700">
                        Apply Filters
                    </button>
                    @if(request()->hasAny(['category', 'min_price', 'max_price', 'q']))
                        <a href="{{ route('products.index') }}" class="block text-center text-xs text-gray-500 mt-2 hover:text-indigo-600">Clear all</a>
                    @endif
                </form>
            </div>
        </aside>

        {{-- Product grid --}}
        <div class="flex-1">
            <div class="flex items-center justify-between mb-5">
                <p class="text-sm text-gray-600">
                    @if(request('q'))
                        Results for "<strong>{{ request('q') }}</strong>" &mdash;
                    @endif
                    {{ $products->total() }} products
                </p>
                <select name="sort" onchange="window.location='{{ route('products.index') }}?'+new URLSearchParams({...Object.fromEntries(new URLSearchParams(window.location.search)),...{sort:this.value}}).toString()"
                    class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm">
                    <option value="newest" {{ request('sort','newest')==='newest' ? 'selected' : '' }}>Newest</option>
                    <option value="price_asc" {{ request('sort')==='price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_desc" {{ request('sort')==='price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </div>

            @if($products->isEmpty())
                <div class="text-center py-16 text-gray-400">
                    <div class="text-5xl mb-3">📦</div>
                    <p class="font-medium">No products found</p>
                    <p class="text-sm mt-1">Try adjusting your filters</p>
                </div>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach($products as $product)
                        @include('components.product-card', ['product' => $product])
                    @endforeach
                </div>
                <div class="mt-8">{{ $products->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
