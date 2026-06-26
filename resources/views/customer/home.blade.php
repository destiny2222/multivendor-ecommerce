@extends('layouts.main')

@section('title', 'Home — ' . config('app.name', 'MarketPlace'))

@section('content')
<main class="main">

    {{-- ============ HERO SLIDER ============ --}}
    <div class="intro-section">
        <div class="swiper-container swiper-theme nav-inner pg-inner animation-slider nav-xxl-show nav-hide" data-swiper-options="{
            'slidesPerView': 1,
            'autoplay': {
                'delay': 4000,
                'disableOnInteraction': false
            }
        }">
            <div class="swiper-wrapper row gutter-no cols-1">
                <div class="swiper-slide banner banner-fixed intro-slide intro-slide1"
                     style="background-image: url({{ asset('assets/images/demos/demo2/slides/slide-1.jpg') }}); background-color: #f1f0f0;">
                    <div class="container">
                        <figure class="slide-image floating-item slide-animate"
                                data-animation-options="{'name': 'fadeInDownShorter', 'duration': '1s'}">
                            <img src="{{ asset('assets/images/demos/demo2/slides/ski.png') }}" alt="Ski" width="729" height="570">
                        </figure>
                        <div class="banner-content text-right y-50 ml-auto">
                            <h5 class="banner-subtitle text-uppercase font-weight-bold mb-2 slide-animate"
                                data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1s'}">
                                Deals And Promotions
                            </h5>
                            <h3 class="banner-title ls-25 mb-6 slide-animate"
                                data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1s'}">
                                Top Products <span class="text-primary">At The Best Prices</span> From Verified Vendors
                            </h3>
                            <a href="{{ route('products.index') }}"
                               class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate"
                               data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1s'}">
                                Shop Now<i class="w-icon-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide banner banner-fixed intro-slide intro-slide2"
                     style="background-image: url({{ asset('assets/images/demos/demo2/slides/slide-2.jpg') }}); background-color: #d9ddd9;">
                    <div class="container">
                        <figure class="slide-image floating-item slide-animate"
                                data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1s'}">
                            <img src="{{ asset('assets/images/demos/demo2/slides/woman.png') }}" alt="Fashion" width="865" height="732">
                        </figure>
                        <div class="banner-content y-50">
                            <h5 class="banner-subtitle text-uppercase font-weight-bold mb-2 slide-animate"
                                data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.5s'}">
                                New Arrivals
                            </h5>
                            <h3 class="banner-title ls-25 mb-2 text-uppercase lh-1 slide-animate"
                                data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.7s'}">
                                Latest Collections
                            </h3>
                            <div class="banner-price-info font-weight-bold text-dark ls-25 slide-animate"
                                 data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.9s'}">
                                Shop from <span class="text-primary font-weight-bolder text-uppercase ls-normal">Top Vendors</span>
                            </div>
                            <p class="font-weight-normal text-default ls-25 slide-animate"
                               data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '1.1s'}">
                                Free returns extended to 30 days after delivery
                            </p>
                            <a href="{{ route('products.index') }}"
                               class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate"
                               data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '1.3s'}">
                                Shop Now<i class="w-icon-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide banner banner-fixed intro-slide intro-slide3"
                     style="background-image: url({{ asset('assets/images/demos/demo2/slides/slide-3.jpg') }}); background-color: #d0cfcb;">
                    <div class="container">
                        <figure class="slide-image floating-item slide-animate"
                                data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s'}">
                            <img src="{{ asset('assets/images/demos/demo2/slides/man.png') }}" alt="Deals" width="527" height="481">
                        </figure>
                        <div class="banner-content y-50">
                            <h5 class="banner-subtitle text-uppercase font-weight-bold slide-animate"
                                data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s'}">
                                Top Monthly Sellers
                            </h5>
                            <h4 class="banner-title ls-25 slide-animate"
                                data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s'}">
                                Best Deals From <span class="text-primary">Verified Stores</span> This Month
                            </h4>
                            <p class="font-weight-normal text-dark slide-animate"
                               data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s'}">
                                Only until the end of this week.
                            </p>
                            <a href="{{ route('products.index') }}"
                               class="btn btn-dark btn-outline btn-rounded btn-icon-right slide-animate"
                               data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s'}">
                                Shop Now<i class="w-icon-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <button class="swiper-button-next"></button>
            <button class="swiper-button-prev"></button>
        </div>
    </div>
    {{-- End Hero Slider --}}

    <div class="container">

        {{-- ============ FEATURES ============ --}}
        <div class="swiper-container swiper-theme icon-box-wrapper appear-animate br-sm mt-6 mb-10" data-swiper-options="{
            'loop': true,
            'slidesPerView': 1,
            'autoplay': {'delay': 4000, 'disableOnInteraction': false},
            'breakpoints': {
                '576': {'slidesPerView': 2},
                '768': {'slidesPerView': 3},
                '1200': {'slidesPerView': 4}
            }
        }">
            <div class="swiper-wrapper row cols-md-4 cols-sm-3 cols-1">
                <div class="swiper-slide icon-box icon-box-side text-dark">
                    <span class="icon-box-icon"><i class="w-icon-truck"></i></span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title">Free Shipping & Returns</h4>
                        <p class="text-default">For all orders over $99</p>
                    </div>
                </div>
                <div class="swiper-slide icon-box icon-box-side text-dark">
                    <span class="icon-box-icon"><i class="w-icon-bag"></i></span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title">Secure Payment</h4>
                        <p class="text-default">We ensure secure payment</p>
                    </div>
                </div>
                <div class="swiper-slide icon-box icon-box-side text-dark">
                    <span class="icon-box-icon"><i class="w-icon-money"></i></span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title">Money Back Guarantee</h4>
                        <p class="text-default">Any back within 30 days</p>
                    </div>
                </div>
                <div class="swiper-slide icon-box icon-box-side text-dark">
                    <span class="icon-box-icon"><i class="w-icon-chat"></i></span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title">Customer Support</h4>
                        <p class="text-default">Call or email us 24/7</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Features --}}

        {{-- ============ CATEGORIES ============ --}}
        @if($categories->isNotEmpty())
        <div class="title-link-wrapper mb-4 appear-animate">
            <h2 class="title">Shop by Category</h2>
            <a href="{{ route('products.index') }}" class="font-weight-bold ls-25">
                All Categories<i class="w-icon-long-arrow-right"></i>
            </a>
        </div>

        <div class="swiper-container swiper-theme appear-animate mb-8" data-swiper-options="{
            'spaceBetween': 20,
            'slidesPerView': 2,
            'breakpoints': {
                '480': {'slidesPerView': 3},
                '768': {'slidesPerView': 5},
                '992': {'slidesPerView': 7},
                '1200': {'slidesPerView': 8}
            }
        }">
            <div class="swiper-wrapper row">
                @foreach($categories as $category)
                    <div class="swiper-slide text-center">
                        <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                           class="category-wrap appear-animate">
                            <div class="category d-flex flex-column align-items-center">
                                <figure class="category-media">
                                    @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}"
                                             alt="{{ $category->name }}" width="105" height="105">
                                    @else
                                        <img src="{{ asset('assets/images/demos/demo2/categories/1.jpg') }}"
                                             alt="{{ $category->name }}" width="105" height="105">
                                    @endif
                                </figure>
                                <div class="category-content">
                                    <h4 class="category-name">{{ $category->name }}</h4>
                                    <span class="category-count">{{ $category->products_count }} items</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination mt-4"></div>
        </div>
        @endif
        {{-- End Categories --}}

        {{-- ============ FEATURED PRODUCTS ============ --}}
        @if($featuredProducts->isNotEmpty())
        <div class="title-link-wrapper mb-3 appear-animate">
            <h2 class="title title-deals mb-1">Featured Products</h2>
            <a href="{{ route('products.index') }}" class="font-weight-bold ls-25">
                More Products<i class="w-icon-long-arrow-right"></i>
            </a>
        </div>

        <div class="swiper-container swiper-theme appear-animate mb-7" data-swiper-options="{
            'spaceBetween': 20,
            'slidesPerView': 2,
            'breakpoints': {
                '576': {'slidesPerView': 3},
                '768': {'slidesPerView': 4},
                '992': {'slidesPerView': 5}
            }
        }">
            <div class="swiper-wrapper row cols-lg-5 cols-md-4 cols-2">
                @foreach($featuredProducts as $product)
                    <div class="swiper-slide product-wrap">
                        <div class="product text-center">
                            <figure class="product-media">
                                <a href="{{ route('products.show', $product->slug) }}">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                             alt="{{ $product->name }}" width="300" height="338">
                                    @else
                                        <img src="{{ asset('assets/images/demos/demo2/products/1-2.jpg') }}"
                                             alt="{{ $product->name }}" width="300" height="338">
                                    @endif
                                </a>
                                <div class="product-action-vertical">
                                    <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn-product-icon btn-cart w-icon-cart" title="Add to cart"></button>
                                    </form>
                                    <a href="{{ route('products.show', $product->slug) }}"
                                       class="btn-product-icon btn-quickview w-icon-search" title="View details"></a>
                                </div>
                                @if($product->created_at->diffInDays() < 30)
                                    <div class="product-label-group">
                                        <label class="product-label label-new">New</label>
                                    </div>
                                @endif
                            </figure>
                            <div class="product-details">
                                <h4 class="product-name">
                                    <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                </h4>
                                @if($product->store)
                                    <div class="product-cat text-muted">
                                        <a href="{{ route('stores.show', $product->store->slug) }}">{{ $product->store->name }}</a>
                                    </div>
                                @endif
                                <div class="product-price">
                                    <ins class="new-price">${{ number_format($product->price, 2) }}</ins>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="swiper-button-next"></button>
            <button class="swiper-button-prev"></button>
        </div>
        @endif
        {{-- End Featured Products --}}

        {{-- ============ TOP STORES ============ --}}
        @if($featuredStores->isNotEmpty())
        <div class="title-link-wrapper mb-4 appear-animate">
            <h2 class="title">Top Stores</h2>
        </div>

        <div class="row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2 appear-animate mb-8">
            @foreach($featuredStores as $store)
                <div class="col">
                    <a href="{{ route('stores.show', $store->slug) }}"
                       class="vendor-wrap vendor text-center appear-animate">
                        <div class="vendor-logo">
                            <i class="w-icon-store" style="font-size: 3rem; color: #336699;"></i>
                        </div>
                        <div class="vendor-details">
                            <h4 class="vendor-name">{{ $store->name }}</h4>
                            <p class="text-muted">{{ $store->products_count }} products</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        @endif
        {{-- End Top Stores --}}

        {{-- ============ BECOME A VENDOR CTA ============ --}}
        @guest
        <div class="banner appear-animate mb-10 bg-primary text-white text-center p-10 br-sm">
            <h3 class="banner-title text-white mb-3">Start Selling Today</h3>
            <p class="text-white mb-5">Join thousands of vendors and reach millions of customers.</p>
            <a href="{{ route('register') }}" class="btn btn-white btn-rounded btn-outline">
                Become a Vendor<i class="w-icon-long-arrow-right"></i>
            </a>
        </div>
        @endguest

    </div>
    {{-- End .container --}}

</main>
@endsection
