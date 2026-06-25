<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $store = auth()->user()->store;

        if (! $store) {
            return redirect()->route('vendor.store.edit')->with('error', 'Please set up your store first.');
        }

        $products = $store->products()->with('category')->latest()->paginate(15);

        return view('vendor.products.index', compact('products', 'store'));
    }

    public function create(): View|RedirectResponse
    {
        $store = auth()->user()->store;

        if (! $store) {
            return redirect()->route('vendor.store.edit')->with('error', 'Please set up your store first.');
        }

        $categories = Category::where('is_active', true)->get();

        return view('vendor.products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $store = auth()->user()->store;
        abort_if(! $store, 403);

        $validated = $this->validateProduct($request);
        $validated['store_id'] = $store->id;
        $validated['slug'] = Str::slug($validated['name']).'-'.time();

        Product::create($validated);

        return redirect()->route('vendor.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product): View
    {
        $this->authorizeProduct($product);

        $categories = Category::where('is_active', true)->get();

        return view('vendor.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $this->authorizeProduct($product);

        $validated = $this->validateProduct($request);
        $product->update($validated);

        return back()->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->authorizeProduct($product);
        $product->delete();

        return redirect()->route('vendor.products.index')->with('success', 'Product deleted.');
    }

    private function authorizeProduct(Product $product): void
    {
        abort_if($product->store_id !== auth()->user()->store?->id, 403);
    }

    private function validateProduct(Request $request): array
    {
        return $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'compare_price' => ['nullable', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'sku' => ['nullable', 'string', 'max:100'],
            'status' => ['required', 'in:draft,active,inactive'],
        ]);
    }
}
