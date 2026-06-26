@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Category List</h5>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary pull-right">
                    <i data-feather="plus"></i> Add Category
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table all-package">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Parent</th>
                                <th scope="col">Products</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->parent?->name ?? '—' }}</td>
                                    <td class="digits">{{ $category->products_count }}</td>
                                    <td>
                                        @if($category->is_active)
                                            <span class="order-success digits">Active</span>
                                        @else
                                            <span class="order-cancle digits">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary btn-xs me-2">
                                            <i data-feather="edit-2"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No categories yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">{{ $categories->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
