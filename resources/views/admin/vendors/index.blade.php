@extends('layouts.admin')

@section('title', 'Vendors')

@section('content')
<div class="flex gap-3 mb-5">
    @foreach(['all', 'pending', 'active', 'suspended'] as $s)
        <a href="{{ route('admin.vendors.index', ['status' => $s]) }}"
            class="px-3 py-1.5 rounded-lg text-xs font-medium {{ request('status', 'all') === $s ? 'bg-indigo-600 text-white' : 'bg-white border border-gray-300 text-gray-600 hover:bg-gray-50' }}">
            {{ ucfirst($s) }}
        </a>
    @endforeach
</div>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-4 py-3 font-medium text-gray-600">Vendor</th>
                <th class="text-left px-4 py-3 font-medium text-gray-600">Store</th>
                <th class="text-left px-4 py-3 font-medium text-gray-600">Status</th>
                <th class="text-left px-4 py-3 font-medium text-gray-600">Joined</th>
                <th class="text-left px-4 py-3 font-medium text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($vendors as $vendor)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <p class="font-medium">{{ $vendor->name }}</p>
                        <p class="text-xs text-gray-500">{{ $vendor->email }}</p>
                    </td>
                    <td class="px-4 py-3 text-gray-700">{{ $vendor->store?->name ?? '—' }}</td>
                    <td class="px-4 py-3">
                        @if($vendor->store)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                {{ $vendor->store->status === 'active' ? 'bg-green-100 text-green-800' : ($vendor->store->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                {{ ucfirst($vendor->store->status) }}
                            </span>
                        @else
                            <span class="text-xs text-gray-400">No store</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-500 text-xs">{{ $vendor->created_at->format('M d, Y') }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            @if($vendor->store)
                                <form method="POST" action="{{ route('admin.vendors.update-status', $vendor) }}">
                                    @csrf @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="text-xs border border-gray-300 rounded px-2 py-1">
                                        @foreach(['pending','active','suspended'] as $s)
                                            <option value="{{ $s }}" {{ $vendor->store->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            @endif
                            <a href="{{ route('admin.vendors.show', $vendor) }}" class="text-indigo-600 hover:underline text-xs">View</a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-8 text-center text-gray-400">No vendors found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-5">{{ $vendors->links() }}</div>
@endsection
