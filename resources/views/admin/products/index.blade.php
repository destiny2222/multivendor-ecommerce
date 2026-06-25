@extends('layouts.admin')

@section('title', 'Products')

@section('content')
<form class="flex gap-3 mb-5" method="GET">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search products..."
        class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm flex-1 focus:outline-none focus:ring-2 focus:ring-indigo-500">
    <select name="status" class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm">
        <option value="">All Statuses</option>
        @foreach(['active','draft','inactive'] as $s)
            <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
        @endforeach
    </select>
    <button type="submit" class="bg-indigo-600 text-white px-4 py-1.5 rounded-lg text-sm">Filter</button>
</form>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-4 py-3 font-medium text-gray-600">Product</th>
                <th class="text-left px-4 py-3 font-medium text-gray-600">Store</th>
                <th class="text-left px-4 py-3 font-medium text-gray-600">Price</th>
                <th class="text-left px-4 py-3 font-medium text-gray-600">Stock</th>
                <th class="text-left px-4 py-3 font-medium text-gray-600">Status</th>
                <th class="text-left px-4 py-3 font-medium text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium max-w-[200px] truncate">{{ $product->name }}</td>
                    <td class="px-4 py-3 text-gray-500 text-xs">{{ $product->store?->name }}</td>
                    <td class="px-4 py-3 font-semibold">₦{{ number_format($product->price, 2) }}</td>
                    <td class="px-4 py-3 {{ $product->stock === 0 ? 'text-red-600' : 'text-gray-700' }}">{{ $product->stock }}</td>
                    <td class="px-4 py-3">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                            {{ $product->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                            {{ ucfirst($product->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:underline text-xs">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-4 py-8 text-center text-gray-400">No products found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-5">{{ $products->links() }}</div>
@endsection
