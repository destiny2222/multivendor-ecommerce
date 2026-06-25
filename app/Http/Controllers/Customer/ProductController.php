<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with(['store', 'category'])
            ->where('status', 'active');

        if ($request->filled('q')) {
            $query->where('name', 'like', '%'.$request->q.'%');
        }

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $sortOptions = [
            'newest' => ['created_at', 'desc'],
            'price_asc' => ['price', 'asc'],
            'price_desc' => ['price', 'desc'],
        ];

        [$sortCol, $sortDir] = $sortOptions[$request->sort ?? 'newest'];
        $query->orderBy($sortCol, $sortDir);

        $products = $query->paginate(16)->withQueryString();
        $categories = Category::where('is_active', true)->whereNull('parent_id')->get();

        return view('customer.products.index', compact('products', 'categories'));
    }

    public function show(Product $product): View
    {
        abort_if($product->status !== 'active', 404);

        $product->load(['store', 'category', 'images', 'reviews.user']);

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->limit(4)
            ->get();

        return view('customer.products.show', compact('product', 'relatedProducts'));
    }
}
