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
                            <img src="{{ asset('assets/images/demos/demo2/header-logo.png') }}" alt="{{ config('app.name') }}" width="144" height="45">
                        </a>
                    </div>

                    <div class="header-center">
                        <div class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper">
                            <form action="{{ route('products.index') }}" method="GET" class="input-wrapper">
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
                        </div>

                        <div class="header-center">
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

                        <div class="header-right">
                            <a href="{{ route('home') }}" class="d-flex align-items-center font-weight-bold ls-25 text-dark">
                                <i class="w-icon-map-marker mr-1 font-size-xl"></i>
                                <span class="d-none d-xl-block font-weight-normal">Track Order</span>
                            </a>
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
                                    <img src="{{ asset('assets/images/demos/demo2/footer-logo.png') }}" alt="{{ config('app.name') }}" width="144" height="45">
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

    @stack('scripts')
</body>

</html>
