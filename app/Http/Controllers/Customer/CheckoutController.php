<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $cart = Cart::where('user_id', auth()->id())
            ->with('items.product.store')
            ->first();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $addresses = auth()->user()->addresses;

        return view('customer.checkout', compact('cart', 'addresses'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'address_id' => ['required_without:new_address', 'nullable', 'exists:addresses,id'],
            'new_address.full_name' => ['required_without:address_id', 'nullable', 'string'],
            'new_address.phone' => ['required_without:address_id', 'nullable', 'string'],
            'new_address.address_line1' => ['required_without:address_id', 'nullable', 'string'],
            'new_address.city' => ['required_without:address_id', 'nullable', 'string'],
            'new_address.state' => ['required_without:address_id', 'nullable', 'string'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        $cart = Cart::where('user_id', auth()->id())->with('items.product')->first();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $addressId = $request->address_id;

        if (! $addressId && $request->filled('new_address.full_name')) {
            $address = auth()->user()->addresses()->create($request->input('new_address'));
            $addressId = $address->id;
        }

        DB::transaction(function () use ($cart, $request, $addressId) {
            $subtotal = $cart->items->sum(fn ($item) => $item->product->price * $item->quantity);

            $order = Order::create([
                'user_id' => auth()->id(),
                'address_id' => $addressId,
                'order_number' => Order::generateOrderNumber(),
                'status' => 'pending',
                'subtotal' => $subtotal,
                'shipping_fee' => 0,
                'total' => $subtotal,
                'notes' => $request->notes,
                'payment_method' => 'cod',
                'payment_status' => 'unpaid',
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'store_id' => $item->product->store_id,
                    'product_name' => $item->product->name,
                    'product_thumbnail' => $item->product->thumbnail,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->product->price * $item->quantity,
                ]);
            }

            $cart->items()->delete();
            $cart->delete();

            session(['last_order_id' => $order->id]);
        });

        $order = Order::where('user_id', auth()->id())->latest()->first();

        return redirect()->route('checkout.success', $order);
    }

    public function success(Order $order): View
    {
        abort_if($order->user_id !== auth()->id(), 403);

        $order->load('items', 'address');

        return view('customer.checkout-success', compact('order'));
    }
}
