@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-xl-3 col-md-6 xl-50">
        <div class="card o-hidden widget-cards">
            <div class="bg-warning card-body">
                <div class="media static-top-widget row">
                    <div class="icons-widgets col-4">
                        <div class="align-self-center text-center">
                            <i data-feather="navigation" class="font-warning"></i>
                        </div>
                    </div>
                    <div class="media-body col-8">
                        <span class="m-0">Total Revenue</span>
                        <h3 class="mb-0">₦<span class="counter">{{ number_format($totalRevenue, 2) }}</span></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 xl-50">
        <div class="card o-hidden widget-cards">
            <div class="bg-secondary card-body">
                <div class="media static-top-widget row">
                    <div class="icons-widgets col-4">
                        <div class="align-self-center text-center">
                            <i data-feather="box" class="font-secondary"></i>
                        </div>
                    </div>
                    <div class="media-body col-8">
                        <span class="m-0">Total Products</span>
                        <h3 class="mb-0"><span class="counter">{{ $totalProducts }}</span></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 xl-50">
        <div class="card o-hidden widget-cards">
            <div class="bg-primary card-body">
                <div class="media static-top-widget row">
                    <div class="icons-widgets col-4">
                        <div class="align-self-center text-center">
                            <i data-feather="archive" class="font-primary"></i>
                        </div>
                    </div>
                    <div class="media-body col-8">
                        <span class="m-0">Total Orders</span>
                        <h3 class="mb-0"><span class="counter">{{ $totalOrders }}</span></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 xl-50">
        <div class="card o-hidden widget-cards">
            <div class="bg-danger card-body">
                <div class="media static-top-widget row">
                    <div class="icons-widgets col-4">
                        <div class="align-self-center text-center">
                            <i data-feather="users" class="font-danger"></i>
                        </div>
                    </div>
                    <div class="media-body col-8">
                        <span class="m-0">Total Vendors</span>
                        <h3 class="mb-0"><span class="counter">{{ $totalVendors }}</span></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-7 xl-100">
        <div class="card">
            <div class="card-header">
                <h5>Recent Orders</h5>
            </div>
            <div class="card-body">
                <div class="user-status table-responsive latest-order-table">
                    <table class="table table-bordernone">
                        <thead>
                            <tr>
                                <th scope="col">Order #</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order) }}" class="txt-primary">
                                            {{ $order->order_number }}
                                        </a>
                                    </td>
                                    <td class="digits">{{ $order->user->name ?? 'Guest' }}</td>
                                    <td class="digits">₦{{ number_format($order->total, 2) }}</td>
                                    <td>
                                        @php
                                            $statusClass = match($order->status) {
                                                'completed', 'delivered' => 'order-success',
                                                'pending', 'processing' => 'order-warning',
                                                'cancelled' => 'order-cancle',
                                                default => 'order-warning',
                                            };
                                        @endphp
                                        <span class="{{ $statusClass }} digits">{{ ucfirst($order->status) }}</span>
                                    </td>
                                    <td class="digits">{{ $order->created_at->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No orders yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">View All Orders</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-5 xl-100">
        <div class="card">
            <div class="card-header">
                <h5>Recent Vendors</h5>
            </div>
            <div class="card-body">
                <div class="user-status table-responsive">
                    <table class="table table-bordernone">
                        <thead>
                            <tr>
                                <th>Store</th>
                                <th>Owner</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentVendors as $store)
                                <tr>
                                    <td class="digits">{{ $store->name }}</td>
                                    <td class="digits">{{ $store->user->email }}</td>
                                    <td>
                                        @php
                                            $storeClass = match($store->status) {
                                                'active' => 'order-success',
                                                'pending' => 'order-warning',
                                                default => 'order-cancle',
                                            };
                                        @endphp
                                        <span class="{{ $storeClass }} digits">{{ ucfirst($store->status) }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No vendors yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <a href="{{ route('admin.vendors.index') }}" class="btn btn-secondary">View All Vendors</a>
                </div>
            </div>
        </div>

        
    </div>
</div>
@endsection
