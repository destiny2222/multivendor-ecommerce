@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold mb-6">My Orders</h1>

    @if($orders->isEmpty())
        <div class="text-center py-20 text-gray-400">
            <div class="text-6xl mb-4">📦</div>
            <p class="font-medium mb-3">No orders yet</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 text-sm">Shop Now</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($orders as $order)
                <div class="bg-white rounded-xl border border-gray-200 p-5 hover:shadow-sm transition-shadow">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $order->order_number }}</p>
                            <p class="text-xs text-gray-500">{{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                bg-{{ $order->statusColor() }}-100 text-{{ $order->statusColor() }}-800">
                                {{ $order->statusLabel() }}
                            </span>
                            <a href="{{ route('customer.orders.show', $order) }}" class="text-xs text-indigo-600 hover:underline">
                                View Details →
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <p class="text-gray-600">{{ $order->items->count() }} item(s)</p>
                        <p class="font-bold text-gray-900">₦{{ number_format($order->total, 2) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-6">{{ $orders->links() }}</div>
    @endif
</div>
@endsection
