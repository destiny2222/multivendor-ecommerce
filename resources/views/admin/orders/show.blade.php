@extends('layouts.admin')

@section('title', 'Order '.$order->order_number)

@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm mb-4">
            <i data-feather="arrow-left"></i> Back to Orders
        </a>
    </div>

    <div class="col-xl-8 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $order->order_number }}</h5>
                @php
                    $statusClass = match($order->status) {
                        'completed', 'delivered' => 'order-success',
                        'pending', 'processing', 'shipped' => 'order-warning',
                        'cancelled', 'refunded' => 'order-cancle',
                        default => 'order-warning',
                    };
                @endphp
                <span class="{{ $statusClass }} digits pull-right">{{ ucfirst($order->status) }}</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordernone">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Store</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="f-w-600">{{ $item->product_name }}</td>
                                    <td class="digits">{{ $item->store->name ?? '—' }}</td>
                                    <td class="digits">₦{{ number_format($item->price, 2) }}</td>
                                    <td class="digits">{{ $item->quantity }}</td>
                                    <td class="digits">₦{{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end f-w-600">Subtotal</td>
                                <td class="digits">₦{{ number_format($order->subtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-end f-w-600">Shipping</td>
                                <td class="digits">₦{{ number_format($order->shipping_fee, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-end f-w-700 txt-primary">Total</td>
                                <td class="digits f-w-700 txt-primary">₦{{ number_format($order->total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Update Status</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="d-flex gap-2">
                    @csrf @method('PATCH')
                    <select name="status" class="form-control">
                        @foreach(['pending','processing','shipped','delivered','cancelled','refunded'] as $s)
                            <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5>Customer</h5>
            </div>
            <div class="card-body">
                <h6 class="f-w-600">{{ $order->user->name }}</h6>
                <p class="text-muted">{{ $order->user->email }}</p>
                @if($order->user->phone)
                    <p class="text-muted">{{ $order->user->phone }}</p>
                @endif
                <p class="f-12 text-muted">Order placed {{ $order->created_at->format('M d, Y H:i') }}</p>
            </div>
        </div>

        @if($order->address)
            <div class="card">
                <div class="card-header">
                    <h5>Shipping Address</h5>
                </div>
                <div class="card-body">
                    <p class="f-w-600 mb-1">{{ $order->address->full_name }}</p>
                    <p class="text-muted f-12 mb-1">{{ $order->address->phone }}</p>
                    <p class="text-muted f-12 mb-1">{{ $order->address->address_line1 }}</p>
                    @if($order->address->address_line2)
                        <p class="text-muted f-12 mb-1">{{ $order->address->address_line2 }}</p>
                    @endif
                    <p class="text-muted f-12 mb-1">{{ $order->address->city }}, {{ $order->address->state }}</p>
                    <p class="text-muted f-12">{{ $order->address->country }}</p>
                </div>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5>Payment</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span class="f-12 text-muted">Method</span>
                    <span class="f-w-600">{{ ucfirst($order->payment_method ?? 'N/A') }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="f-12 text-muted">Status</span>
                    @php
                        $payClass = match($order->payment_status) {
                            'paid' => 'order-success',
                            'pending' => 'order-warning',
                            default => 'order-cancle',
                        };
                    @endphp
                    <span class="{{ $payClass }} digits">{{ ucfirst($order->payment_status) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
