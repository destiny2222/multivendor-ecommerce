@extends('layouts.admin')

@section('title', 'Order '.$order->order_number)

@section('content')
<div class="max-w-3xl">
    <a href="{{ route('admin.orders.index') }}" class="text-sm text-gray-500 hover:text-indigo-600 mb-5 block">← Back to Orders</a>

    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-5">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h2 class="font-bold text-lg">{{ $order->order_number }}</h2>
                <p class="text-sm text-gray-500">{{ $order->user->name }} · {{ $order->created_at->format('M d, Y') }}</p>
            </div>
            <span class="bg-{{ $order->statusColor() }}-100 text-{{ $order->statusColor() }}-800 px-3 py-1 rounded-full text-sm font-medium">
                {{ $order->statusLabel() }}
            </span>
        </div>

        <div class="space-y-3 mb-4">
            @foreach($order->items as $item)
                <div class="flex justify-between text-sm py-2 border-b border-gray-50 last:border-0">
                    <div>
                        <p class="font-medium">{{ $item->product_name }}</p>
                        <p class="text-xs text-gray-500">{{ $item->store->name }} · qty {{ $item->quantity }}</p>
                    </div>
                    <p class="font-semibold">₦{{ number_format($item->subtotal, 2) }}</p>
                </div>
            @endforeach
        </div>

        <div class="border-t border-gray-100 pt-3 flex justify-between font-bold text-lg">
            <span>Total</span>
            <span class="text-indigo-600">₦{{ number_format($order->total, 2) }}</span>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <h3 class="font-semibold mb-3">Update Order Status</h3>
        <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="flex gap-3">
            @csrf @method('PATCH')
            <select name="status" class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none">
                @foreach(['pending','processing','shipped','delivered','cancelled','refunded'] as $s)
                    <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">Update</button>
        </form>
    </div>
</div>
@endsection
