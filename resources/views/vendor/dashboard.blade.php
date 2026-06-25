@extends('layouts.vendor')

@section('title', 'Dashboard')

@section('content')
{{-- Store status warning --}}
@if($store->status === 'pending')
    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6 text-sm text-yellow-800">
        ⏳ Your store is pending approval. Some features may be limited until an admin activates your store.
    </div>
@elseif($store->status === 'suspended')
    <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6 text-sm text-red-800">
        ⚠️ Your store has been suspended. Please contact support.
    </div>
@endif

{{-- Stats --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Total Products</p>
        <p class="text-3xl font-bold text-gray-900">{{ $totalProducts }}</p>
        <p class="text-xs text-green-600 mt-1">{{ $activeProducts }} active</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Total Orders</p>
        <p class="text-3xl font-bold text-gray-900">{{ $totalOrders }}</p>
        <p class="text-xs text-yellow-600 mt-1">{{ $pendingOrders }} pending</p>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 p-5 col-span-2">
        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Total Revenue</p>
        <p class="text-3xl font-bold text-indigo-600">₦{{ number_format($totalRevenue, 2) }}</p>
    </div>
</div>

{{-- Quick actions --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-semibold">Recent Orders</h2>
            <a href="{{ route('vendor.orders.index') }}" class="text-xs text-indigo-600 hover:underline">View all</a>
        </div>
        @if($recentOrders->isEmpty())
            <p class="text-sm text-gray-400 text-center py-6">No orders yet.</p>
        @else
            <div class="space-y-3">
                @foreach($recentOrders as $item)
                    <div class="flex items-center justify-between text-sm py-2 border-b border-gray-50 last:border-0">
                        <div>
                            <p class="font-medium">{{ $item->order->user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $item->product->name }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold">₦{{ number_format($item->subtotal, 2) }}</p>
                            <span class="text-xs text-gray-400">{{ ucfirst($item->status) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <h2 class="font-semibold mb-4">Quick Actions</h2>
        <div class="space-y-2">
            <a href="{{ route('vendor.products.create') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 text-sm">
                <span class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600">+</span>
                <span>Add New Product</span>
            </a>
            <a href="{{ route('vendor.orders.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 text-sm">
                <span class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center text-green-600">📋</span>
                <span>Manage Orders</span>
            </a>
            <a href="{{ route('vendor.store.edit') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 text-sm">
                <span class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center text-yellow-600">⚙</span>
                <span>Edit Store Profile</span>
            </a>
        </div>
    </div>
</div>
@endsection
