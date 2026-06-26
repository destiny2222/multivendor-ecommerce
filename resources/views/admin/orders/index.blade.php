@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Order List</h5>
                <form class="pull-right d-flex gap-2" method="GET">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search order number..." class="form-control form-control-sm">
                    <select name="status" class="form-control form-control-sm">
                        <option value="">All Statuses</option>
                        @foreach(['pending','processing','shipped','delivered','cancelled','refunded'] as $s)
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
                                <th scope="col">Order #</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Items</th>
                                <th scope="col">Total</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td class="f-w-600">{{ $order->order_number }}</td>
                                    <td class="digits">{{ $order->user->name }}</td>
                                    <td class="digits">{{ $order->items->count() }}</td>
                                    <td class="digits">₦{{ number_format($order->total, 2) }}</td>
                                    <td>
                                        @php
                                            $payClass = match($order->payment_status) {
                                                'paid' => 'order-success',
                                                'pending' => 'order-warning',
                                                default => 'order-cancle',
                                            };
                                        @endphp
                                        <span class="{{ $payClass }} digits">{{ ucfirst($order->payment_status) }}</span>
                                    </td>
                                    <td>
                                        @php
                                            $statusClass = match($order->status) {
                                                'completed', 'delivered' => 'order-success',
                                                'pending', 'processing', 'shipped' => 'order-warning',
                                                'cancelled', 'refunded' => 'order-cancle',
                                                default => 'order-warning',
                                            };
                                        @endphp
                                        <span class="{{ $statusClass }} digits">{{ ucfirst($order->status) }}</span>
                                    </td>
                                    <td class="digits">{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-primary btn-xs">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">{{ $orders->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
