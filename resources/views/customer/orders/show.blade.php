@extends('layouts.app')

@section('title', 'Order '.$order->order_number)

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('customer.orders') }}" class="text-gray-500 hover:text-indigo-600 text-sm">← Back to Orders</a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-5">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h1 class="text-xl font-bold text-gray-900">{{ $order->order_number }}</h1>
                <p class="text-sm text-gray-500">Placed {{ $order->created_at->format('M d, Y \a\t H:i') }}</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                bg-{{ $order->statusColor() }}-100 text-{{ $order->statusColor() }}-800">
                {{ $order->statusLabel() }}
            </span>
        </div>

        <div class="space-y-4">
            @foreach($order->items as $item)
                <div class="flex gap-4 py-3 border-b border-gray-100 last:border-0">
                    <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                        @if($item->product_thumbnail)
                            <img src="{{ asset('storage/'.$item->product_thumbnail) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-xl text-gray-300">📦</div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-sm">{{ $item->product_name }}</p>
                        <p class="text-xs text-gray-500">{{ $item->store->name }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">₦{{ number_format($item->price, 2) }} × {{ $item->quantity }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-sm">₦{{ number_format($item->subtotal, 2) }}</p>
                        <span class="inline-block text-xs px-2 py-0.5 rounded-full bg-gray-100 text-gray-600 mt-1">{{ ucfirst($item->status) }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 pt-4 border-t border-gray-100 space-y-1.5">
            <div class="flex justify-between text-sm text-gray-600">
                <span>Subtotal</span>
                <span>₦{{ number_format($order->subtotal, 2) }}</span>
            </div>
            <div class="flex justify-between text-sm text-gray-600">
                <span>Shipping</span>
                <span>{{ $order->shipping_fee > 0 ? '₦'.number_format($order->shipping_fee, 2) : 'Free' }}</span>
            </div>
            <div class="flex justify-between font-bold text-lg pt-2 border-t border-gray-100">
                <span>Total</span>
                <span class="text-indigo-600">₦{{ number_format($order->total, 2) }}</span>
            </div>
        </div>
    </div>

    @if($order->address)
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <h2 class="font-semibold mb-3">Delivery Address</h2>
            <p class="text-sm font-medium">{{ $order->address->full_name }}</p>
            <p class="text-sm text-gray-600">{{ $order->address->phone }}</p>
            <p class="text-sm text-gray-600">{{ $order->address->address_line1 }}, {{ $order->address->city }}, {{ $order->address->state }}</p>
        </div>
    @endif
</div>
@endsection
