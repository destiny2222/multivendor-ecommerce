@extends('layouts.vendor')

@section('title', 'My Products')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-500">{{ $products->total() }} products</p>
    <a href="{{ route('vendor.products.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">
        + Add Product
    </a>
</div>

@if($products->isEmpty())
    <div class="text-center py-20 text-gray-400">
        <div class="text-5xl mb-3">📦</div>
        <p class="font-medium mb-3">No products yet</p>
        <a href="{{ route('vendor.products.create') }}" class="inline-block bg-indigo-600 text-white px-5 py-2 rounded-lg text-sm hover:bg-indigo-700">Add your first product</a>
    </div>
@else
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Product</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Category</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Price</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Stock</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Status</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                    @if($product->thumbnail)
                                        <img src="{{ asset('storage/'.$product->thumbnail) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-300">📦</div>
                                    @endif
                                </div>
                                <span class="font-medium text-gray-800">{{ $product->name }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ $product->category?->name ?? '—' }}</td>
                        <td class="px-4 py-3 font-semibold">₦{{ number_format($product->price, 2) }}</td>
                        <td class="px-4 py-3">
                            <span class="{{ $product->stock <= 5 ? 'text-red-600' : 'text-gray-700' }}">{{ $product->stock }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                {{ $product->status === 'active' ? 'bg-green-100 text-green-800' : ($product->status === 'draft' ? 'bg-gray-100 text-gray-600' : 'bg-red-100 text-red-700') }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('vendor.products.edit', $product) }}" class="text-indigo-600 hover:underline text-xs">Edit</a>
                                <form action="{{ route('vendor.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline text-xs">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-5">{{ $products->links() }}</div>
@endif
@endsection
