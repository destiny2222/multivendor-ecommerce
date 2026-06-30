<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function showRegisterForm(): View
    {
        return view('vendor.auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:20'],
            'store_name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role' => 'vendor',
            'password' => Hash::make($validated['password']),
        ]);

        $slug = Str::slug($validated['store_name']);
        if (Store::where('slug', $slug)->exists()) {
            $slug .= '-'.strtolower(Str::random(5));
        }

        $user->store()->create([
            'name' => $validated['store_name'],
            'slug' => $slug,
            'status' => 'pending',
        ]);

        Auth::guard('web')->login($user);

        return redirect()->route('vendor.dashboard');
    }
}
