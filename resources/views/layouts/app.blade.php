<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'MarketPlace'))</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-900">

<nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">MarketPlace</a>
                <a href="{{ route('products.index') }}" class="text-sm text-gray-600 hover:text-indigo-600">Products</a>
            </div>

            <div class="flex-1 max-w-md mx-8 hidden md:block">
                <form action="{{ route('products.index') }}" method="GET">
                    <input type="text" name="q" value="{{ request('q') }}"
                        placeholder="Search products..."
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </form>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('cart.index') }}" class="relative text-gray-600 hover:text-indigo-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </a>

                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 text-sm text-gray-700 hover:text-indigo-600">
                            <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white text-xs font-semibold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </div>
                            <span class="hidden md:block">{{ auth()->user()->name }}</span>
                        </button>
                        <div x-show="open" @click.outside="open = false" x-cloak
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-1 z-50">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Dashboard</a>
                            @if(auth()->user()->isCustomer())
                                <a href="{{ route('customer.orders') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">My Orders</a>
                                <a href="{{ route('customer.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Profile</a>
                            @endif
                            <hr class="my-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-indigo-600">Login</a>
                    <a href="{{ route('register') }}" class="text-sm bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

@if(session('success'))
    <div class="bg-green-50 border-b border-green-200 px-4 py-3 text-sm text-green-800 text-center">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-50 border-b border-red-200 px-4 py-3 text-sm text-red-800 text-center">
        {{ session('error') }}
    </div>
@endif

<main>
    @yield('content')
</main>

<footer class="bg-white border-t border-gray-200 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="font-bold text-lg text-indigo-600 mb-3">MarketPlace</h3>
                <p class="text-sm text-gray-500">Your one-stop multi-vendor marketplace for the best products.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-3">Quick Links</h4>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li><a href="{{ route('home') }}" class="hover:text-indigo-600">Home</a></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-indigo-600">Products</a></li>
                    <li><a href="{{ route('register') }}?role=vendor" class="hover:text-indigo-600">Become a Vendor</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-3">Account</h4>
                <ul class="space-y-2 text-sm text-gray-500">
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="hover:text-indigo-600">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="hover:text-indigo-600">Login</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-indigo-600">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
        <div class="mt-8 pt-8 border-t border-gray-100 text-center text-sm text-gray-400">
            &copy; {{ date('Y') }} MarketPlace. All rights reserved.
        </div>
    </div>
</footer>

</body>
</html>
