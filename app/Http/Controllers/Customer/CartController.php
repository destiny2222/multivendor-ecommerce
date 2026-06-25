<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = $this->resolveCart();
        $cart->load('items.product.store');

        return view('customer.cart', compact('cart'));
    }

    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['integer', 'min:1', 'max:100'],
        ]);

        $product = Product::findOrFail($request->product_id);
        abort_if($product->status !== 'active' || $product->stock < 1, 422);

        $cart = $this->resolveCart();
        $quantity = $request->quantity ?? 1;

        $item = $cart->items()->where('product_id', $product->id)->first();

        if ($item) {
            $item->increment('quantity', $quantity);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return back()->with('success', 'Item added to cart.');
    }

    public function update(Request $request, CartItem $cartItem): RedirectResponse
    {
        $request->validate(['quantity' => ['required', 'integer', 'min:1', 'max:100']]);

        $this->authorizeCartItem($cartItem);
        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Cart updated.');
    }

    public function remove(CartItem $cartItem): RedirectResponse
    {
        $this->authorizeCartItem($cartItem);
        $cartItem->delete();

        return back()->with('success', 'Item removed from cart.');
    }

    private function resolveCart(): Cart
    {
        if (auth()->check()) {
            return Cart::firstOrCreate(['user_id' => auth()->id()]);
        }

        $sessionId = session()->getId();

        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }

    private function authorizeCartItem(CartItem $cartItem): void
    {
        $cart = $this->resolveCart();
        abort_if($cartItem->cart_id !== $cart->id, 403);
    }
}
