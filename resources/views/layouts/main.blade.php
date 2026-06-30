<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'MarketPlace'))</title>

    <meta name="keywords" content="@yield('meta_keywords', 'marketplace ecommerce multi-vendor')">
    <meta name="description" content="@yield('meta_description', 'Your one-stop multi-vendor marketplace.')">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/icons/favicon.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Preload fonts -->
    <link rel="preload" href="{{ asset('assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/fonts/wolmart.woff') }}" as="font" type="font/woff" crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/magnific-popup/magnific-popup.min.css') }}">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/demo2.min.css') }}">

    @stack('styles')
</head>

<body class="@yield('body_class', 'home')">
    <div class="page-wrapper">

        {{-- ============ HEADER ============ --}}
        <header class="header">

            {{-- Header Top --}}
            <div class="header-top">
                <div class="container">
                    <div class="header-left">
                        <p class="welcome-msg">Welcome to {{ config('app.name', 'MarketPlace') }}!</p>
                    </div>
                    <div class="header-right pr-0">
                        <div class="dropdown">
                            <a href="#currency">USD</a>
                            <div class="dropdown-box">
                                <a href="#USD">USD</a>
                                <a href="#EUR">EUR</a>
                            </div>
                        </div>
                        <!-- End of DropDown Menu -->

                        <div class="dropdown">
                            <a href="#language"><img src="{{ asset('assets/images/flags/eng.png') }}" alt="ENG Flag" width="14" height="8" class="dropdown-image"> ENG</a>
                            <div class="dropdown-box">
                                <a href="#ENG">
                                    <img src="{{ asset('assets/images/flags/eng.png') }}" alt="ENG Flag" width="14" height="8" class="dropdown-image">
                                    ENG
                                </a>
                                <a href="#FRA">
                                    <img src="{{ asset('assets/images/flags/fra.png') }}" alt="FRA Flag" width="14" height="8" class="dropdown-image">
                                    FRA
                                </a>
                            </div>
                        </div>
                        <span class="divider d-lg-show"></span>
                        <a href="#" class="d-lg-show">Blog</a>
                        <a href="#" class="d-lg-show">Contact Us</a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="d-lg-show">My Account</a>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline d-lg-show">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 text-inherit sign-in" style="background:none;border:none;cursor:pointer;">
                                    <i class="w-icon-account"></i>Sign Out
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="d-lg-show login sign-in"><i class="w-icon-account"></i>Sign In</a>
                            <span class="delimiter d-lg-show">/</span>
                            <a href="{{ route('register') }}" class="ml-0 d-lg-show login register">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
            {{-- End Header Top --}}

            {{-- Header Middle --}}
            <div class="header-middle">
                <div class="container">
                    <div class="header-left mr-md-4">
                        <a href="{{ route('home') }}" class="mobile-menu-toggle w-icon-hamburger" aria-label="menu-toggle"></a>
                        <a href="{{ route('home') }}" class="logo ml-lg-0">
                            {{-- <img src="{{ asset('assets/images/demos/demo2/header-logo.png') }}" alt="{{ config('app.name') }}" width="144" height="45"> --}}
                        </a>
                        <nav class="main-nav">
                            <ul class="menu">
                                <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
                                    <a href="{{ route('products.index') }}">Shop</a>
                                </li>
                                <li class="{{ request()->routeIs('stores.*') ? 'active' : '' }}">
                                    <a href="#">Vendors</a>
                                </li>
                                @auth
                                    @if(auth()->user()->isVendor() || auth()->user()->isAdmin())
                                        <li>
                                            <a href="{{ route('dashboard') }}">Dashboard</a>
                                        </li>
                                    @endif
                                    @if(auth()->user()->isCustomer())
                                        <li class="{{ request()->routeIs('customer.*') ? 'active' : '' }}">
                                            <a href="{{ route('customer.orders') }}">My Orders</a>
                                        </li>
                                    @endif
                                @endauth
                                @guest
                                    <li>
                                        <a href="{{ route('register') }}?role=vendor">Become a Vendor</a>
                                    </li>
                                @endguest
                            </ul>
                        </nav>
                    </div>

                    <div class="header-right ml-4">
                        @php
                            $cartCount = 0;
                            if (auth()->check()) {
                                $userCart = auth()->user()->cart;
                                $cartCount = $userCart ? $userCart->items()->count() : 0;
                            }
                        @endphp
                        <a class="wishlist label-down link d-xs-show" href="#">
                            <i class="w-icon-heart"></i>
                            <span class="wishlist-label d-lg-show">Wishlist</span>
                        </a>
                        <div class="dropdown cart-dropdown mr-0 mr-lg-2">
                            <div class="cart-overlay"></div>
                            <a href="{{ route('cart.index') }}" class="cart-toggle label-down link">
                                <i class="w-icon-cart">
                                    <span class="cart-count">{{ $cartCount }}</span>
                                </i>
                                <span class="cart-label">Cart</span>
                            </a>
                            <div class="dropdown-box">
                                @if(auth()->check() && $cartCount > 0)
                                    @php $userCart->load('items.product'); @endphp
                                    <div class="products">
                                        @foreach($userCart->items->take(3) as $item)
                                            <div class="product product-cart">
                                                <div class="product-detail">
                                                    <a href="{{ route('products.show', $item->product->slug) }}" class="product-name">
                                                        {{ Str::limit($item->product->name, 30) }}
                                                    </a>
                                                    <div class="price-box">
                                                        <span class="product-quantity">{{ $item->quantity }}</span>
                                                        <span class="product-price">${{ number_format($item->product->price, 2) }}</span>
                                                    </div>
                                                </div>
                                                <figure class="product-media">
                                                    <a href="{{ route('products.show', $item->product->slug) }}">
                                                        @if($item->product->image)
                                                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" width="84" height="94">
                                                        @else
                                                            <img src="{{ asset('assets/images/products/cart/product-1.jpg') }}" alt="{{ $item->product->name }}" width="84" height="94">
                                                        @endif
                                                    </a>
                                                </figure>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="cart-total">
                                        <label>Subtotal:</label>
                                        <span class="price">${{ number_format($userCart->items->sum(fn($i) => $i->quantity * $i->product->price), 2) }}</span>
                                    </div>
                                    <div class="cart-action">
                                        <a href="{{ route('cart.index') }}" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                                        <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-rounded">Checkout</a>
                                    </div>
                                @else
                                    <div class="products text-center p-4">
                                        <p class="text-muted">Your cart is empty.</p>
                                        <a href="{{ route('products.index') }}" class="btn btn-primary btn-rounded mt-2">Shop Now</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Header Middle --}}

            {{-- Header Bottom / Sticky Nav --}}
            <div class="header-bottom sticky-content fix-top sticky-header">
                <div class="container">
                    <div class="inner-wrap">
                        <div class="header-left flex-1">
                            <div class="dropdown category-dropdown has-border" data-visible="true">
                                <a href="#" class="category-toggle" role="button" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="true" data-display="static"
                                   title="Browse Categories">
                                    <i class="w-icon-category"></i>
                                    <span>Browse Categories</span>
                                </a>
                                <div class="dropdown-box">
                                    <ul class="menu vertical-menu category-menu">
                                        @foreach(\App\Models\Category::where('is_active', true)->whereNull('parent_id')->orderBy('sort_order')->get() as $cat)
                                            <li>
                                                <a href="{{ route('products.index', ['category' => $cat->slug]) }}">
                                                    <i class="w-icon-category"></i>{{ $cat->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            
                            <form action="{{ route('products.index') }}" method="GET" class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper mr-4 ml-4">
                                <div class="select-box">
                                    <select id="category" name="category">
                                        <option value="">All Categories</option>
                                        @foreach(\App\Models\Category::where('is_active', true)->whereNull('parent_id')->orderBy('sort_order')->get() as $cat)
                                            <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="text" class="form-control" name="q" value="{{ request('q') }}" placeholder="Search in..." required>
                                <button class="btn btn-search" type="submit">
                                    <i class="w-icon-search"></i>
                                </button>
                            </form>
                        </div>

                        <div class="header-right pr-0 ml-4">
                            <a href="{{ route('home') }}" class="d-xl-show mr-6"><i class="w-icon-map-marker mr-1"></i>Track Order</a>
                            <a href="#"><i class="w-icon-sale"></i>Daily Deals</a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Header Bottom --}}

        </header>
        {{-- End Header --}}

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="container mt-2">
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="container mt-2">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        {{-- Main Content --}}
        <main>
            @yield('content')
        </main>
        {{-- End Main Content --}}

        {{-- ============ FOOTER ============ --}}
        <footer class="footer appear-animate" data-animation-options="{'name': 'fadeIn'}">
            <div class="footer-newsletter bg-primary pt-6 pb-6">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-5 col-lg-6">
                            <div class="icon-box icon-box-side text-white">
                                <div class="icon-box-icon d-inline-flex">
                                    <i class="w-icon-envelop3"></i>
                                </div>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title text-white text-uppercase mb-0">Subscribe To Our Newsletter</h4>
                                    <p class="text-white">Get all the latest information on Events, Sales and Offers.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6 col-md-9 mt-4 mt-lg-0">
                            <form action="#" method="get" class="input-wrapper input-wrapper-inline input-wrapper-rounded">
                                <input type="email" class="form-control mr-2 bg-white" name="email" placeholder="Your E-mail Address">
                                <button class="btn btn-dark btn-rounded" type="submit">Subscribe<i class="w-icon-long-arrow-right"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="footer-top">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="widget widget-about">
                                <a href="{{ route('home') }}" class="logo-footer">
                                    {{-- <img src="{{ asset('assets/images/demos/demo2/footer-logo.png') }}" alt="{{ config('app.name') }}" width="144" height="45"> --}}
                                </a>
                                <div class="widget-body">
                                    <p class="widget-about-title">Got Question? Call us 24/7</p>
                                    <a href="tel:18005707777" class="widget-about-call">1-800-570-7777</a>
                                    <p class="widget-about-desc">Register now to get updates on promotions and exclusive coupons.</p>
                                    <div class="social-icons social-icons-colored">
                                        <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                        <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                        <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                                        <a href="#" class="social-icon social-youtube w-icon-youtube"></a>
                                        <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="widget">
                                <h3 class="widget-title">Company</h3>
                                <ul class="widget-body">
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Careers</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">Affiliate Program</a></li>
                                    <li><a href="{{ route('customer.orders') }}">Order History</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">My Account</h4>
                                <ul class="widget-body">
                                    @auth
                                        <li><a href="{{ route('customer.orders') }}">Track My Order</a></li>
                                        <li><a href="{{ route('cart.index') }}">View Cart</a></li>
                                        <li><a href="{{ route('customer.profile') }}">My Profile</a></li>
                                    @else
                                        <li><a href="{{ route('login') }}">Sign In</a></li>
                                        <li><a href="{{ route('register') }}">Register</a></li>
                                        <li><a href="{{ route('cart.index') }}">View Cart</a></li>
                                    @endauth
                                    <li><a href="#">Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">Customer Service</h4>
                                <ul class="widget-body">
                                    <li><a href="#">Payment Methods</a></li>
                                    <li><a href="#">Money-back Guarantee</a></li>
                                    <li><a href="#">Product Returns</a></li>
                                    <li><a href="#">Support Center</a></li>
                                    <li><a href="#">Shipping Info</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    <div class="footer-left">
                        <p class="copyright">Copyright &copy; {{ date('Y') }} {{ config('app.name', 'MarketPlace') }}. All Rights Reserved.</p>
                    </div>
                    <div class="footer-right">
                        <span class="payment-label mr-lg-8">We use safe payment methods</span>
                        <figure class="payment">
                            <img src="{{ asset('assets/images/payment.png') }}" alt="payment" width="159" height="25">
                        </figure>
                    </div>
                </div>
            </div>
        </footer>
        {{-- End Footer --}}

    </div>
    {{-- End page-wrapper --}}

    {{-- Sticky Footer (mobile) --}}
    <div class="sticky-footer sticky-content fix-bottom">
        <a href="{{ route('home') }}" class="sticky-link {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="w-icon-home"></i>
            <p>Home</p>
        </a>
        <a href="{{ route('products.index') }}" class="sticky-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="w-icon-category"></i>
            <p>Shop</p>
        </a>
        @auth
            <a href="{{ route('dashboard') }}" class="sticky-link">
                <i class="w-icon-account"></i>
                <p>Account</p>
            </a>
        @else
            <a href="{{ route('login') }}" class="sticky-link">
                <i class="w-icon-account"></i>
                <p>Sign In</p>
            </a>
        @endauth
        <a href="{{ route('cart.index') }}" class="sticky-link {{ request()->routeIs('cart.*') ? 'active' : '' }}">
            <i class="w-icon-cart"></i>
            <p>Cart</p>
        </a>
        <div class="header-search hs-toggle dir-up">
            <a href="#" class="search-toggle sticky-link">
                <i class="w-icon-search"></i>
                <p>Search</p>
            </a>
            <form action="{{ route('products.index') }}" class="input-wrapper">
                <input type="text" class="form-control" name="q" autocomplete="off" placeholder="Search products..." required>
                <button class="btn btn-search" type="submit">
                    <i class="w-icon-search"></i>
                </button>
            </form>
        </div>
    </div>
    {{-- End Sticky Footer --}}

    {{-- Scroll Top --}}
    <a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button">
        <i class="w-icon-angle-up"></i>
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
            <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35" r="34"></circle>
        </svg>
    </a>

    {{-- Plugin JS --}}
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery.plugin/jquery.plugin.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery.countdown/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/zoom/jquery.zoom.js') }}"></script>

    {{-- Main JS --}}
    <script src="{{ asset('assets/js/main.min.js') }}"></script>

        <!-- Start of Mobile Menu -->
    <div class="mobile-menu-wrapper">
        <div class="mobile-menu-overlay"></div>
        <!-- End of .mobile-menu-overlay -->

        <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
        <!-- End of .mobile-menu-close -->

        <div class="mobile-menu-container scrollable">
            <form action="#" method="get" class="input-wrapper">
                <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search" required="">
                <button class="btn btn-search" type="submit">
                    <i class="w-icon-search"></i>
                </button>
            </form>
            <!-- End of Search Form -->
            <div class="tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="#main-menu" class="nav-link active">Main Menu</a>
                    </li>
                    <li class="nav-item">
                        <a href="#categories" class="nav-link">Categories</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="main-menu">
                    <ul class="mobile-menu">
                        <li><a href="demo2.html">Home</a></li>
                        <li>
                            <a href="shop-banner-sidebar.html">Shop</a>
                            <ul>
                                <li>
                                    <a href="#">Shop Pages</a>
                                    <ul>
                                        <li><a href="shop-banner-sidebar.html">Banner With Sidebar</a></li>
                                        <li><a href="shop-boxed-banner.html">Boxed Banner</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Full Width Banner</a></li>
                                        <li><a href="shop-horizontal-filter.html">Horizontal Filter<span class="tip tip-hot">Hot</span></a></li>
                                        <li><a href="shop-off-canvas.html">Off Canvas Sidebar<span class="tip tip-new">New</span></a></li>
                                        <li><a href="shop-infinite-scroll.html">Infinite Ajax Scroll</a></li>
                                        <li><a href="shop-right-sidebar.html">Right Sidebar</a></li>
                                        <li><a href="shop-both-sidebar.html">Both Sidebar</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Shop Layouts</a>
                                    <ul>
                                        <li><a href="shop-grid-3cols.html">3 Columns Mode</a></li>
                                        <li><a href="shop-grid-4cols.html">4 Columns Mode</a></li>
                                        <li><a href="shop-grid-5cols.html">5 Columns Mode</a></li>
                                        <li><a href="shop-grid-6cols.html">6 Columns Mode</a></li>
                                        <li><a href="shop-grid-7cols.html">7 Columns Mode</a></li>
                                        <li><a href="shop-grid-8cols.html">8 Columns Mode</a></li>
                                        <li><a href="shop-list.html">List Mode</a></li>
                                        <li><a href="shop-list-sidebar.html">List Mode With Sidebar</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Product Pages</a>
                                    <ul>
                                        <li><a href="product-variable.html">Variable Product</a></li>
                                        <li><a href="product-featured.html">Featured &amp; Sale</a></li>
                                        <li><a href="product-accordion.html">Data In Accordion</a></li>
                                        <li><a href="product-section.html">Data In Sections</a></li>
                                        <li><a href="product-swatch.html">Image Swatch</a></li>
                                        <li><a href="product-extended.html">Extended Info</a>
                                        </li>
                                        <li><a href="product-without-sidebar.html">Without Sidebar</a></li>
                                        <li><a href="product-video.html">360<sup>o</sup> &amp; Video<span class="tip tip-new">New</span></a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Product Layouts</a>
                                    <ul>
                                        <li><a href="product-default.html">Default<span class="tip tip-hot">Hot</span></a></li>
                                        <li><a href="product-vertical.html">Vertical Thumbs</a></li>
                                        <li><a href="product-grid.html">Grid Images</a></li>
                                        <li><a href="product-masonry.html">Masonry</a></li>
                                        <li><a href="product-gallery.html">Gallery</a></li>
                                        <li><a href="product-sticky-info.html">Sticky Info</a></li>
                                        <li><a href="product-sticky-thumb.html">Sticky Thumbs</a></li>
                                        <li><a href="product-sticky-both.html">Sticky Both</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="vendor-dokan-store.html">Vendor</a>
                            <ul>
                                <li>
                                    <a href="#">Store Listing</a>
                                    <ul>
                                        <li><a href="vendor-dokan-store-list.html">Store listing 1</a></li>
                                        <li><a href="vendor-wcfm-store-list.html">Store listing 2</a></li>
                                        <li><a href="vendor-wcmp-store-list.html">Store listing 3</a></li>
                                        <li><a href="vendor-wc-store-list.html">Store listing 4</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Vendor Store</a>
                                    <ul>
                                        <li><a href="vendor-dokan-store.html">Vendor Store 1</a></li>
                                        <li><a href="vendor-wcfm-store-product-grid.html">Vendor Store 2</a></li>
                                        <li><a href="vendor-wcmp-store-product-grid.html">Vendor Store 3</a></li>
                                        <li><a href="vendor-wc-store-product-grid.html">Vendor Store 4</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="blog.html">Blog</a>
                            <ul>
                                <li><a href="blog.html">Classic</a></li>
                                <li><a href="blog-listing.html">Listing</a></li>
                                <li>
                                    <a href="blog-grid.html">Grid</a>
                                    <ul>
                                        <li><a href="blog-grid-2cols.html">Grid 2 columns</a></li>
                                        <li><a href="blog-grid-3cols.html">Grid 3 columns</a></li>
                                        <li><a href="blog-grid-4cols.html">Grid 4 columns</a></li>
                                        <li><a href="blog-grid-sidebar.html">Grid sidebar</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Masonry</a>
                                    <ul>
                                        <li><a href="blog-masonry-2cols.html">Masonry 2 columns</a></li>
                                        <li><a href="blog-masonry-3cols.html">Masonry 3 columns</a></li>
                                        <li><a href="blog-masonry-4cols.html">Masonry 4 columns</a></li>
                                        <li><a href="blog-masonry-sidebar.html">Masonry sidebar</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Mask</a>
                                    <ul>
                                        <li><a href="blog-mask-grid.html">Blog mask grid</a></li>
                                        <li><a href="blog-mask-masonry.html">Blog mask masonry</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="post-single.html">Single Post</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="about-us.html">Pages</a>
                            <ul>

                                <li><a href="about-us.html">About Us</a></li>
                                <li><a href="become-a-vendor.html">Become A Vendor</a></li>
                                <li><a href="contact-us.html">Contact Us</a></li>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="faq.html">FAQs</a></li>
                                <li><a href="error-404.html">Error 404</a></li>
                                <li><a href="coming-soon.html">Coming Soon</a></li>
                                <li><a href="wishlist.html">Wishlist</a></li>
                                <li><a href="cart.html">Cart</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="my-account.html">My Account</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="elements.html">Elements</a>
                            <ul>
                                <li><a href="element-products.html">Products</a></li>
                                <li><a href="element-titles.html">Titles</a></li>
                                <li><a href="element-typography.html">Typography</a></li>
                                <li><a href="element-categories.html">Product Category</a></li>
                                <li><a href="element-buttons.html">Buttons</a></li>
                                <li><a href="element-accordions.html">Accordions</a></li>
                                <li><a href="element-alerts.html">Alert &amp; Notification</a></li>
                                <li><a href="element-tabs.html">Tabs</a></li>
                                <li><a href="element-testimonials.html">Testimonials</a></li>
                                <li><a href="element-blog-posts.html">Blog Posts</a></li>
                                <li><a href="element-instagrams.html">Instagrams</a></li>
                                <li><a href="element-cta.html">Call to Action</a></li>
                                <li><a href="element-vendors.html">Vendors</a></li>
                                <li><a href="element-icon-boxes.html">Icon Boxes</a></li>
                                <li><a href="element-icons.html">Icons</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane" id="categories">
                    <ul class="mobile-menu">
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-tshirt2"></i>Fashion
                            </a>
                            <ul>
                                <li>
                                    <a href="#">Women</a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">New Arrivals</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Best Sellers</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Trending</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Clothing</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Shoes</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Bags</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Accessories</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Jewlery &
                                                Watches</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Men</a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">New Arrivals</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Best Sellers</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Trending</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Clothing</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Shoes</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Bags</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Accessories</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Jewlery &
                                                Watches</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-home"></i>Home & Garden
                            </a>
                            <ul>
                                <li>
                                    <a href="#">Bedroom</a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">Beds, Frames &
                                                Bases</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Dressers</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Nightstands</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Kid's Beds &
                                                Headboards</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Armoires</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Living Room</a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">Coffee Tables</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Chairs</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Tables</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Futons & Sofa
                                                Beds</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Cabinets &
                                                Chests</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Office</a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">Office Chairs</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Desks</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Bookcases</a></li>
                                        <li><a href="shop-fullwidth-banner.html">File Cabinets</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Breakroom
                                                Tables</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Kitchen & Dining</a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">Dining Sets</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Kitchen Storage
                                                Cabinets</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Bashers Racks</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Dining Chairs</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Dining Room
                                                Tables</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Bar Stools</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-electronics"></i>Electronics
                            </a>
                            <ul>
                                <li>
                                    <a href="#">Laptops &amp; Computers</a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">Desktop
                                                Computers</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Monitors</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Laptops</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Hard Drives &amp;
                                                Storage</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Computer
                                                Accessories</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">TV &amp; Video</a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">TVs</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Home Audio
                                                Speakers</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Projectors</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Media Streaming
                                                Devices</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Digital Cameras</a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">Digital SLR
                                                Cameras</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Sports & Action
                                                Cameras</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Camera Lenses</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Photo Printer</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Digital Memory
                                                Cards</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Cell Phones</a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">Carrier Phones</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Unlocked Phones</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Phone & Cellphone
                                                Cases</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Cellphone
                                                Chargers</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-furniture"></i>Furniture
                            </a>
                            <ul>
                                <li>
                                    <a href="#">Furniture</a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">Sofas & Couches</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Armchairs</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Bed Frames</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Beside Tables</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Dressing Tables</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Lighting</a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">Light Bulbs</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Lamps</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Celling Lights</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Wall Lights</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Bathroom
                                                Lighting</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Home Accessories</a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">Decorative
                                                Accessories</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Candals &
                                                Holders</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Home Fragrance</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Mirrors</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Clocks</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Garden & Outdoors</a>
                                    <ul>
                                        <li><a href="shop-fullwidth-banner.html">Garden
                                                Furniture</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Lawn Mowers</a>
                                        </li>
                                        <li><a href="shop-fullwidth-banner.html">Pressure
                                                Washers</a></li>
                                        <li><a href="shop-fullwidth-banner.html">All Garden
                                                Tools</a></li>
                                        <li><a href="shop-fullwidth-banner.html">Outdoor Dining</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-heartbeat"></i>Healthy & Beauty
                            </a>
                        </li>
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-gift"></i>Gift Ideas
                            </a>
                        </li>
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-gamepad"></i>Toy & Games
                            </a>
                        </li>
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-ice-cream"></i>Cooking
                            </a>
                        </li>
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-ios"></i>Smart Phones
                            </a>
                        </li>
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-camera"></i>Cameras & Photo
                            </a>
                        </li>
                        <li>
                            <a href="shop-fullwidth-banner.html">
                                <i class="w-icon-ruby"></i>Accessories
                            </a>
                        </li>
                        <li>
                            <a href="shop-banner-sidebar.html" class="font-weight-bold text-primary text-uppercase ls-25">
                                View All Categories<i class="w-icon-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Mobile Menu -->

    <!-- Start of Newsletter popup -->
    <div class="newsletter-popup mfp-hide">
        <div class="newsletter-content">
            <h4 class="text-uppercase font-weight-normal ls-25">Get Up to<span class="text-primary">25% Off</span></h4>
            <h2 class="ls-25">Sign up to Wolmart</h2>
            <p class="text-light ls-10">Subscribe to the Wolmart market newsletter to
                receive updates on special offers.</p>
            <form action="#" method="get" class="input-wrapper input-wrapper-inline input-wrapper-round">
                <input type="email" class="form-control email font-size-md" name="email" id="email2" placeholder="Your email address" required="">
                <button class="btn btn-dark" type="submit">SUBMIT</button>
            </form>
            <div class="form-checkbox d-flex align-items-center">
                <input type="checkbox" class="custom-checkbox" id="hide-newsletter-popup" name="hide-newsletter-popup" required="">
                <label for="hide-newsletter-popup" class="font-size-sm text-light">Don't show this popup again.</label>
            </div>
        </div>
    </div>
    <!-- End of Newsletter popup -->

    <!-- Start of Quick View -->
    <div class="product product-single product-popup">
        <div class="row gutter-lg">
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="product-gallery product-gallery-sticky">
                    <div class="swiper-container product-single-swiper swiper-theme nav-inner">
                        <div class="swiper-wrapper row cols-1 gutter-no">
                            <div class="swiper-slide">
                                <figure class="product-image">
                                    <img src="assets/images/products/popup/1-440x494.jpg" data-zoom-image="assets/images/products/popup/1-800x900.jpg" alt="Water Boil Black Utensil" width="800" height="900">
                                </figure>
                            </div>
                            <div class="swiper-slide">
                                <figure class="product-image">
                                    <img src="assets/images/products/popup/2-440x494.jpg" data-zoom-image="assets/images/products/popup/2-800x900.jpg" alt="Water Boil Black Utensil" width="800" height="900">
                                </figure>
                            </div>
                            <div class="swiper-slide">
                                <figure class="product-image">
                                    <img src="assets/images/products/popup/3-440x494.jpg" data-zoom-image="assets/images/products/popup/3-800x900.jpg" alt="Water Boil Black Utensil" width="800" height="900">
                                </figure>
                            </div>
                            <div class="swiper-slide">
                                <figure class="product-image">
                                    <img src="assets/images/products/popup/4-440x494.jpg" data-zoom-image="assets/images/products/popup/4-800x900.jpg" alt="Water Boil Black Utensil" width="800" height="900">
                                </figure>
                            </div>
                        </div>
                        <button class="swiper-button-next"></button>
                        <button class="swiper-button-prev"></button>
                    </div>
                    <div class="product-thumbs-wrap swiper-container" data-swiper-options="{
                        'navigation': {
                            'nextEl': '.swiper-button-next',
                            'prevEl': '.swiper-button-prev'
                        }
                    }">
                        <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm">
                            <div class="product-thumb swiper-slide">
                                <img src="assets/images/products/popup/1-103x116.jpg" alt="Product Thumb" width="103" height="116">
                            </div>
                            <div class="product-thumb swiper-slide">
                                <img src="assets/images/products/popup/2-103x116.jpg" alt="Product Thumb" width="103" height="116">
                            </div>
                            <div class="product-thumb swiper-slide">
                                <img src="assets/images/products/popup/3-103x116.jpg" alt="Product Thumb" width="103" height="116">
                            </div>
                            <div class="product-thumb swiper-slide">
                                <img src="assets/images/products/popup/4-103x116.jpg" alt="Product Thumb" width="103" height="116">
                            </div>
                        </div>
                        <button class="swiper-button-next"></button>
                        <button class="swiper-button-prev"></button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 overflow-hidden p-relative">
                <div class="product-details scrollable pl-0">
                    <h2 class="product-title">Electronics Black Wrist Watch</h2>
                    <div class="product-bm-wrapper">
                        <figure class="brand">
                            <img src="assets/images/products/brand/brand-1.jpg" alt="Brand" width="102" height="48">
                        </figure>
                        <div class="product-meta">
                            <div class="product-categories">
                                Category:
                                <span class="product-category"><a href="#">Electronics</a></span>
                            </div>
                            <div class="product-sku">
                                SKU: <span>MS46891340</span>
                            </div>
                        </div>
                    </div>

                    <hr class="product-divider">

                    <div class="product-price">$40.00</div>

                    <div class="ratings-container">
                        <div class="ratings-full">
                            <span class="ratings" style="width: 80%;"></span>
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <a href="#" class="rating-reviews">(3 Reviews)</a>
                    </div>

                    <div class="product-short-desc">
                        <ul class="list-type-check list-style-none">
                            <li>Ultrices eros in cursus turpis massa cursus mattis.</li>
                            <li>Volutpat ac tincidunt vitae semper quis lectus.</li>
                            <li>Aliquam id diam maecenas ultricies mi eget mauris.</li>
                        </ul>
                    </div>

                    <hr class="product-divider">

                    <div class="product-form product-variation-form product-color-swatch">
                        <label>Color:</label>
                        <div class="d-flex align-items-center product-variations">
                            <a href="#" class="color" style="background-color: #ffcc01"></a>
                            <a href="#" class="color" style="background-color: #ca6d00;"></a>
                            <a href="#" class="color" style="background-color: #1c93cb;"></a>
                            <a href="#" class="color" style="background-color: #ccc;"></a>
                            <a href="#" class="color" style="background-color: #333;"></a>
                        </div>
                    </div>
                    <div class="product-form product-variation-form product-size-swatch">
                        <label class="mb-1">Size:</label>
                        <div class="flex-wrap d-flex align-items-center product-variations">
                            <a href="#" class="size">Small</a>
                            <a href="#" class="size">Medium</a>
                            <a href="#" class="size">Large</a>
                            <a href="#" class="size">Extra Large</a>
                        </div>
                        <a href="#" class="product-variation-clean">Clean All</a>
                    </div>

                    <div class="product-variation-price">
                        <span></span>
                    </div>

                    <div class="product-form">
                        <div class="product-qty-form">
                            <div class="input-group">
                                <input class="quantity form-control" type="number" min="1" max="10000000">
                                <button class="quantity-plus w-icon-plus"></button>
                                <button class="quantity-minus w-icon-minus"></button>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-cart">
                            <i class="w-icon-cart"></i>
                            <span>Add to Cart</span>
                        </button>
                    </div>

                    <div class="social-links-wrapper">
                        <div class="social-links">
                            <div class="social-icons social-no-color border-thin">
                                <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                <a href="#" class="social-icon social-pinterest fab fa-pinterest-p"></a>
                                <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                                <a href="#" class="social-icon social-youtube fab fa-linkedin-in"></a>
                            </div>
                        </div>
                        <span class="divider d-xs-show"></span>
                        <div class="product-link-wrapper d-flex">
                            <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"><span></span></a>
                            <a href="#" class="btn-product-icon btn-compare btn-icon-left w-icon-compare"><span></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Quick view -->

    @stack('scripts')
</body>

</html>
