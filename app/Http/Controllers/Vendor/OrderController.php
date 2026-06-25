<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $store = auth()->user()->store;
        abort_if(! $store, 403);

        $orderItems = OrderItem::where('store_id', $store->id)
            ->with('order.user', 'product')
            ->latest()
            ->paginate(15);

        return view('vendor.orders.index', compact('orderItems'));
    }

    public function show(OrderItem $orderItem): View
    {
        abort_if($orderItem->store_id !== auth()->user()->store?->id, 403);

        $orderItem->load('order.user', 'order.address', 'product');

        return view('vendor.orders.show', compact('orderItem'));
    }

    public function updateStatus(Request $request, OrderItem $orderItem): RedirectResponse
    {
        abort_if($orderItem->store_id !== auth()->user()->store?->id, 403);

        $request->validate([
            'status' => ['required', 'in:pending,processing,shipped,delivered,cancelled'],
        ]);

        $orderItem->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated.');
    }
}
