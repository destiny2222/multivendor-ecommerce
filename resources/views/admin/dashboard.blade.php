@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    @foreach([
        ['label' => 'Customers', 'value' => $totalUsers, 'color' => 'blue'],
        ['label' => 'Vendors', 'value' => $totalVendors.' ('.$pendingVendors.' pending)', 'color' => 'purple'],
        ['label' => 'Products', 'value' => $totalProducts, 'color' => 'green'],
        ['label' => 'Total Revenue', 'value' => '₦'.number_format($totalRevenue, 2), 'color' => 'indigo'],
    ] as $stat)
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">{{ $stat['label'] }}</p>
            <p class="text-2xl font-bold text-{{ $stat['color'] }}-600">{{ $stat['value'] }}</p>
        </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-semibold">Recent Orders</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-xs text-indigo-600 hover:underline">View all</a>
        </div>
        <div class="space-y-3">
            @forelse($recentOrders as $order)
                <div class="flex items-center justify-between text-sm py-2 border-b border-gray-50 last:border-0">
                    <div>
                        <p class="font-medium">{{ $order->user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $order->order_number }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold">₦{{ number_format($order->total, 2) }}</p>
                        <span class="text-xs bg-{{ $order->statusColor() }}-100 text-{{ $order->statusColor() }}-800 px-1.5 py-0.5 rounded-full">{{ $order->statusLabel() }}</span>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-400 text-center py-4">No orders yet.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-semibold">Recent Vendors</h2>
            <a href="{{ route('admin.vendors.index') }}" class="text-xs text-indigo-600 hover:underline">View all</a>
        </div>
        <div class="space-y-3">
            @forelse($recentVendors as $store)
                <div class="flex items-center justify-between text-sm py-2 border-b border-gray-50 last:border-0">
                    <div>
                        <p class="font-medium">{{ $store->name }}</p>
                        <p class="text-xs text-gray-500">{{ $store->user->email }}</p>
                    </div>
                    <span class="text-xs px-2 py-0.5 rounded-full font-medium
                        {{ $store->status === 'active' ? 'bg-green-100 text-green-800' : ($store->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                        {{ ucfirst($store->status) }}
                    </span>
                </div>
            @empty
                <p class="text-sm text-gray-400 text-center py-4">No vendors yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
