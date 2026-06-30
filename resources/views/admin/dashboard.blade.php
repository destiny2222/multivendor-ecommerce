@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <!-- Row 1 -->
        <!-- Card 1: Total Products -->
        <div class="col-md-6 col-xl-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-semibold mb-1 fs-14">Total Products</p>
                        <h3 class="text-dark mb-0">{{ $totalProducts }}</h3>
                    </div>
                    <div class="avatar-md bg-warning-subtle rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <iconify-icon icon="solar:box-bold-duotone" class="fs-24 text-warning"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Total Customers -->
        <div class="col-md-6 col-xl-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-semibold mb-1 fs-14">Total Customers</p>
                        <h3 class="text-dark mb-0">{{ $totalUsers }}</h3>
                    </div>
                    <div class="avatar-md bg-warning-subtle rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <iconify-icon icon="solar:users-group-two-rounded-bold-duotone" class="fs-24 text-warning"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Total Categories -->
        <div class="col-md-6 col-xl-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-semibold mb-1 fs-14">Total Categories</p>
                        <h3 class="text-dark mb-0">{{ $totalCategories }}</h3>
                    </div>
                    <div class="avatar-md bg-warning-subtle rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <iconify-icon icon="solar:clipboard-list-bold-duotone" class="fs-24 text-warning"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 2 -->
        <!-- Card 4: Total Order -->
        <div class="col-md-6 col-xl-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-semibold mb-1 fs-14">Total Order</p>
                        <h3 class="text-dark mb-0">{{ $totalOrders }}</h3>
                    </div>
                    <div class="avatar-md bg-warning-subtle rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <iconify-icon icon="solar:cart-5-bold-duotone" class="fs-24 text-warning"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 5: Pending Orders -->
        <div class="col-md-6 col-xl-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-semibold mb-1 fs-14">Pending Orders</p>
                        <h3 class="text-dark mb-0">{{ $pendingOrders }}</h3>
                    </div>
                    <div class="avatar-md bg-warning-subtle rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <iconify-icon icon="solar:clock-circle-bold-duotone" class="fs-24 text-warning"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 6: Delivered Orders -->
        <div class="col-md-6 col-xl-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-semibold mb-1 fs-14">Delivered Orders</p>
                        <h3 class="text-dark mb-0">{{ $deliveredOrders }}</h3>
                    </div>
                    <div class="avatar-md bg-warning-subtle rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <iconify-icon icon="solar:check-circle-bold-duotone" class="fs-24 text-warning"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 3 -->
        <!-- Card 7: Canceled Orders -->
        <div class="col-md-6 col-xl-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-semibold mb-1 fs-14">Canceled Orders</p>
                        <h3 class="text-dark mb-0">{{ $cancelledOrders }}</h3>
                    </div>
                    <div class="avatar-md bg-warning-subtle rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <iconify-icon icon="solar:close-circle-bold-duotone" class="fs-24 text-warning"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 8: Total Product Sale -->
        <div class="col-md-6 col-xl-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-semibold mb-1 fs-14">Total Product Sale</p>
                        <h3 class="text-dark mb-0">{{ $totalProductSale }}</h3>
                    </div>
                    <div class="avatar-md bg-warning-subtle rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <iconify-icon icon="solar:bag-smile-bold-duotone" class="fs-24 text-warning"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 9: This Month Sale -->
        <div class="col-md-6 col-xl-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-semibold mb-1 fs-14">This Month Sale</p>
                        <h3 class="text-dark mb-0">{{ $thisMonthSale }}</h3>
                    </div>
                    <div class="avatar-md bg-warning-subtle rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <iconify-icon icon="solar:calendar-bold-duotone" class="fs-24 text-warning"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 4 -->
        <!-- Card 10: This Year Product Sale -->
        <div class="col-md-6 col-xl-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-semibold mb-1 fs-14">This Year Product Sale</p>
                        <h3 class="text-dark mb-0">{{ $thisYearProductSale }}</h3>
                    </div>
                    <div class="avatar-md bg-warning-subtle rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <iconify-icon icon="solar:calendar-date-bold-duotone" class="fs-24 text-warning"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 11: Total Earning -->
        <div class="col-md-6 col-xl-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-semibold mb-1 fs-14">Total Earning</p>
                        <h3 class="text-dark mb-0">₦{{ number_format($totalRevenue, 2) }}</h3>
                    </div>
                    <div class="avatar-md bg-warning-subtle rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <iconify-icon icon="solar:dollar-minimalistic-bold-duotone" class="fs-24 text-warning"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 12: Today Pending Earning -->
        <div class="col-md-6 col-xl-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-semibold mb-1 fs-14">Today Pending Earning</p>
                        <h3 class="text-dark mb-0">₦{{ number_format($todayPendingEarning, 2) }}</h3>
                    </div>
                    <div class="avatar-md bg-warning-subtle rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <iconify-icon icon="solar:clock-circle-bold-duotone" class="fs-24 text-warning"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 5 -->
        <!-- Card 13: This Month Earning -->
        <div class="col-md-6 col-xl-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-semibold mb-1 fs-14">This Month Earning</p>
                        <h3 class="text-dark mb-0">₦{{ number_format($thisMonthEarning, 2) }}</h3>
                    </div>
                    <div class="avatar-md bg-warning-subtle rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <iconify-icon icon="solar:calendar-bold-duotone" class="fs-24 text-warning"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 14: This Year Earning -->
        <div class="col-md-6 col-xl-4 mb-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-semibold mb-1 fs-14">This Year Earning</p>
                        <h3 class="text-dark mb-0">₦{{ number_format($thisYearEarning, 2) }}</h3>
                    </div>
                    <div class="avatar-md bg-warning-subtle rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                        <iconify-icon icon="solar:calendar-date-bold-duotone" class="fs-24 text-warning"></iconify-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 col-xxl-7">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Users Statistics </h4>
                            <div>
                                <button type="button" class="btn btn-sm btn-outline-light">ALL</button>
                                <button type="button" class="btn btn-sm btn-outline-light">1M</button>
                                <button type="button" class="btn btn-sm btn-outline-light">6M</button>
                                <button type="button" class="btn btn-sm btn-outline-light active">1Y</button>
                            </div>
                    </div> <!-- end card-title-->

                    <div dir="ltr">
                            <div id="dash-performance-chart" class="apex-charts"></div>
                    </div>
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
       

        <!-- Recent Vendors -->
        <div class="col-12 col-xl-5 col-xxl-5 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0">Recent Vendors</h4>
                    <a href="{{ route('admin.vendors.index') }}" class="btn btn-sm btn-soft-primary">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-centered table-nowrap mb-0">
                        <thead class="bg-light bg-opacity-50">
                            <tr>
                                <th class="ps-3">Store</th>
                                <th>Owner</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentVendors as $store)
                                <tr>
                                    <td class="ps-3 fw-semibold">{{ $store->name }}</td>
                                    <td>{{ $store->user->email }}</td>
                                    <td>
                                        @php
                                            $storeBadge = match($store->status) {
                                                'active' => 'bg-success-subtle text-success',
                                                'pending' => 'bg-warning-subtle text-warning',
                                                default => 'bg-danger-subtle text-danger',
                                            };
                                        @endphp
                                        <span class="badge {{ $storeBadge }}">{{ ucfirst($store->status) }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-3">No vendors yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- Recent Orders -->
        <div class="col-12 col-xl-12 col-xxl-12 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0">Recent Orders</h4>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-soft-primary">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-centered table-nowrap mb-0">
                        <thead class="bg-light bg-opacity-50">
                            <tr>
                                <th class="ps-3">Order #</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td class="ps-3">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="fw-semibold text-primary">
                                            {{ $order->order_number }}
                                        </a>
                                    </td>
                                    <td>{{ $order->user->name ?? 'Guest' }}</td>
                                    <td>₦{{ number_format($order->total, 2) }}</td>
                                    <td>
                                        @php
                                            $statusBadge = match($order->status) {
                                                'completed', 'delivered' => 'bg-success-subtle text-success',
                                                'pending' => 'bg-warning-subtle text-warning',
                                                'processing' => 'bg-primary-subtle text-primary',
                                                'cancelled' => 'bg-danger-subtle text-danger',
                                                default => 'bg-secondary-subtle text-secondary',
                                            };
                                        @endphp
                                        <span class="badge {{ $statusBadge }}">{{ ucfirst($order->status) }}</span>
                                    </td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-3">No orders yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                series: [{
                    name: "New Customers",
                    type: "bar",
                    data: @json($monthlyUsers),
                },
                {
                    name: "New Vendors",
                    type: "bar",
                    data: @json($monthlyVendors),
                },
                {
                    name: "New Products",
                    type: "line",
                    data: @json($monthlyProducts),
                },
                {
                    name: "Orders",
                    type: "area",
                    data: @json($monthlyOrders),
                }],
                chart: {
                    height: 313,
                    type: "line",
                    toolbar: {
                        show: false,
                    },
                },
                stroke: {
                    dashArray: [0, 0, 0, 0],
                    width: [0, 0, 2, 2],
                    curve: 'smooth'
                },
                fill: {
                    opacity: [1, 1, 1, 0.3],
                    type: ['solid', 'solid', 'solid', 'gradient'],
                    gradient: {
                        type: "vertical",
                        inverseColors: false,
                        opacityFrom: 0.5,
                        opacityTo: 0,
                        stops: [0, 90]
                    },
                },
                markers: {
                    size: [0, 0, 0, 0],
                    strokeWidth: 2,
                    hover: {
                        size: 4,
                    },
                },
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                },
                yaxis: {
                    min: 0,
                    axisBorder: {
                        show: false,
                    }
                },
                grid: {
                    show: true,
                    strokeDashArray: 3,
                    xaxis: {
                        lines: {
                            show: false,
                        },
                    },
                    yaxis: {
                        lines: {
                            show: true,
                        },
                    },
                    padding: {
                        top: 0,
                        right: -2,
                        bottom: 0,
                        left: 10,
                    },
                },
                legend: {
                    show: true,
                    horizontalAlign: "center",
                    offsetX: 0,
                    offsetY: 5,
                    markers: {
                        width: 9,
                        height: 9,
                        radius: 6,
                    },
                    itemMargin: {
                        horizontal: 10,
                        vertical: 0,
                    },
                },
                plotOptions: {
                    bar: {
                        columnWidth: "30%",
                        barHeight: "70%",
                        borderRadius: 3,
                    },
                },
                colors: ["#ff6c2f", "#3bc0c0", "#7f56da", "#22c55e"],
                tooltip: {
                    shared: true,
                    y: [{
                        formatter: function (y) {
                            if (typeof y !== "undefined") {
                                return y.toFixed(0);
                            }
                            return y;
                        },
                    },
                    {
                        formatter: function (y) {
                            if (typeof y !== "undefined") {
                                return y.toFixed(0);
                            }
                            return y;
                        },
                    },
                    {
                        formatter: function (y) {
                            if (typeof y !== "undefined") {
                                return y.toFixed(0);
                            }
                            return y;
                        },
                    },
                    {
                        formatter: function (y) {
                            if (typeof y !== "undefined") {
                                return y.toFixed(0);
                            }
                            return y;
                        },
                    }],
                },
            };

            var container = document.querySelector("#dash-performance-chart");
            if (container) {
                container.innerHTML = "";
                var dynamicChart = new ApexCharts(container, options);
                dynamicChart.render();
            }
        });
    </script>
    @endpush
@endsection
