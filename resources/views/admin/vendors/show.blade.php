@extends('layouts.admin')

@section('title', $user->name)

@section('content')
<div class="max-w-4xl">
    <a href="{{ route('admin.vendors.index') }}" class="text-sm text-gray-500 hover:text-indigo-600 mb-5 block">← Back to Vendors</a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <h2 class="font-semibold mb-3">Vendor Info</h2>
            <p class="text-sm font-medium">{{ $user->name }}</p>
            <p class="text-sm text-gray-500">{{ $user->email }}</p>
            <p class="text-sm text-gray-500 mt-1">{{ $user->phone }}</p>
            <p class="text-xs text-gray-400 mt-2">Joined {{ $user->created_at->format('M d, Y') }}</p>
        </div>

        @if($user->store)
            <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 p-5">
                <div class="flex justify-between items-start mb-3">
                    <h2 class="font-semibold">{{ $user->store->name }}</h2>
                    <span class="text-xs px-2 py-0.5 rounded-full font-medium
                        {{ $user->store->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ ucfirst($user->store->status) }}
                    </span>
                </div>
                <p class="text-sm text-gray-600 mb-3">{{ $user->store->description }}</p>
                <p class="text-sm text-gray-500">{{ $user->store->products->count() }} products</p>

                <div class="mt-4">
                    <form method="POST" action="{{ route('admin.vendors.update-status', $user) }}" class="flex gap-2">
                        @csrf @method('PATCH')
                        <select name="status" class="border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none">
                            @foreach(['pending','active','suspended'] as $s)
                                <option value="{{ $s }}" {{ $user->store->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-indigo-600 text-white px-3 py-1.5 rounded-lg text-sm hover:bg-indigo-700">Update Status</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
