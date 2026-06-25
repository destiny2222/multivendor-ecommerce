@extends('layouts.vendor')

@section('title', 'Set Up Your Store')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="text-center py-12">
        <div class="text-6xl mb-4">🏪</div>
        <h2 class="text-2xl font-bold mb-2">Set Up Your Store</h2>
        <p class="text-gray-500 mb-6">You need to create your store before you can start selling.</p>
        <a href="{{ route('vendor.store.edit') }}" class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 font-medium">
            Create My Store
        </a>
    </div>
</div>
@endsection
