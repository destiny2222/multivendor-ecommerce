@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold mb-6">Checkout</h1>

    <form method="POST" action="{{ route('checkout.store') }}" x-data="{ newAddress: {{ $addresses->isEmpty() ? 'true' : 'false' }} }">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                {{-- Delivery Address --}}
                <div class="bg-white rounded-xl border border-gray-200 p-5">
                    <h2 class="font-semibold mb-4">Delivery Address</h2>

                    @if($addresses->isNotEmpty())
                        <div class="space-y-2 mb-4">
                            @foreach($addresses as $address)
                                <label class="flex gap-3 p-3 border border-gray-200 rounded-lg cursor-pointer hover:border-indigo-400 has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50">
                                    <input type="radio" name="address_id" value="{{ $address->id }}"
                                        {{ ($address->is_default || $loop->first) ? 'checked' : '' }}
                                        @click="newAddress = false" class="mt-0.5 text-indigo-600">
                                    <div class="text-sm">
                                        <p class="font-medium">{{ $address->full_name }} · {{ $address->phone }}</p>
                                        <p class="text-gray-500">{{ $address->address_line1 }}, {{ $address->city }}, {{ $address->state }}</p>
                                    </div>
                                </label>
                            @endforeach
                            <label class="flex gap-3 p-3 border border-gray-200 rounded-lg cursor-pointer hover:border-indigo-400">
                                <input type="radio" name="address_id" value="" @click="newAddress = true" class="mt-0.5 text-indigo-600">
                                <span class="text-sm font-medium text-indigo-600">+ Use a new address</span>
                            </label>
                        </div>
                    @endif

                    <div x-show="newAddress" class="space-y-3">
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Full Name</label>
                                <input type="text" name="new_address[full_name]"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Phone</label>
                                <input type="tel" name="new_address[phone]"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Address</label>
                            <input type="text" name="new_address[address_line1]"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">City</label>
                                <input type="text" name="new_address[city]"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">State</label>
                                <input type="text" name="new_address[state]"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Notes --}}
                <div class="bg-white rounded-xl border border-gray-200 p-5">
                    <h2 class="font-semibold mb-3">Order Notes (optional)</h2>
                    <textarea name="notes" rows="3" placeholder="Any special instructions..."
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('notes') }}</textarea>
                </div>
            </div>

            {{-- Summary --}}
            <div>
                <div class="bg-white rounded-xl border border-gray-200 p-5 sticky top-20">
                    <h2 class="font-semibold mb-4">Order Summary</h2>
                    <div class="space-y-2 mb-4">
                        @foreach($cart->items as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 truncate max-w-[160px]">{{ $item->product->name }} × {{ $item->quantity }}</span>
                                <span>₦{{ number_format($item->subtotal(), 2) }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="border-t border-gray-100 pt-3 space-y-2 mb-5">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Shipping</span>
                            <span class="text-green-600">Free</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg">
                            <span>Total</span>
                            <span class="text-indigo-600">₦{{ number_format($cart->total(), 2) }}</span>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-3 mb-4">
                        <p class="text-xs text-gray-600 font-medium">Payment Method</p>
                        <p class="text-sm font-semibold">Cash on Delivery</p>
                    </div>

                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition-colors">
                        Place Order
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
