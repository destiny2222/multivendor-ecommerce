@extends('layouts.main')

@section('title', 'Register — ' . config('app.name'))
@section('body_class', 'login-page')

@section('content')
<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Register</li>
                    </ol>
                </div>
            </nav>
            <h1 class="page-title">Register</h1>
        </div>
    </div>

    <div class="page-content mt-10 pb-10">
        <div class="container">
            <div class="login-popup" style="max-width: 540px; margin: 0 auto;">
                <div class="tab tab-nav-simple tab-nav-boxed form-tab">
                    <ul class="nav nav-tabs nav-fill align-items-center border-0 mb-5" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link lh-1 ls-0" href="{{ route('login') }}">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link active lh-1 ls-0">Register</span>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="name">Full Name *</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="Your full name" required>
                                    @error('name')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="email">Email Address *</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="Your email address" required>
                                    @error('email')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="phone">Phone (optional)</label>
                                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                           class="form-control" placeholder="Your phone number">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">Password *</label>
                                    <input type="password" id="password" name="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="Password" required>
                                    @error('password')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-5">
                                    <label for="password_confirmation">Confirm Password *</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                           class="form-control" placeholder="Confirm password" required>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block btn-rounded">
                                    Create Account
                                </button>
                            </form>

                            <div class="text-center mt-4">
                                <p>Already have an account?
                                    <a href="{{ route('login') }}" class="text-primary">Sign in</a>
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
