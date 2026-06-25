<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VendorController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::where('role', 'vendor')->with('store');

        if ($request->filled('status') && $request->status !== 'all') {
            $query->whereHas('store', fn ($q) => $q->where('status', $request->status));
        }

        $vendors = $query->latest()->paginate(15);

        return view('admin.vendors.index', compact('vendors'));
    }

    public function show(User $user): View
    {
        abort_if($user->role !== 'vendor', 404);

        $user->load('store.products');

        return view('admin.vendors.show', compact('user'));
    }

    public function updateStatus(Request $request, User $user): RedirectResponse
    {
        abort_if($user->role !== 'vendor', 404);

        $request->validate(['status' => ['required', 'in:pending,active,suspended']]);

        $user->store?->update(['status' => $request->status]);

        return back()->with('success', 'Vendor status updated.');
    }

    public function destroy(User $user): RedirectResponse
    {
        abort_if($user->role !== 'vendor', 404);
        $user->delete();

        return redirect()->route('admin.vendors.index')->with('success', 'Vendor deleted.');
    }
}
