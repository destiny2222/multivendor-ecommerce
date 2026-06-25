@extends('layouts.vendor')

@section('title', 'Orders')

@section('content')
@if($orderItems->isEmpty())
    <div class="text-center py-20 text-gray-400">
        <div class="text-5xl mb-3">📋</div>
        <p class="font-medium">No orders yet</p>
    </div>
@else
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Order</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Customer</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Product</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Qty</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Total</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Status</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($orderItems as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-xs text-gray-500">{{ $item->order->order_number }}</td>
                        <td class="px-4 py-3 font-medium">{{ $item->order->user->name }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $item->product->name }}</td>
                        <td class="px-4 py-3">{{ $item->quantity }}</td>
                        <td class="px-4 py-3 font-semibold">₦{{ number_format($item->subtotal, 2) }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                {{ $item->status === 'delivered' ? 'bg-green-100 text-green-800' : ($item->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('vendor.orders.show', $item) }}" class="text-indigo-600 hover:underline text-xs">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-5">{{ $orderItems->links() }}</div>
@endif
@endsection
