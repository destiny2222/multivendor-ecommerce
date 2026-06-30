@extends('layouts.main')

@section('title', $product->name . ' — ' . config('app.name', 'MarketPlace'))

@section('content')
    <!-- Start of Main -->
    <main class="main mb-10 pb-1">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav container">
            <ul class="breadcrumb bb-no">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('products.index') }}">Products</a></li>
                @if($product->category)
                    <li><a href="{{ route('products.index', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a></li>
                @endif
                <li>{{ $product->name }}</li>
            </ul>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of Page Content -->
        <div class="page-content">
            <div class="container">
                <div class="row gutter-lg">
                    <div class="main-content">
                        <div class="product product-single row">
                            <div class="col-md-6 mb-6">
                                <div class="product-gallery product-gallery-sticky">
                                    <div class="swiper-container product-single-swiper swiper-theme nav-inner" data-swiper-options="{
                                        'navigation': {
                                            'nextEl': '.swiper-button-next',
                                            'prevEl': '.swiper-button-prev'
                                        }
                                    }">
                                        <div class="swiper-wrapper row cols-1 gutter-no">
                                            <div class="swiper-slide">
                                                <figure class="product-image">
                                                    @if($product->thumbnail)
                                                        <img src="{{ asset('storage/'.$product->thumbnail) }}" data-zoom-image="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->name }}" width="800" height="900">
                                                    @else
                                                        <div class="w-full h-full flex items-center justify-center text-4xl text-gray-300 py-5" style="background: #f3f3f3; min-height: 400px;">📦</div>
                                                    @endif
                                                </figure>
                                            </div>
                                            @foreach($product->images as $img)
                                                <div class="swiper-slide">
                                                    <figure class="product-image">
                                                        <img src="{{ asset('storage/'.$img->image) }}" data-zoom-image="{{ asset('storage/'.$img->image) }}" alt="{{ $product->name }}" width="800" height="900">
                                                    </figure>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="swiper-button-next"></button>
                                        <button class="swiper-button-prev"></button>
                                        <a href="#" class="product-gallery-btn product-image-full"><i class="w-icon-zoom"></i></a>
                                    </div>
                                    <div class="product-thumbs-wrap swiper-container" data-swiper-options="{
                                        'navigation': {
                                            'nextEl': '.swiper-button-next',
                                            'prevEl': '.swiper-button-prev'
                                        }
                                    }">
                                        <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm">
                                            <div class="product-thumb swiper-slide">
                                                @if($product->thumbnail)
                                                    <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="Product Thumb" width="800" height="900">
                                                @else
                                                    <div class="w-full h-full bg-gray-100"></div>
                                                @endif
                                            </div>
                                            @foreach($product->images as $img)
                                                <div class="product-thumb swiper-slide">
                                                    <img src="{{ asset('storage/'.$img->image) }}" alt="Product Thumb" width="800" height="900">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="swiper-button-next"></button>
                                        <button class="swiper-button-prev"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4 mb-md-6">
                                <div class="product-details" data-sticky-options="{'minWidth': 767}">
                                    <h1 class="product-title">{{ $product->name }}</h1>
                                    <div class="product-bm-wrapper">
                                        @if($product->store)
                                            <div class="product-meta">
                                                <div class="product-categories">
                                                    Store:
                                                    <span class="product-category"><a href="{{ route('stores.show', $product->store) }}">{{ $product->store->name }}</a></span>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="product-meta">
                                            @if($product->category)
                                                <div class="product-categories">
                                                    Category:
                                                    <span class="product-category"><a href="{{ route('products.index', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a></span>
                                                </div>
                                            @endif
                                            @if($product->sku)
                                                <div class="product-sku">
                                                    SKU: <span>{{ $product->sku }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <hr class="product-divider">

                                    <div class="product-price">
                                        @if($product->hasDiscount())
                                            <ins class="new-price">₦{{ number_format($product->price, 2) }}</ins>
                                            <del class="old-price">₦{{ number_format($product->compare_price, 2) }}</del>
                                        @else
                                            <ins class="new-price">₦{{ number_format($product->price, 2) }}</ins>
                                        @endif
                                    </div>

                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: {{ $product->averageRating() * 20 }}%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="#product-tab-reviews" class="rating-reviews scroll-to">({{ $product->reviews()->where('is_approved', true)->count() }} Reviews)</a>
                                    </div>

                                    @if($product->short_description)
                                        <div class="product-short-desc">
                                            {!! nl2br(e($product->short_description)) !!}
                                        </div>
                                    @endif

                                    <hr class="product-divider">

                                    <div class="product-sku mb-3">
                                        Availability: 
                                        <span class="{{ $product->isInStock() ? 'text-success' : 'text-danger' }} font-weight-bold">
                                            {{ $product->isInStock() ? 'In Stock ('.$product->stock.' available)' : 'Out of Stock' }}
                                        </span>
                                    </div>

                                    @if($product->isInStock())
                                        <form action="{{ route('cart.add') }}" method="POST" class="product-form-group">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <div class="product-qty-form">
                                                <div class="input-group">
                                                    <input class="quantity form-control" type="number" name="quantity" min="1" max="{{ $product->stock }}" value="1">
                                                    <button type="button" class="quantity-plus w-icon-plus" onclick="const q=this.parentElement.querySelector('input'); if(parseInt(q.value) < parseInt(q.max)) q.value = parseInt(q.value) + 1"></button>
                                                    <button type="button" class="quantity-minus w-icon-minus" onclick="const q=this.parentElement.querySelector('input'); if(parseInt(q.value) > 1) q.value = parseInt(q.value) - 1"></button>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-cart">
                                                <i class="w-icon-cart"></i>
                                                <span>Add to Cart</span>
                                            </button>
                                        </form>
                                    @else
                                        <div class="alert alert-warning alert-simple alert-inline mb-4">
                                            <h4 class="alert-title">Out of Stock!</h4>
                                            This product is currently out of stock.
                                        </div>
                                    @endif

                                    <div class="social-links-wrapper">
                                        <div class="social-links">
                                            <div class="social-icons social-no-color border-thin">
                                                <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                                <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                                <a href="#" class="social-icon social-pinterest fab fa-pinterest-p"></a>
                                                <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                                            </div>
                                        </div>
                                        <span class="divider d-xs-show"></span>
                                        <div class="product-link-wrapper d-flex">
                                            <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"><span></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab tab-nav-boxed tab-nav-underline product-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a href="#product-tab-description" class="nav-link active">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#product-tab-specification" class="nav-link">Specification</a>
                                </li>
                                @if($product->store)
                                    <li class="nav-item">
                                        <a href="#product-tab-vendor" class="nav-link">Vendor Info</a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a href="#product-tab-reviews" class="nav-link">Customer Reviews ({{ $product->reviews()->where('is_approved', true)->count() }})</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="product-tab-description">
                                    <div class="row mb-4">
                                        <div class="col-12 mb-5">
                                            <h4 class="title tab-pane-title font-weight-bold mb-2">Detail Description</h4>
                                            <div class="detail-content" style="font-size: 1.4rem; line-height: 1.8; color: #666;">
                                                {!! nl2br(e($product->description)) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="product-tab-specification">
                                    <ul class="list-none">
                                        @if($product->sku)
                                            <li>
                                                <label>Model / SKU</label>
                                                <p>{{ $product->sku }}</p>
                                            </li>
                                        @endif
                                        @if($product->category)
                                            <li>
                                                <label>Category</label>
                                                <p>{{ $product->category->name }}</p>
                                            </li>
                                        @endif
                                        <li>
                                            <label>Availability</label>
                                            <p>{{ $product->isInStock() ? 'In Stock' : 'Out of Stock' }}</p>
                                        </li>
                                    </ul>
                                </div>
                                @if($product->store)
                                    <div class="tab-pane" id="product-tab-vendor">
                                        <div class="row mb-3">
                                            <div class="col-md-6 mb-4">
                                                <figure class="vendor-banner br-sm">
                                                    <img src="{{ asset('assets/images/products/vendor-banner.jpg') }}" alt="Vendor Banner" width="610" height="295" style="background-color: #353B55;">
                                                </figure>
                                            </div>
                                            <div class="col-md-6 pl-2 pl-md-6 mb-4">
                                                <div class="vendor-user">
                                                    <figure class="vendor-logo mr-4">
                                                        <a href="{{ route('stores.show', $product->store) }}">
                                                            <img src="{{ $product->store->logo ? asset('storage/'.$product->store->logo) : asset('assets/images/products/vendor-logo.jpg') }}" alt="Vendor Logo" width="80" height="80">
                                                        </a>
                                                    </figure>
                                                    <div>
                                                        <div class="vendor-name"><a href="{{ route('stores.show', $product->store) }}">{{ $product->store->name }}</a></div>
                                                    </div>
                                                </div>
                                                <ul class="vendor-info list-style-none">
                                                    <li class="store-name">
                                                        <label>Store Name:</label>
                                                        <span class="detail">{{ $product->store->name }}</span>
                                                    </li>
                                                    @if($product->store->address)
                                                        <li class="store-address">
                                                            <label>Address:</label>
                                                            <span class="detail">{{ $product->store->address }}</span>
                                                        </li>
                                                    @endif
                                                    @if($product->store->phone)
                                                        <li class="store-phone">
                                                            <label>Phone:</label>
                                                            <a href="tel:{{ $product->store->phone }}">{{ $product->store->phone }}</a>
                                                        </li>
                                                    @endif
                                                </ul>
                                                <a href="{{ route('stores.show', $product->store) }}" class="btn btn-dark btn-link btn-underline btn-icon-right">Visit Store<i class="w-icon-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                        @if($product->store->description)
                                            <p class="mb-5">{!! nl2br(e($product->store->description)) !!}</p>
                                        @endif
                                    </div>
                                @endif
                                <div class="tab-pane" id="product-tab-reviews">
                                    <div class="row mb-4">
                                        <div class="col-xl-4 col-lg-5 mb-4">
                                            <div class="ratings-wrapper">
                                                <div class="avg-rating-container">
                                                    <h4 class="avg-mark font-weight-bolder ls-50">{{ number_format($product->averageRating(), 1) }}</h4>
                                                    <div class="avg-rating">
                                                        <p class="text-dark mb-1">Average Rating</p>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                                <span class="ratings" style="width: {{ $product->averageRating() * 20 }}%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                            <a href="#" class="rating-reviews">({{ $product->reviews()->where('is_approved', true)->count() }} Reviews)</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ratings-value d-flex align-items-center text-dark ls-25">
                                                    <span class="text-dark font-weight-bold">
                                                        @php
                                                            $approvedReviewsCount = $product->reviews()->where('is_approved', true)->count();
                                                            $fourFiveStarCount = $product->reviews()->where('is_approved', true)->where('rating', '>=', 4)->count();
                                                            $percentageRecommended = $approvedReviewsCount > 0 ? ($fourFiveStarCount / $approvedReviewsCount) * 100 : 0;
                                                        @endphp
                                                        {{ number_format($percentageRecommended, 1) }}%
                                                    </span>Recommended<span class="count">({{ $fourFiveStarCount }} of {{ $approvedReviewsCount }})</span>
                                                </div>
                                                <div class="ratings-list">
                                                    @foreach(range(5, 1) as $stars)
                                                        @php
                                                            $starReviewsCount = $product->reviews()->where('is_approved', true)->where('rating', $stars)->count();
                                                            $starPercentage = $approvedReviewsCount > 0 ? ($starReviewsCount / $approvedReviewsCount) * 100 : 0;
                                                        @endphp
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                                <span class="ratings" style="width: {{ $stars * 20 }}%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                            <div class="progress-bar progress-bar-sm ">
                                                                <span style="width: {{ $starPercentage }}%;"></span>
                                                            </div>
                                                            <div class="progress-value">
                                                                <mark>{{ number_format($starPercentage, 0) }}%</mark>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a href="#show-all" class="nav-link active">Show All</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="show-all">
                                                <ul class="comments list-style-none">
                                                    @forelse($product->reviews()->where('is_approved', true)->get() as $review)
                                                        <li class="comment">
                                                            <div class="comment-body">
                                                                <figure class="comment-avatar">
                                                                    <img src="{{ asset('assets/images/agents/1-100x100.png') }}" alt="Commenter Avatar" width="90" height="90">
                                                                </figure>
                                                                <div class="comment-content">
                                                                    <h4 class="comment-author">
                                                                        <a href="#">{{ $review->user->name }}</a>
                                                                        <span class="comment-date">{{ $review->created_at->format('F d, Y \a\t g:i a') }}</span>
                                                                    </h4>
                                                                    <div class="ratings-container comment-rating">
                                                                        <div class="ratings-full">
                                                                            <span class="ratings" style="width: {{ $review->rating * 20 }}%;"></span>
                                                                            <span class="tooltiptext tooltip-top"></span>
                                                                        </div>
                                                                    </div>
                                                                    @if($review->title)
                                                                        <h5 class="comment-title font-weight-bold mb-1">{{ $review->title }}</h5>
                                                                    @endif
                                                                    <p>{{ $review->body }}</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @empty
                                                        <li class="comment"><p class="text-muted">No reviews yet.</p></li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Related products -->
                        @if($relatedProducts->isNotEmpty())
                            <section class="related-product-section">
                                <div class="title-link-wrapper mb-4">
                                    <h4 class="title text-left">Related Products</h4>
                                </div>
                                <div class="swiper-container swiper-theme" data-swiper-options="{
                                    'spaceBetween': 20,
                                    'slidesPerView': 2,
                                    'breakpoints': {
                                        '576': {
                                            'slidesPerView': 3
                                        },
                                        '768': {
                                            'slidesPerView': 4
                                        },
                                        '992': {
                                            'slidesPerView': 3
                                        }
                                    }
                                }">
                                    <div class="swiper-wrapper row cols-lg-3 cols-md-4 cols-sm-3 cols-2">
                                        @foreach($relatedProducts as $related)
                                            <div class="swiper-slide product-wrap">
                                                <div class="product text-center">
                                                    <figure class="product-media">
                                                        <a href="{{ route('products.show', $related) }}">
                                                            @if($related->thumbnail)
                                                                <img src="{{ asset('storage/'.$related->thumbnail) }}" alt="{{ $related->name }}" width="300" height="338">
                                                            @else
                                                                <div class="w-full h-full flex items-center justify-center text-4xl text-gray-300 py-5" style="background: #f3f3f3; min-height: 200px;">📦</div>
                                                            @endif
                                                        </a>
                                                        <div class="product-action-vertical">
                                                            @if($related->isInStock())
                                                                <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    <input type="hidden" name="product_id" value="{{ $related->id }}">
                                                                    <button type="submit" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart" style="background: none; border: none; padding: 0; outline: none;"></button>
                                                                </form>
                                                            @endif
                                                            <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Wishlist"></a>
                                                        </div>
                                                    </figure>
                                                    <div class="product-details">
                                                        <div class="product-cat">
                                                            <a href="{{ route('products.index', ['category' => $related->category?->slug]) }}">{{ $related->category?->name }}</a>
                                                        </div>
                                                        <h4 class="product-name">
                                                            <a href="{{ route('products.show', $related) }}">{{ $related->name }}</a>
                                                        </h4>
                                                        <div class="ratings-container">
                                                            <div class="ratings-full">
                                                                <span class="ratings" style="width: {{ $related->averageRating() * 20 }}%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                            <a href="{{ route('products.show', $related) }}" class="rating-reviews">({{ $related->reviews()->where('is_approved', true)->count() }} Reviews)</a>
                                                        </div>
                                                        <div class="product-pa-wrapper">
                                                            <div class="product-price">
                                                                @if($related->hasDiscount())
                                                                    <ins class="new-price">₦{{ number_format($related->price, 2) }}</ins>
                                                                    <del class="old-price">₦{{ number_format($related->compare_price, 2) }}</del>
                                                                @else
                                                                    <ins class="new-price">₦{{ number_format($related->price, 2) }}</ins>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                        @endif
                    </div>

                    <!-- Sidebar content -->
                    <aside class="sidebar product-sidebar sidebar-fixed right-sidebar sticky-sidebar-wrapper">
                        <div class="sidebar-overlay"></div>
                        <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                        <a href="#" class="sidebar-toggle d-flex d-lg-none"><i class="fas fa-chevron-left"></i></a>
                        <div class="sidebar-content scrollable">
                            <div class="sticky-sidebar">
                                <div class="widget widget-icon-box mb-6">
                                    <div class="icon-box icon-box-side">
                                        <span class="icon-box-icon text-dark">
                                            <i class="w-icon-truck"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title">Free Shipping & Returns</h4>
                                            <p>For all orders over ₦50,000</p>
                                        </div>
                                    </div>
                                    <div class="icon-box icon-box-side">
                                        <span class="icon-box-icon text-dark">
                                            <i class="w-icon-bag"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title">Secure Payment</h4>
                                            <p>We ensure secure payment</p>
                                        </div>
                                    </div>
                                    <div class="icon-box icon-box-side">
                                        <span class="icon-box-icon text-dark">
                                            <i class="w-icon-money"></i>
                                        </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title">Money Back Guarantee</h4>
                                            <p>Any back within 30 days</p>
                                        </div>
                                    </div>
                                </div>

                                @if($relatedProducts->isNotEmpty())
                                    <div class="widget widget-products">
                                        <div class="title-link-wrapper mb-2">
                                            <h4 class="title title-link font-weight-bold">More Products</h4>
                                        </div>
                                        <div class="swiper nav-top">
                                            <div class="swiper-container swiper-theme nav-top" data-swiper-options="{
                                                'slidesPerView': 1,
                                                'spaceBetween': 20,
                                                'navigation': {
                                                    'prevEl': '.swiper-button-prev',
                                                    'nextEl': '.swiper-button-next'
                                                }
                                            }">
                                                <div class="swiper-wrapper">
                                                    <div class="widget-col swiper-slide">
                                                        @foreach($relatedProducts->take(3) as $sideProduct)
                                                            <div class="product product-widget">
                                                                <figure class="product-media">
                                                                    <a href="{{ route('products.show', $sideProduct) }}">
                                                                        @if($sideProduct->thumbnail)
                                                                            <img src="{{ asset('storage/'.$sideProduct->thumbnail) }}" alt="{{ $sideProduct->name }}" width="100" height="113">
                                                                        @else
                                                                            <div class="w-full h-full flex items-center justify-center bg-gray-100">📦</div>
                                                                        @endif
                                                                    </a>
                                                                </figure>
                                                                <div class="product-details">
                                                                    <h4 class="product-name">
                                                                        <a href="{{ route('products.show', $sideProduct) }}">{{ $sideProduct->name }}</a>
                                                                    </h4>
                                                                    <div class="ratings-container">
                                                                        <div class="ratings-full">
                                                                            <span class="ratings" style="width: {{ $sideProduct->averageRating() * 20 }}%;"></span>
                                                                            <span class="tooltiptext tooltip-top"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="product-price">₦{{ number_format($sideProduct->price, 2) }}</div>
                                                                </div>
                                                             </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </main>
@endsection
