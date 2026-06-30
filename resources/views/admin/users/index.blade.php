@extends('layouts.master')

@section('title', 'Customers')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Customer List</h5>
                <form class="pull-right d-flex gap-2" method="GET">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by name or email..." class="form-control form-control-sm">
                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table all-package">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Joined</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="f-w-600">{{ $user->name }}</td>
                                    <td class="digits">{{ $user->email }}</td>
                                    <td class="digits">{{ $user->phone ?? '—' }}</td>
                                    <td class="digits">{{ $user->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this user?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No customers found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">{{ $users->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
