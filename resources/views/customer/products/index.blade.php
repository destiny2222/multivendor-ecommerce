@extends('layouts.main')

@section('title', 'Products — ' . config('app.name', 'MarketPlace'))

@section('content')
    <!-- Start of Main -->
    <main class="main">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb bb-no">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('products.index') }}">Shop</a></li>
                    <li>Fullwidth</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of Page Content -->
        <div class="page-content">
            <!-- Start of Shop Banner -->
            <div class="shop-default-banner shop-boxed-banner banner d-flex align-items-center mb-6" style="background-image: url({{ asset('assets/images/shop/banner2.jpg') }}); background-color: #FFC74E;">
                <div class="container banner-content">
                    <h4 class="banner-subtitle font-weight-bold">Accessories Collection</h4>
                    <h3 class="banner-title text-white text-uppercase font-weight-bolder ls-10">
                        @if(request('category'))
                            {{ $categories->firstWhere('slug', request('category'))?->name ?? 'Shop' }}
                        @else
                            All Products
                        @endif
                    </h3>
                    <a href="{{ route('home') }}" class="btn btn-dark btn-rounded btn-icon-right">Discover Now<i class="w-icon-long-arrow-right"></i></a>
                </div>
            </div>
            <!-- End of Shop Banner -->

            <div class="container">
                <!-- Start of Shop Content -->
                <div class="shop-content row gutter-lg mb-10">
                    <!-- Start of Sidebar, Shop Sidebar -->
                    <aside class="sidebar shop-sidebar sticky-sidebar-wrapper sidebar-fixed">
                        <!-- Start of Sidebar Overlay -->
                        <div class="sidebar-overlay"></div>
                        <a class="sidebar-close" href="#"><i class="close-icon"></i></a>

                        <!-- Start of Sidebar Content -->
                        <div class="sidebar-content scrollable">
                            <!-- Start of Sticky Sidebar -->
                            <div class="sticky-sidebar">
                                <div class="filter-actions">
                                    <label>Filter :</label>
                                    <a href="{{ route('products.index') }}" class="btn btn-dark btn-link filter-clean">Clean All</a>
                                </div>
                                <!-- Start of Collapsible widget -->
                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title"><span>All Categories</span></h3>
                                    <ul class="widget-body filter-items search-ul">
                                        <li class="{{ !request('category') ? 'active' : '' }}">
                                            <a href="{{ route('products.index', request()->except(['category', 'page'])) }}">All Categories</a>
                                        </li>
                                        @foreach($categories as $cat)
                                            <li class="{{ request('category') === $cat->slug ? 'active' : '' }}">
                                                <a href="{{ route('products.index', array_merge(request()->except('page'), ['category' => $cat->slug])) }}">{{ $cat->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- End of Collapsible Widget -->

                                <!-- Start of Collapsible Widget -->
                                <div class="widget widget-collapsible">
                                    <h3 class="widget-title"><span>Price</span></h3>
                                    <div class="widget-body">
                                        <ul class="filter-items search-ul">
                                            <li><a href="{{ route('products.index', array_merge(request()->except('page'), ['min_price' => 0, 'max_price' => 1000])) }}">₦0.00 - ₦1,000.00</a></li>
                                            <li><a href="{{ route('products.index', array_merge(request()->except('page'), ['min_price' => 1000, 'max_price' => 5000])) }}">₦1,000.00 - ₦5,000.00</a></li>
                                            <li><a href="{{ route('products.index', array_merge(request()->except('page'), ['min_price' => 5000, 'max_price' => 10000])) }}">₦5,000.00 - ₦10,000.00</a></li>
                                            <li><a href="{{ route('products.index', array_merge(request()->except('page'), ['min_price' => 10000, 'max_price' => 50000])) }}">₦10,000.00 - ₦50,000.00</a></li>
                                            <li><a href="{{ route('products.index', array_merge(request()->except('page'), ['min_price' => 50000])) }}">₦50,000.00+</a></li>
                                        </ul>
                                        <form class="price-range" method="GET" action="{{ route('products.index') }}">
                                            @if(request('category'))
                                                <input type="hidden" name="category" value="{{ request('category') }}">
                                            @endif
                                            @if(request('q'))
                                                <input type="hidden" name="q" value="{{ request('q') }}">
                                            @endif
                                            @if(request('sort'))
                                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                                            @endif
                                            <input type="number" name="min_price" value="{{ request('min_price') }}" class="min_price text-center" placeholder="₦min"><span class="delimiter">-</span><input type="number" name="max_price" value="{{ request('max_price') }}" class="max_price text-center" placeholder="₦max"><button type="submit" class="btn btn-primary btn-rounded" style="padding: 0.8em 1.5em; margin-left: 5px;">Go</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- End of Collapsible Widget -->
                            </div>
                            <!-- End of Sidebar Content -->
                        </div>
                        <!-- End of Sidebar Content -->
                    </aside>
                    <!-- End of Shop Sidebar -->

                    <!-- Start of Shop Main Content -->
                    <div class="main-content">
                        <nav class="toolbox sticky-toolbox sticky-content fix-top">
                            <div class="toolbox-left">
                                <a href="#" class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle 
                                    btn-icon-left d-block d-lg-none"><i class="w-icon-category"></i><span>Filters</span></a>
                                <div class="toolbox-item toolbox-sort select-box text-dark">
                                    <label>Sort By :</label>
                                    <select name="sort" class="form-control" onchange="window.location.search = new URLSearchParams({...Object.fromEntries(new URLSearchParams(window.location.search)), sort: this.value}).toString()">
                                        <option value="newest" {{ request('sort','newest') === 'newest' ? 'selected' : '' }}>Newest</option>
                                        <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                        <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="toolbox-right">
                                <div class="toolbox-item toolbox-layout">
                                    <a href="#" class="icon-mode-grid btn-layout active">
                                        <i class="w-icon-grid"></i>
                                    </a>
                                </div>
                            </div>
                        </nav>
                        
                        <div class="product-wrapper row cols-md-3 cols-sm-2 cols-2">
                            @forelse($products as $product)
                                <div class="product-wrap">
                                    <div class="product text-center">
                                        <figure class="product-media">
                                            <a href="{{ route('products.show', $product) }}">
                                                @if($product->thumbnail)
                                                    <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->name }}" width="300" height="338">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-4xl text-gray-300 py-5" style="background: #f3f3f3; min-height: 200px;">📦</div>
                                                @endif
                                            </a>
                                            <div class="product-action-horizontal">
                                                @if($product->isInStock())
                                                    <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        <button type="submit" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart" style="background: none; border: none; padding: 0; outline: none;"></button>
                                                    </form>
                                                @endif
                                                <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Wishlist"></a>
                                                <a href="{{ route('products.show', $product) }}" class="btn-product-icon btn-quickview w-icon-search" title="Quick View"></a>
                                            </div>
                                        </figure>
                                        <div class="product-details">
                                            <div class="product-cat">
                                                <a href="{{ route('products.index', ['category' => $product->category?->slug]) }}">{{ $product->category?->name }}</a>
                                            </div>
                                            <h3 class="product-name">
                                                <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                                            </h3>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: {{ $product->averageRating() * 20 }}%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <a href="{{ route('products.show', $product) }}" class="rating-reviews">({{ $product->reviews()->where('is_approved', true)->count() }} Reviews)</a>
                                            </div>
                                            <div class="product-pa-wrapper">
                                                <div class="product-price">
                                                    @if($product->hasDiscount())
                                                        <ins class="new-price">₦{{ number_format($product->price, 2) }}</ins>
                                                        <del class="old-price">₦{{ number_format($product->compare_price, 2) }}</del>
                                                    @else
                                                        <ins class="new-price">₦{{ number_format($product->price, 2) }}</ins>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 py-5 text-center text-muted" style="font-size: 1.6rem;">No products found matching the criteria.</div>
                            @endforelse
                        </div>

                        <div class="toolbox toolbox-pagination justify-content-between">
                            <p class="showing-info mb-2 mb-sm-0">
                                Showing <span>{{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} of {{ $products->total() }}</span> Products
                            </p>
                            <div class="pagination-wrapper">
                                {{ $products->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                    <!-- End of Shop Main Content -->
                </div>
                <!-- End of Shop Content -->
            </div>
        </div>
        <!-- End of Page Content -->
    </main>
    <!-- End of Main -->
@endsection
