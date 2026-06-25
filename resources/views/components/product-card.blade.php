<div class="bg-white rounded-xl border border-gray-200 hover:shadow-md transition-shadow group">
    <a href="{{ route('products.show', $product) }}" class="block">
        <div class="aspect-square bg-gray-100 rounded-t-xl overflow-hidden">
            @if($product->thumbnail)
                <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->name }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            @else
                <div class="w-full h-full flex items-center justify-center text-4xl text-gray-300">📦</div>
            @endif
        </div>
        <div class="p-3">
            <p class="text-xs text-gray-500 mb-1">{{ $product->store->name ?? '' }}</p>
            <h3 class="text-sm font-semibold text-gray-800 line-clamp-2 mb-2 group-hover:text-indigo-600">{{ $product->name }}</h3>
            <div class="flex items-center gap-2">
                <span class="text-sm font-bold text-gray-900">₦{{ number_format($product->price, 2) }}</span>
                @if($product->hasDiscount())
                    <span class="text-xs text-gray-400 line-through">₦{{ number_format($product->compare_price, 2) }}</span>
                    <span class="text-xs bg-red-100 text-red-700 px-1.5 py-0.5 rounded font-medium">-{{ $product->discountPercentage() }}%</span>
                @endif
            </div>
            @if(!$product->isInStock())
                <p class="text-xs text-red-500 mt-1">Out of stock</p>
            @endif
        </div>
    </a>
    @if($product->isInStock())
        <div class="px-3 pb-3">
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="w-full text-xs bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition-colors">
                    Add to Cart
                </button>
            </form>
        </div>
    @endif
</div>
