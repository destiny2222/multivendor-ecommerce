@extends('layouts.admin')

@section('title', 'Vendors')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Vendor List</h5>
                <div class="pull-right">
                    @foreach(['all', 'pending', 'active', 'suspended'] as $s)
                        <a href="{{ route('admin.vendors.index', ['status' => $s]) }}"
                            class="btn btn-sm {{ request('status', 'all') === $s ? 'btn-primary' : 'btn-outline-primary' }} me-1">
                            {{ ucfirst($s) }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table all-package">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Vendor</th>
                                <th scope="col">Store</th>
                                <th scope="col">Status</th>
                                <th scope="col">Joined</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($vendors as $vendor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <p class="mb-0 f-w-600">{{ $vendor->name }}</p>
                                        <p class="mb-0 f-12 text-muted">{{ $vendor->email }}</p>
                                    </td>
                                    <td>{{ $vendor->store?->name ?? '—' }}</td>
                                    <td>
                                        @if($vendor->store)
                                            @php
                                                $cls = match($vendor->store->status) {
                                                    'active' => 'order-success',
                                                    'pending' => 'order-warning',
                                                    default => 'order-cancle',
                                                };
                                            @endphp
                                            <span class="{{ $cls }} digits">{{ ucfirst($vendor->store->status) }}</span>
                                        @else
                                            <span class="text-muted f-12">No store</span>
                                        @endif
                                    </td>
                                    <td class="digits">{{ $vendor->created_at->format('M d, Y') }}</td>
                                    <td>
                                        @if($vendor->store)
                                            <form method="POST" action="{{ route('admin.vendors.update-status', $vendor) }}" class="d-inline">
                                                @csrf @method('PATCH')
                                                <select name="status" onchange="this.form.submit()" class="form-control form-control-sm d-inline-block w-auto me-2">
                                                    @foreach(['pending','active','suspended'] as $s)
                                                        <option value="{{ $s }}" {{ $vendor->store->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        @endif
                                        <a href="{{ route('admin.vendors.show', $vendor) }}" class="btn btn-primary btn-xs">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No vendors found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">{{ $vendors->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
