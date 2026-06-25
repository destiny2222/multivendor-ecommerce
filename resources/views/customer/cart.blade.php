@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold mb-6">Shopping Cart</h1>

    @if($cart->items->isEmpty())
        <div class="text-center py-20 text-gray-400">
            <div class="text-6xl mb-4">🛒</div>
            <p class="text-lg font-medium mb-3">Your cart is empty</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 text-sm">
                Start Shopping
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-3">
                @foreach($cart->items as $item)
                    <div class="bg-white rounded-xl border border-gray-200 p-4 flex gap-4 items-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                            @if($item->product->thumbnail)
                                <img src="{{ asset('storage/'.$item->product->thumbnail) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-2xl text-gray-300">📦</div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('products.show', $item->product) }}" class="font-semibold text-sm text-gray-900 hover:text-indigo-600 block truncate">
                                {{ $item->product->name }}
                            </a>
                            <p class="text-xs text-gray-500">{{ $item->product->store->name }}</p>
                            <p class="text-sm font-bold text-indigo-600 mt-1">₦{{ number_format($item->product->price, 2) }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center border border-gray-300 rounded-lg">
                                @csrf @method('PATCH')
                                <button type="button" onclick="const q=this.nextElementSibling; if(q.value>1){q.value--;this.form.submit()}" class="px-2 py-1 text-gray-600 hover:text-indigo-600">−</button>
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="100"
                                    onchange="this.form.submit()"
                                    class="w-10 text-center border-0 text-sm focus:outline-none">
                                <button type="button" onclick="const q=this.previousElementSibling; q.value=parseInt(q.value)+1; this.form.submit()" class="px-2 py-1 text-gray-600 hover:text-indigo-600">+</button>
                            </form>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-bold text-sm">₦{{ number_format($item->subtotal(), 2) }}</p>
                            <form action="{{ route('cart.remove', $item) }}" method="POST" class="mt-1">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs text-red-500 hover:text-red-700">Remove</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Order Summary --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl border border-gray-200 p-5 sticky top-20">
                    <h2 class="font-semibold mb-4">Order Summary</h2>
                    <div class="space-y-2 text-sm mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal ({{ $cart->itemCount() }} items)</span>
                            <span>₦{{ number_format($cart->total(), 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping</span>
                            <span class="text-green-600">Free</span>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 pt-3 mb-5">
                        <div class="flex justify-between font-bold">
                            <span>Total</span>
                            <span class="text-indigo-600">₦{{ number_format($cart->total(), 2) }}</span>
                        </div>
                    </div>
                    @auth
                        <a href="{{ route('checkout.index') }}"
                            class="block w-full text-center bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition-colors">
                            Proceed to Checkout
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="block w-full text-center bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition-colors">
                            Login to Checkout
                        </a>
                    @endauth
                    <a href="{{ route('products.index') }}" class="block text-center text-sm text-gray-500 mt-3 hover:text-indigo-600">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
