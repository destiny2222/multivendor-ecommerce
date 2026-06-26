@extends('layouts.admin')

@section('title', 'Products')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Product List</h5>
                <form class="pull-right d-flex gap-2" method="GET">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search products..." class="form-control form-control-sm">
                    <select name="status" class="form-control form-control-sm">
                        <option value="">All Statuses</option>
                        @foreach(['active','draft','inactive'] as $s)
                            <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table all-package">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Store</th>
                                <th scope="col">Category</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="f-w-600">{{ Str::limit($product->name, 35) }}</td>
                                    <td class="digits">{{ $product->store?->name ?? '—' }}</td>
                                    <td class="digits">{{ $product->category?->name ?? '—' }}</td>
                                    <td class="digits">₦{{ number_format($product->price, 2) }}</td>
                                    <td class="{{ $product->stock === 0 ? 'txt-danger' : 'digits' }}">{{ $product->stock }}</td>
                                    <td>
                                        @php
                                            $cls = match($product->status) {
                                                'active' => 'order-success',
                                                'draft' => 'order-warning',
                                                default => 'order-cancle',
                                            };
                                        @endphp
                                        <span class="{{ $cls }} digits">{{ ucfirst($product->status) }}</span>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No products found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">{{ $products->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
