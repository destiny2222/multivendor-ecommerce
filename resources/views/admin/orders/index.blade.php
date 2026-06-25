@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
<form class="flex gap-3 mb-5" method="GET">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by order number..."
        class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm flex-1 focus:outline-none focus:ring-2 focus:ring-indigo-500">
    <select name="status" class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm">
        <option value="">All Statuses</option>
        @foreach(['pending','processing','shipped','delivered','cancelled','refunded'] as $s)
            <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
        @endforeach
    </select>
    <button type="submit" class="bg-indigo-600 text-white px-4 py-1.5 rounded-lg text-sm">Filter</button>
</form>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-4 py-3 font-medium text-gray-600">Order #</th>
                <th class="text-left px-4 py-3 font-medium text-gray-600">Customer</th>
                <th class="text-left px-4 py-3 font-medium text-gray-600">Items</th>
                <th class="text-left px-4 py-3 font-medium text-gray-600">Total</th>
                <th class="text-left px-4 py-3 font-medium text-gray-600">Status</th>
                <th class="text-left px-4 py-3 font-medium text-gray-600">Date</th>
                <th class="text-left px-4 py-3 font-medium text-gray-600"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-mono text-xs">{{ $order->order_number }}</td>
                    <td class="px-4 py-3 font-medium">{{ $order->user->name }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $order->items->count() }}</td>
                    <td class="px-4 py-3 font-semibold">₦{{ number_format($order->total, 2) }}</td>
                    <td class="px-4 py-3">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                            bg-{{ $order->statusColor() }}-100 text-{{ $order->statusColor() }}-800">
                            {{ $order->statusLabel() }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-500 text-xs">{{ $order->created_at->format('M d, Y') }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-indigo-600 hover:underline text-xs">View</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="px-4 py-8 text-center text-gray-400">No orders found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-5">{{ $orders->links() }}</div>
@endsection
