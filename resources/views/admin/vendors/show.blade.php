@extends('layouts.master')

@section('title', $user->name)

@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('admin.vendors.index') }}" class="btn btn-outline-secondary btn-sm mb-4">
            <i data-feather="arrow-left"></i> Back to Vendors
        </a>
    </div>

    <div class="col-xl-4 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>Vendor Information</h5>
            </div>
            <div class="card-body text-center">
                <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white mx-auto mb-3" style="width:70px;height:70px;font-size:26px;font-weight:700;">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <h5 class="f-w-600">{{ $user->name }}</h5>
                <p class="text-muted">{{ $user->email }}</p>
                @if($user->phone)
                    <p class="text-muted">{{ $user->phone }}</p>
                @endif
                <p class="f-12 text-muted">Joined {{ $user->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>

    @if($user->store)
        <div class="col-xl-8 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $user->store->name }}</h5>
                    @php
                        $storeClass = match($user->store->status) {
                            'active' => 'order-success',
                            'pending' => 'order-warning',
                            default => 'order-cancle',
                        };
                    @endphp
                    <span class="{{ $storeClass }} digits pull-right">{{ ucfirst($user->store->status) }}</span>
                </div>
                <div class="card-body">
                    @if($user->store->description)
                        <p class="text-muted mb-4">{{ $user->store->description }}</p>
                    @endif

                    <div class="row mb-4">
                        <div class="col-4 text-center">
                            <h4 class="txt-primary">{{ $user->store->products->count() }}</h4>
                            <p class="f-12 mb-0">Products</p>
                        </div>
                        <div class="col-4 text-center">
                            <h4 class="txt-secondary">{{ $user->store->orderItems->count() }}</h4>
                            <p class="f-12 mb-0">Orders</p>
                        </div>
                        <div class="col-4 text-center">
                            <h4 class="txt-warning">₦{{ number_format($user->store->orderItems->sum('subtotal'), 2) }}</h4>
                            <p class="f-12 mb-0">Revenue</p>
                        </div>
                    </div>

                    <hr>

                    <h6 class="f-w-600 mb-3">Update Store Status</h6>
                    <form method="POST" action="{{ route('admin.vendors.update-status', $user) }}" class="d-flex gap-2">
                        @csrf @method('PATCH')
                        <select name="status" class="form-control">
                            @foreach(['pending','active','suspended'] as $s)
                                <option value="{{ $s }}" {{ $user->store->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>

            @if($user->store->products->count())
                <div class="card">
                    <div class="card-header">
                        <h5>Products</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordernone">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->store->products->take(10) as $product)
                                        <tr>
                                            <td>{{ Str::limit($product->name, 40) }}</td>
                                            <td class="digits">₦{{ number_format($product->price, 2) }}</td>
                                            <td class="digits">{{ $product->stock }}</td>
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @else
        <div class="col-xl-8 col-lg-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <i data-feather="store" style="width:48px;height:48px;" class="text-muted mb-3"></i>
                    <p class="text-muted">This vendor has not set up a store yet.</p>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
