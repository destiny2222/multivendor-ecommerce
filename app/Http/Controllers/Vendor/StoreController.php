<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function edit(): View
    {
        $store = auth()->user()->store;

        return view('vendor.store', compact('store'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateStore($request);
        $validated['slug'] = Str::slug($validated['name']).'-'.auth()->id();

        auth()->user()->store()->create($validated);

        return redirect()->route('vendor.dashboard')->with('success', 'Store created successfully!');
    }

    public function update(Request $request): RedirectResponse
    {
        $store = auth()->user()->store;
        abort_if(! $store, 404);

        $validated = $this->validateStore($request);
        $store->update($validated);

        return back()->with('success', 'Store updated successfully.');
    }

    private function validateStore(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email'],
            'address' => ['nullable', 'string'],
        ]);
    }
}
