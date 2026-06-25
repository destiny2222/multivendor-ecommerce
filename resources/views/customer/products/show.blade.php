@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <nav class="text-sm text-gray-500 mb-6 flex items-center gap-2">
        <a href="{{ route('home') }}" class="hover:text-indigo-600">Home</a>
        <span>/</span>
        <a href="{{ route('products.index') }}" class="hover:text-indigo-600">Products</a>
        @if($product->category)
            <span>/</span>
            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-indigo-600">{{ $product->category->name }}</a>
        @endif
        <span>/</span>
        <span class="text-gray-800">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-12">
        {{-- Images --}}
        <div>
            <div class="aspect-square bg-gray-100 rounded-2xl overflow-hidden mb-3">
                @if($product->thumbnail)
                    <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-8xl text-gray-300">📦</div>
                @endif
            </div>
            @if($product->images->isNotEmpty())
                <div class="grid grid-cols-4 gap-2">
                    @foreach($product->images as $image)
                        <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden cursor-pointer">
                            <img src="{{ asset('storage/'.$image->image) }}" alt="" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Details --}}
        <div>
            <div class="flex items-start justify-between mb-3">
                <div>
                    <p class="text-sm text-indigo-600 font-medium mb-1">
                        <a href="{{ route('stores.show', $product->store) }}" class="hover:underline">{{ $product->store->name }}</a>
                    </p>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
                </div>
                @if($product->hasDiscount())
                    <span class="bg-red-100 text-red-700 text-sm font-bold px-2 py-1 rounded-lg">-{{ $product->discountPercentage() }}%</span>
                @endif
            </div>

            <div class="flex items-center gap-3 mb-4">
                <span class="text-3xl font-bold text-gray-900">₦{{ number_format($product->price, 2) }}</span>
                @if($product->hasDiscount())
                    <span class="text-lg text-gray-400 line-through">₦{{ number_format($product->compare_price, 2) }}</span>
                @endif
            </div>

            @if($product->short_description)
                <p class="text-gray-600 mb-5">{{ $product->short_description }}</p>
            @endif

            <div class="mb-5">
                <span class="text-sm font-medium {{ $product->isInStock() ? 'text-green-600' : 'text-red-600' }}">
                    {{ $product->isInStock() ? '✓ In Stock ('.$product->stock.' available)' : '✗ Out of Stock' }}
                </span>
            </div>

            @if($product->isInStock())
                <form action="{{ route('cart.add') }}" method="POST" class="flex gap-3 mb-6">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="flex items-center border border-gray-300 rounded-lg">
                        <button type="button" onclick="const q=this.nextElementSibling; if(q.value>1) q.value--" class="px-3 py-2 text-gray-600 hover:text-indigo-600">−</button>
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                            class="w-12 text-center border-0 text-sm focus:outline-none">
                        <button type="button" onclick="const q=this.previousElementSibling; q.value=parseInt(q.value)+1" class="px-3 py-2 text-gray-600 hover:text-indigo-600">+</button>
                    </div>
                    <button type="submit" class="flex-1 bg-indigo-600 text-white py-2.5 rounded-lg font-medium hover:bg-indigo-700 transition-colors">
                        Add to Cart
                    </button>
                </form>
            @else
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6 text-sm text-red-700">
                    This product is currently out of stock.
                </div>
            @endif

            @if($product->sku)
                <p class="text-xs text-gray-400">SKU: {{ $product->sku }}</p>
            @endif
        </div>
    </div>

    {{-- Description --}}
    @if($product->description)
        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8">
            <h2 class="text-lg font-semibold mb-4">Product Description</h2>
            <div class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">{{ $product->description }}</div>
        </div>
    @endif

    {{-- Reviews --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8">
        <h2 class="text-lg font-semibold mb-4">
            Reviews ({{ $product->reviews->where('is_approved', true)->count() }})
        </h2>
        @forelse($product->reviews->where('is_approved', true) as $review)
            <div class="border-b border-gray-100 pb-4 mb-4 last:border-0 last:mb-0 last:pb-0">
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-yellow-400 text-sm">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
                    <span class="text-sm font-medium">{{ $review->user->name }}</span>
                    <span class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                </div>
                @if($review->title)
                    <p class="text-sm font-semibold mb-1">{{ $review->title }}</p>
                @endif
                @if($review->body)
                    <p class="text-sm text-gray-600">{{ $review->body }}</p>
                @endif
            </div>
        @empty
            <p class="text-sm text-gray-500">No reviews yet.</p>
        @endforelse
    </div>

    {{-- Related products --}}
    @if($relatedProducts->isNotEmpty())
        <div>
            <h2 class="text-xl font-bold mb-5">Related Products</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach($relatedProducts as $related)
                    @include('components.product-card', ['product' => $related])
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
