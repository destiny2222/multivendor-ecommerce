@extends('layouts.app')

@section('title', $store->name)

@section('content')
<div class="bg-indigo-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-center gap-5">
            <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center text-indigo-600 text-2xl font-bold">
                {{ strtoupper(substr($store->name, 0, 1)) }}
            </div>
            <div>
                <h1 class="text-2xl font-bold">{{ $store->name }}</h1>
                @if($store->description)
                    <p class="text-indigo-100 text-sm mt-1">{{ $store->description }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if($products->isEmpty())
        <div class="text-center py-16 text-gray-400">
            <div class="text-5xl mb-3">📦</div>
            <p>No products in this store yet.</p>
        </div>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($products as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
        <div class="mt-8">{{ $products->links() }}</div>
    @endif
</div>
@endsection
