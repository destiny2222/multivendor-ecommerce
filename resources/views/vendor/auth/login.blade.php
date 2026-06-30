@extends('layouts.main')

@section('title', 'Vendor Sign In — ' . config('app.name'))
@section('body_class', 'login-page')

@section('content')
<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Vendor Sign In</li>
                    </ol>
                </div>
            </nav>
            <h1 class="page-title">Vendor Portal</h1>
        </div>
    </div>

    <div class="page-content mt-10 pb-10">
        <div class="container">
            <div class="login-popup" style="max-width: 480px; margin: 0 auto;">
                <div class="tab tab-nav-simple tab-nav-boxed form-tab">
                    <ul class="nav nav-tabs nav-fill align-items-center border-0 mb-5" role="tablist">
                        <li class="nav-item">
                            <span class="nav-link active lh-1 ls-0">Vendor Sign In</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link lh-1 ls-0" href="{{ route('vendor.register') }}">Become a Vendor</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active">
                            <form method="POST" action="{{ route('vendor.login') }}">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="email">Email Address *</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="Your email address" required autofocus>
                                    @error('email')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-5">
                                    <label for="password">Password *</label>
                                    <input type="password" id="password" name="password"
                                           class="form-control" placeholder="Password" required>
                                </div>

                                <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                                    <label class="checkbox mb-0">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="checkmark"></span>
                                        Remember me
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block btn-rounded">
                                    Sign In to Vendor Dashboard
                                </button>
                            </form>

                            <div class="text-center mt-4">
                                <p>Not a vendor?
                                    <a href="{{ route('vendor.register') }}" class="text-primary">Apply to sell with us</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
