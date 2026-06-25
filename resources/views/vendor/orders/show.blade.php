@extends('layouts.vendor')

@section('title', 'Order Detail')

@section('content')
<div class="max-w-2xl">
    <a href="{{ route('vendor.orders.index') }}" class="text-sm text-gray-500 hover:text-indigo-600 mb-5 block">← Back to Orders</a>

    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-5">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h2 class="font-bold text-gray-900">{{ $orderItem->order->order_number }}</h2>
                <p class="text-xs text-gray-500 mt-0.5">{{ $orderItem->order->created_at->format('M d, Y') }}</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                {{ $orderItem->status === 'delivered' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                {{ ucfirst($orderItem->status) }}
            </span>
        </div>

        <div class="flex gap-4 py-4 border-y border-gray-100">
            <div class="w-16 h-16 bg-gray-100 rounded-lg flex-shrink-0"></div>
            <div>
                <p class="font-semibold">{{ $orderItem->product_name }}</p>
                <p class="text-sm text-gray-500 mt-0.5">₦{{ number_format($orderItem->price, 2) }} × {{ $orderItem->quantity }}</p>
                <p class="font-bold text-indigo-600 mt-1">₦{{ number_format($orderItem->subtotal, 2) }}</p>
            </div>
        </div>

        <div class="mt-4">
            <p class="text-sm font-medium text-gray-700 mb-1">Customer</p>
            <p class="text-sm text-gray-600">{{ $orderItem->order->user->name }}</p>
            <p class="text-sm text-gray-500">{{ $orderItem->order->user->email }}</p>
        </div>

        @if($orderItem->order->address)
            <div class="mt-4">
                <p class="text-sm font-medium text-gray-700 mb-1">Delivery Address</p>
                <p class="text-sm text-gray-600">{{ $orderItem->order->address->full_name }}</p>
                <p class="text-sm text-gray-500">{{ $orderItem->order->address->address_line1 }}, {{ $orderItem->order->address->city }}</p>
                <p class="text-sm text-gray-500">{{ $orderItem->order->address->phone }}</p>
            </div>
        @endif
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <h3 class="font-semibold mb-3">Update Status</h3>
        <form method="POST" action="{{ route('vendor.orders.update-status', $orderItem) }}" class="flex gap-3">
            @csrf @method('PATCH')
            <select name="status" class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @foreach(['pending','processing','shipped','delivered','cancelled'] as $status)
                    <option value="{{ $status }}" {{ $orderItem->status === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">
                Update
            </button>
        </form>
    </div>
</div>
@endsection
