@extends('layouts.app')

@section('title', 'Order Placed!')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
    <div class="text-6xl mb-4">🎉</div>
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Order Placed Successfully!</h1>
    <p class="text-gray-500 mb-2">Thank you for your order. We'll process it shortly.</p>
    <p class="text-sm text-gray-400 mb-8">Order #{{ $order->order_number }}</p>

    <div class="bg-white rounded-xl border border-gray-200 p-6 text-left mb-8">
        <h2 class="font-semibold mb-4">Order Summary</h2>
        <div class="space-y-3">
            @foreach($order->items as $item)
                <div class="flex justify-between text-sm">
                    <span class="text-gray-700">{{ $item->product_name }} × {{ $item->quantity }}</span>
                    <span class="font-medium">₦{{ number_format($item->subtotal, 2) }}</span>
                </div>
            @endforeach
        </div>
        <div class="border-t border-gray-100 pt-3 mt-3 flex justify-between font-bold">
            <span>Total</span>
            <span class="text-indigo-600">₦{{ number_format($order->total, 2) }}</span>
        </div>
    </div>

    @if($order->address)
        <div class="bg-gray-50 rounded-xl border border-gray-200 p-4 text-left mb-8 text-sm">
            <p class="font-medium text-gray-700 mb-1">Deliver to:</p>
            <p>{{ $order->address->full_name }} · {{ $order->address->phone }}</p>
            <p class="text-gray-500">{{ $order->address->address_line1 }}, {{ $order->address->city }}, {{ $order->address->state }}</p>
        </div>
    @endif

    <div class="flex gap-3 justify-center">
        <a href="{{ route('customer.orders') }}" class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 text-sm font-medium">
            Track My Orders
        </a>
        <a href="{{ route('home') }}" class="border border-gray-300 text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-50 text-sm font-medium">
            Continue Shopping
        </a>
    </div>
</div>
@endsection
