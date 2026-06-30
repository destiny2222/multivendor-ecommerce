@extends('layouts.main')

@section('title', 'Home — ' . config('app.name', 'MarketPlace'))

@section('content')
    <main class="main">

        {{-- ============ HERO SLIDER ============ --}}
        <div class="intro-section">
            <div class="swiper-container swiper-theme nav-inner pg-inner animation-slider nav-xxl-show nav-hide"
                data-swiper-options="{
                    'slidesPerView': 1,
                    'autoplay': {
                        'delay': 4000,
                        'disableOnInteraction': false
                    }
                }">
                <div class="swiper-wrapper row gutter-no cols-1">
                    @foreach ($sliders as $index => $slider)
                        <div class="swiper-slide banner banner-fixed intro-slide intro-slide{{ $index + 1 }}"
                            style="background-image: url({{ $slider->background_image ? asset('upload/sliders/' . $slider->background_image) : '' }}); background-color: {{ $slider->background_color ?? '#f1f0f0' }};">
                            <div class="container">
                                <figure class="slide-image floating-item slide-animate"
                                    data-animation-options="{'name': 'fadeInDownShorter', 'duration': '1s'}">
                                    @if ($slider->image)
                                        <img src="{{ asset('upload/sliders/' . $slider->image) }}" alt="Slide Image">
                                    @else
                                        {{-- Fallbacks for seed data --}}
                                        @if ($index === 0)
                                            <img src="{{ asset('assets/images/demos/demo2/slides/ski.png') }}"
                                                alt="Ski" width="729" height="570">
                                        @elseif($index === 1)
                                            <img src="{{ asset('assets/images/demos/demo2/slides/woman.png') }}"
                                                alt="Fashion" width="865" height="732">
                                        @else
                                            <img src="{{ asset('assets/images/demos/demo2/slides/man.png') }}"
                                                alt="Deals" width="527" height="481">
                                        @endif
                                    @endif
                                </figure>
                                <div
                                    class="banner-content {{ $slider->alignment === 'right' ? 'text-right ml-auto y-50' : 'y-50' }}">
                                    @if ($slider->subtitle)
                                        <h5 class="banner-subtitle text-uppercase font-weight-bold mb-2 slide-animate"
                                            data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1s'}">
                                            {{ $slider->subtitle }}
                                        </h5>
                                    @endif
                                    @if ($slider->title)
                                        <h3 class="banner-title ls-25 mb-{{ $slider->description ? '2 text-uppercase lh-1' : '6' }} slide-animate"
                                            data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1s'}">
                                            {!! $slider->title !!}
                                        </h3>
                                    @endif
                                    @if ($slider->description)
                                        <p class="font-weight-normal text-dark ls-25 slide-animate mb-4"
                                            data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '0.5s'}">
                                            {{ $slider->description }}
                                        </p>
                                    @endif
                                    @if ($slider->button_text)
                                        <a href="{{ $slider->button_link ?? '#' }}"
                                            class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate"
                                            data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1s'}">
                                            {{ $slider->button_text }}<i class="w-icon-long-arrow-right"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <button class="swiper-button-next"></button>
                <button class="swiper-button-prev"></button>
            </div>
        </div>
        {{-- End Hero Slider --}}

        <div class="container">
            <div class="swiper-container swiper-theme icon-box-wrapper appear-animate br-sm mt-6 mb-10"
                data-swiper-options="{
                    'loop': true,
                    'slidesPerView': 1,
                    'autoplay': {
                        'delay': 4000,
                        'disableOnInteraction': false
                    },
                    'breakpoints': {
                        '576': {
                            'slidesPerView': 2
                        },
                        '768': {
                            'slidesPerView': 3
                        },
                        '1200': {
                            'slidesPerView': 4
                        }
                    }
                }">
                <div class="swiper-wrapper row cols-md-4 cols-sm-3 cols-1">
                    <div class="swiper-slide icon-box icon-box-side text-dark">
                        <span class="icon-box-icon icon-shipping">
                            <i class="w-icon-truck"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">Free Shipping & Returns</h4>
                            <p class="text-default">For all orders over $99</p>
                        </div>
                    </div>
                    <div class="swiper-slide icon-box icon-box-side text-dark">
                        <span class="icon-box-icon icon-payment">
                            <i class="w-icon-bag"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">Secure Payment</h4>
                            <p class="text-default">We ensure secure payment</p>
                        </div>
                    </div>
                    <div class="swiper-slide icon-box icon-box-side text-dark icon-box-money">
                        <span class="icon-box-icon icon-money">
                            <i class="w-icon-money"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">Money Back Guarantee</h4>
                            <p class="text-default">Any back within 30 days</p>
                        </div>
                    </div>
                    <div class="swiper-slide icon-box icon-box-side text-dark icon-box-chat">
                        <span class="icon-box-icon icon-chat">
                            <i class="w-icon-chat"></i>
                        </span>
                        <div class="icon-box-content">
                            <h4 class="icon-box-title">Customer Support</h4>
                            <p class="text-default">Call or email us 24/7</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Iocn Box Wrapper -->

             <div class="title-link-wrapper mb-2 appear-animate">
                <h2 class="title">Top Rated Products</h2>
                <a href="shop-boxed-banner.html" class="font-weight-bold ls-25">More Products<i
                        class="w-icon-long-arrow-right"></i></a>
            </div>

            <div class="swiper-container swiper-theme top-products mb-6 appear-animate"
                data-swiper-options="{
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
                            'slidesPerView': 5
                        }
                    }
                }">
                <div class="swiper-wrapper row cols-lg-5 cols-md-4 cols-sm-3 cols-2">
                    @foreach($topRatedProducts as $product)
                        <div class="swiper-slide product-wrap">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="{{ route('products.show', $product) }}">
                                        @if($product->thumbnail)
                                            <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->name }}" width="300"
                                                height="338">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-4xl text-gray-300 py-5" style="background: #f3f3f3; min-height: 200px;">📦</div>
                                        @endif
                                    </a>
                                    <div class="product-label-group">
                                        @if($product->hasDiscount())
                                            <label class="product-label label-discount">-{{ $product->discountPercentage() }}%</label>
                                        @else
                                            <label class="product-label label-new">New</label>
                                        @endif
                                    </div>
                                    <div class="product-action-vertical">
                                        @if($product->isInStock())
                                            <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart" style="background: none; border: none; padding: 0; outline: none;"></button>
                                            </form>
                                        @endif
                                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                            title="Add to wishlist"></a>
                                        <a href="{{ route('products.show', $product) }}" class="btn-product-icon btn-quickview w-icon-search"
                                            title="Quickview"></a>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h4>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: {{ $product->averageRating() * 20 }}%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="{{ route('products.show', $product) }}" class="rating-reviews">({{ $product->reviews()->where('is_approved', true)->count() }} Reviews)</a>
                                    </div>
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
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <!-- End of Swiper Container -->

            <div class="title-link-wrapper mb-3 appear-animate">
                <h2 class="title title-deals mb-1">Deals Of The Day</h2>
                <div class="product-countdown-container font-size-sm text-dark align-items-center">
                    <label>Offer Ends in: </label>
                    <div class="product-countdown countdown-compact ml-1 font-weight-bold" data-until="+10d"
                        data-relative="true" data-compact="true">10days,00:00:00</div>
                </div>
                <a href="{{ route('products.index') }}" class="font-weight-bold ls-25">More Products<i
                        class="w-icon-long-arrow-right"></i></a>
            </div>
            <!-- End of .title-link-wrapper -->

            <div class="swiper-container swiper-theme product-deals-wrapper appear-animate mb-7"
                data-swiper-options="{
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
                            'slidesPerView': 5
                        }
                    }
                }">
                <div class="swiper-wrapper row cols-lg-5 cols-md-4 cols-2">
                    @foreach($dealProducts as $product)
                        <div class="swiper-slide product-wrap">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="{{ route('products.show', $product) }}">
                                        @if($product->thumbnail)
                                            <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->name }}" width="300"
                                                height="338">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-4xl text-gray-300 py-5" style="background: #f3f3f3; min-height: 200px;">📦</div>
                                        @endif
                                    </a>
                                    <div class="product-action-vertical">
                                        @if($product->isInStock())
                                            <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart" style="background: none; border: none; padding: 0; outline: none;"></button>
                                            </form>
                                        @endif
                                        <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                            title="Add to wishlist"></a>
                                        <a href="{{ route('products.show', $product) }}" class="btn-product-icon btn-quickview w-icon-search"
                                            title="Quickview"></a>
                                    </div>
                                    <div class="product-label-group">
                                        @if($product->hasDiscount())
                                            <label class="product-label label-discount">-{{ $product->discountPercentage() }}%</label>
                                        @else
                                            <label class="product-label label-new">New</label>
                                        @endif
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <h4 class="product-name"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h4>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: {{ $product->averageRating() * 20 }}%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="{{ route('products.show', $product) }}" class="rating-reviews">({{ $product->reviews()->where('is_approved', true)->count() }} Reviews)</a>
                                    </div>
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
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <!-- End of Product Deals Wrapper -->

            <div class="row category-wrapper electronics-cosmetics appear-animate mb-7">
                @php
                    $leftBanner = $banners->where('position', 'home_left')->first();
                    $rightBanner = $banners->where('position', 'home_right')->first();
                @endphp

                <!-- Left Banner -->
                <div class="col-md-6 mb-4">
                    <div class="banner banner-fixed br-sm">
                        <figure>
                            @if($leftBanner && $leftBanner->image)
                                @if(str_starts_with($leftBanner->image, 'assets/'))
                                    <img src="{{ asset($leftBanner->image) }}" alt="Category Banner" width="640" height="200" style="background-color: #25282D;">
                                @else
                                    <img src="{{ asset('upload/banners/'.$leftBanner->image) }}" alt="Category Banner" width="640" height="200" style="background-color: #25282D;">
                                @endif
                            @else
                                <img src="{{ asset('assets/images/demos/demo2/categories/1-1.jpg') }}" alt="Category Banner" width="640" height="200" style="background-color: #25282D;">
                            @endif
                        </figure>
                        <div class="banner-content y-50">
                            <h3 class="banner-title text-white ls-25 mb-0">{{ $leftBanner->title ?? 'Electronics' }}</h3>
                            <div class="banner-price-info text-white font-weight-bold text-uppercase mb-1">
                                {{ $leftBanner->subtitle ?? 'Starting At' }}
                                <strong class="text-secondary">{{ $leftBanner->price_info ?? '₦125,000.00' }}</strong>
                            </div>
                            <hr class="banner-divider bg-white">
                            <a href="{{ $leftBanner->button_link ?? '#' }}" class="btn btn-white btn-link btn-underline btn-icon-right">
                                Shop Now<i class="w-icon-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Banner -->
                <div class="col-md-6 mb-4">
                    <div class="banner banner-fixed br-sm">
                        <figure>
                            @if($rightBanner && $rightBanner->image)
                                @if(str_starts_with($rightBanner->image, 'assets/'))
                                    <img src="{{ asset($rightBanner->image) }}" alt="Category Banner" width="640" height="200" style="background-color: #eeedec;">
                                @else
                                    <img src="{{ asset('upload/banners/'.$rightBanner->image) }}" alt="Category Banner" width="640" height="200" style="background-color: #eeedec;">
                                @endif
                            @else
                                <img src="{{ asset('assets/images/demos/demo2/categories/1-2.jpg') }}" alt="Category Banner" width="640" height="200" style="background-color: #eeedec;">
                            @endif
                        </figure>
                        <div class="banner-content y-50">
                            <h3 class="banner-title ls-25 text-capitalize mb-0">{{ $rightBanner->title ?? 'Cosmetics Sets' }}</h3>
                            <div class="banner-price-info font-weight-bold text-uppercase mb-1">
                                {{ $rightBanner->subtitle ?? 'Sale Up To' }}
                                <strong class="text-secondary">{{ $rightBanner->price_info ?? '30% Off' }}</strong>
                            </div>
                            <hr class="banner-divider bg-dark">
                            <a href="{{ $rightBanner->button_link ?? '#' }}" class="btn btn-dark btn-link btn-underline btn-icon-right">
                                Shop Now<i class="w-icon-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Category Wrapper -->

            <h2 class="title mb-5 appear-animate">Top Weekly Vendors</h2>
            <div class="swiper-container swiper-theme vendor-wrapper mb-7 appear-animate"
                data-swiper-options="{
                    'spaceBetween': 20,
                    'slidesPerView': 1,
                    'breakpoints': {
                        '576': {
                            'slidesPerView': 2
                        },
                        '768': {
                            'slidesPerView': 3
                        },
                        '1200': {
                            'slidesPerView': 4
                        }
                    }
                }">
                <div class="swiper-wrapper row cols-lg-4 cols-md-3 cols-sm-2 cols-1">
                    @foreach($featuredStores as $store)
                        @php
                            $storeProducts = $store->products()->where('status', 'active')->limit(3)->get();
                            $avgRating = $storeProducts->avg(function($p) { return $p->averageRating(); }) ?? 5.0;
                        @endphp
                        <div class="swiper-slide vendor-widget vendor-widget-1">
                            <div class="vendor-products grid-type">
                                @foreach($storeProducts as $pIndex => $p)
                                    <div class="vendor-product {{ $pIndex === 0 ? 'lg-item' : 'sm-item' }}">
                                        <figure class="product-media">
                                            <a href="{{ route('products.show', $p) }}">
                                                @if($p->thumbnail)
                                                    <img src="{{ asset('storage/'.$p->thumbnail) }}" alt="Vendor Product"
                                                        width="300" height="338">
                                                @else
                                                    <div style="background-color:#eee; height:100px; display:flex; align-items:center; justify-content:center;">📦</div>
                                                @endif
                                            </a>
                                        </figure>
                                    </div>
                                @endforeach
                                @for($i = count($storeProducts); $i < 3; $i++)
                                    <div class="vendor-product {{ $i === 0 ? 'lg-item' : 'sm-item' }}">
                                        <div style="background-color:#f9f9f9; width:100%; height:100%; min-height:100px; display:flex; align-items:center; justify-content:center; border:1px dashed #ddd;" class="rounded">
                                            <span class="text-muted fs-11">No Product</span>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <div class="vendor-details">
                                <figure class="vendor-logo">
                                    <a href="{{ route('stores.show', $store) }}">
                                        @if($store->logo)
                                            <img src="{{ asset('storage/' . $store->logo) }}" alt="Vendor Logo" width="70" height="70" class="rounded-circle">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($store->name) }}&background=f1f0f0&color=333&bold=true" alt="Vendor Logo" width="70" height="70" class="rounded-circle">
                                        @endif
                                    </a>
                                </figure>
                                <div class="vendor-personal">
                                    <h4 class="vendor-name">
                                        <a href="{{ route('stores.show', $store) }}">{{ $store->name }}</a>
                                    </h4>
                                    <span class="vendor-product-count">({{ $store->products_count }} Products)</span>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: {{ $avgRating * 20 }}%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
           

            <div class="tab tab-with-title tab-nav-boxed appear-animate">
                <h2 class="title">Consumer Electronics</h2>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tab-1">New Arrivals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-2">Best Seller</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-3">Most Popular</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index', ['category' => $electronicsCategory?->slug ?? 'electronics']) }}">View All</a>
                    </li>
                </ul>
            </div>
            <!-- End of Tab Title-->

            
            <div class="tab-content appear-animate">
                <!-- Tab 1: New Arrivals -->
                <div class="tab-pane active" id="tab-1">
                    <div class="row grid-type products">
                        @forelse($electronicsNew as $index => $product)
                            <div class="product-wrap {{ $index === 0 ? 'lg-item' : 'sm-item' }}">
                                <div class="product text-center">
                                    <figure class="product-media">
                                        <a href="{{ route('products.show', $product) }}">
                                            @if($product->thumbnail)
                                                <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->name }}" width="300" height="338">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-4xl text-gray-300 py-5" style="background: #f3f3f3; min-height: 200px;">📦</div>
                                            @endif
                                        </a>
                                        <div class="product-action-vertical">
                                            @if($product->isInStock())
                                                <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button type="submit" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart" style="background: none; border: none; padding: 0; outline: none;"></button>
                                                </form>
                                            @endif
                                            <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                                            <a href="{{ route('products.show', $product) }}" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a>
                                        </div>
                                        <div class="product-label-group">
                                            @if($product->hasDiscount())
                                                <label class="product-label label-discount">-{{ $product->discountPercentage() }}%</label>
                                            @else
                                                <label class="product-label label-new">New</label>
                                            @endif
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <h4 class="product-name"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: {{ $product->averageRating() * 20 }}%;"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <a href="{{ route('products.show', $product) }}" class="rating-reviews">({{ $product->reviews()->where('is_approved', true)->count() }} Reviews)</a>
                                        </div>
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
                        @empty
                            <div class="col-12 py-5 text-center text-muted">No products in this category yet.</div>
                        @endforelse
                    </div>
                </div>

                <!-- Tab 2: Best Seller -->
                <div class="tab-pane" id="tab-2">
                    <div class="row grid-type products">
                        @forelse($electronicsBest as $index => $product)
                            <div class="product-wrap {{ $index === 0 ? 'lg-item' : 'sm-item' }}">
                                <div class="product text-center">
                                    <figure class="product-media">
                                        <a href="{{ route('products.show', $product) }}">
                                            @if($product->thumbnail)
                                                <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->name }}" width="300" height="338">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-4xl text-gray-300 py-5" style="background: #f3f3f3; min-height: 200px;">📦</div>
                                            @endif
                                        </a>
                                        <div class="product-action-vertical">
                                            @if($product->isInStock())
                                                <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button type="submit" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart" style="background: none; border: none; padding: 0; outline: none;"></button>
                                                </form>
                                            @endif
                                            <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                                            <a href="{{ route('products.show', $product) }}" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a>
                                        </div>
                                        <div class="product-label-group">
                                            @if($product->hasDiscount())
                                                <label class="product-label label-discount">-{{ $product->discountPercentage() }}%</label>
                                            @else
                                                <label class="product-label label-new">New</label>
                                            @endif
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <h4 class="product-name"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: {{ $product->averageRating() * 20 }}%;"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <a href="{{ route('products.show', $product) }}" class="rating-reviews">({{ $product->reviews()->where('is_approved', true)->count() }} Reviews)</a>
                                        </div>
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
                        @empty
                            <div class="col-12 py-5 text-center text-muted">No products in this category yet.</div>
                        @endforelse
                    </div>
                </div>

                <!-- Tab 3: Most Popular -->
                <div class="tab-pane" id="tab-3">
                    <div class="row grid-type products">
                        @forelse($electronicsPopular as $index => $product)
                            <div class="product-wrap {{ $index === 0 ? 'lg-item' : 'sm-item' }}">
                                <div class="product text-center">
                                    <figure class="product-media">
                                        <a href="{{ route('products.show', $product) }}">
                                            @if($product->thumbnail)
                                                <img src="{{ asset('storage/'.$product->thumbnail) }}" alt="{{ $product->name }}" width="300" height="338">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-4xl text-gray-300 py-5" style="background: #f3f3f3; min-height: 200px;">📦</div>
                                            @endif
                                        </a>
                                        <div class="product-action-vertical">
                                            @if($product->isInStock())
                                                <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button type="submit" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart" style="background: none; border: none; padding: 0; outline: none;"></button>
                                                </form>
                                            @endif
                                            <a href="#" class="btn-product-icon btn-wishlist w-icon-heart" title="Add to wishlist"></a>
                                            <a href="{{ route('products.show', $product) }}" class="btn-product-icon btn-quickview w-icon-search" title="Quickview"></a>
                                        </div>
                                        <div class="product-label-group">
                                            @if($product->hasDiscount())
                                                <label class="product-label label-discount">-{{ $product->discountPercentage() }}%</label>
                                            @else
                                                <label class="product-label label-new">New</label>
                                            @endif
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <h4 class="product-name"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: {{ $product->averageRating() * 20 }}%;"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <a href="{{ route('products.show', $product) }}" class="rating-reviews">({{ $product->reviews()->where('is_approved', true)->count() }} Reviews)</a>
                                        </div>
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
                        @empty
                            <div class="col-12 py-5 text-center text-muted">No products in this category yet.</div>
                        @endforelse
                    </div>
                </div>
            </div>
            <!-- End of Tab Content -->      
        </div> 


        </div>

        {{-- End .container --}}


    </main>
@endsection
