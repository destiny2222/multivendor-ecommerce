<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — @yield('title', config('app.name', 'MarketPlace'))</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700&display=swap">

    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/font-awesome.css') }}">
    <!-- Flag Icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/flag-icon.css') }}">
    <!-- Ico Font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/icofont.css') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/bootstrap.css') }}">
    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/style.css') }}">
</head>

<body>

<div class="page-wrapper">

    {{-- Top Header --}}
    <div class="page-main-header">
        <div class="main-header-right row">
            <div class="main-header-left d-lg-none w-auto">
                <div class="logo-wrapper">
                    <a href="{{ route('admin.dashboard') }}">
                        <span class="f-w-700 f-16 txt-primary">MarketPlace</span>
                    </a>
                </div>
            </div>
            <div class="mobile-sidebar w-auto">
                <div class="media-body text-end switch-sm">
                    <label class="switch">
                        <a href="javascript:void(0)"><i id="sidebar-toggle" data-feather="align-left"></i></a>
                    </label>
                </div>
            </div>
            <div class="nav-right col">
                <ul class="nav-menus">
                    <li>
                        <form class="form-inline search-form" action="{{ route('admin.products.index') }}" method="GET">
                            <div class="form-group">
                                <input class="form-control-plaintext" type="search" name="q" placeholder="Search..">
                                <span class="d-sm-none mobile-search"><i data-feather="search"></i></span>
                            </div>
                        </form>
                    </li>
                    <li>
                        <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()">
                            <i data-feather="maximize-2"></i>
                        </a>
                    </li>
                    <li class="onhover-dropdown">
                        <div class="media align-items-center">
                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white" style="width:40px;height:40px;font-weight:700;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </div>
                            <div class="dotted-animation">
                                <span class="animate-circle"></span>
                                <span class="main-circle"></span>
                            </div>
                        </div>
                        <ul class="profile-dropdown onhover-show-div p-20 profile-dropdown-hover">
                            <li>
                                <a href="{{ route('admin.dashboard') }}">
                                    <i data-feather="home"></i>Dashboard
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 text-dark">
                                        <i data-feather="log-out"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
            </div>
        </div>
    </div>
    {{-- /Top Header --}}

    <div class="page-body-wrapper">

        {{-- Sidebar --}}
        <div class="page-sidebar">
            <div class="main-header-left d-none d-lg-block">
                <div class="logo-wrapper">
                    <a href="{{ route('admin.dashboard') }}">
                        <span class="f-w-700 f-18 p-l-20 txt-primary">MarketPlace</span>
                    </a>
                </div>
            </div>
            <div class="sidebar custom-scrollbar">
                <a href="javascript:void(0)" class="sidebar-back d-lg-none d-block">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
                <div class="sidebar-user">
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white mx-auto mb-2" style="width:60px;height:60px;font-size:22px;font-weight:700;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div>
                        <h6 class="f-14">{{ strtoupper(auth()->user()->name) }}</h6>
                        <p>Administrator</p>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <li>
                        <a class="sidebar-header {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i data-feather="home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a class="sidebar-header {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                            <i data-feather="box"></i>
                            <span>Products</span>
                        </a>
                    </li>

                    <li>
                        <a class="sidebar-header {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                            <i data-feather="list"></i>
                            <span>Categories</span>
                        </a>
                    </li>

                    <li>
                        <a class="sidebar-header {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                            <i data-feather="archive"></i>
                            <span>Orders</span>
                        </a>
                    </li>

                    <li>
                        <a class="sidebar-header {{ request()->routeIs('admin.vendors.*') ? 'active' : '' }}" href="{{ route('admin.vendors.index') }}">
                            <i data-feather="users"></i>
                            <span>Vendors</span>
                        </a>
                    </li>

                    <li>
                        <a class="sidebar-header {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                            <i data-feather="user"></i>
                            <span>Customers</span>
                        </a>
                    </li>

                    <li>
                        <a class="sidebar-header" href="{{ route('home') }}" target="_blank">
                            <i data-feather="external-link"></i>
                            <span>View Store</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        {{-- /Sidebar --}}

        <div class="page-body">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="container-fluid pt-3">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            @endif
            @if(session('error'))
                <div class="container-fluid pt-3">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            @endif

            {{-- Page Header --}}
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>@yield('title', 'Dashboard')
                                    <small>MarketPlace Admin</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}"><i data-feather="home"></i></a>
                                </li>
                                <li class="breadcrumb-item active">@yield('title', 'Dashboard')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /Page Header --}}

            {{-- Main Content --}}
            <div class="container-fluid">
                @yield('content')
            </div>

            {{-- Footer --}}
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 footer-copyright">
                            <p class="mb-0">Copyright &copy; {{ date('Y') }} MarketPlace. All rights reserved.</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <p class="mb-0">Built with Laravel 12</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset('backend/assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
<!-- Feather Icon -->
<script src="{{ asset('backend/assets/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
<!-- Sidebar -->
<script src="{{ asset('backend/assets/js/sidebar-menu.js') }}"></script>
<!-- Lazy load -->
<script src="{{ asset('backend/assets/js/lazysizes.min.js') }}"></script>
<!-- Admin Script -->
<script src="{{ asset('backend/assets/js/admin-script.js') }}"></script>

@stack('scripts')

</body>
</html>
