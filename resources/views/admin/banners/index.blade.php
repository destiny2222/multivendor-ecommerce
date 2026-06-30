@extends('layouts.master')

@section('title', 'Banners')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4 class="card-title mb-0">Banner List</h4>
                <a href="{{ route('admin.banners.create') }}" class="btn btn-primary btn-sm">
                    <iconify-icon icon="solar:plus-circle-bold-duotone" class="align-middle me-1 fs-16"></iconify-icon> Add Banner
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                        <thead class="bg-light bg-opacity-50">
                            <tr>
                                <th class="ps-3" scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Subtitle</th>
                                <th scope="col">Price Info</th>
                                <th scope="col">Position</th>
                                <th scope="col">Sort Order</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($banners as $banner)
                                <tr>
                                    <td class="ps-3">{{ $loop->iteration }}</td>
                                    <td>
                                        @if($banner->image)
                                            @if(str_starts_with($banner->image, 'assets/'))
                                                <img src="{{ asset($banner->image) }}" alt="Banner" width="60" class="img-thumbnail rounded">
                                            @else
                                                <img src="{{ asset('upload/banners/'.$banner->image) }}" alt="Banner" width="60" class="img-thumbnail rounded">
                                            @endif
                                        @else
                                            <div style="width:60px;height:40px;background-color:#ccc" class="rounded"></div>
                                        @endif
                                    </td>
                                    <td class="fw-semibold text-dark">{{ $banner->title ?? 'No Title' }}</td>
                                    <td>{{ $banner->subtitle ?? 'No Subtitle' }}</td>
                                    <td><span class="text-secondary fw-medium">{{ $banner->price_info ?? '' }}</span></td>
                                    <td>
                                        @if($banner->position === 'home_left')
                                            <span class="badge bg-primary-subtle text-primary">Home Left (Dark)</span>
                                        @else
                                            <span class="badge bg-info-subtle text-info">Home Right (Light)</span>
                                        @endif
                                    </td>
                                    <td>{{ $banner->sort_order }}</td>
                                    <td>
                                        @if($banner->is_active)
                                            <span class="badge bg-success-subtle text-success">Active</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-sm btn-soft-primary" title="Edit">
                                                <iconify-icon icon="solar:pen-bold-duotone" class="fs-16"></iconify-icon>
                                            </a>
                                            <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this banner?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-soft-danger" title="Delete">
                                                    <iconify-icon icon="solar:trash-bin-trash-bold-duotone" class="fs-16"></iconify-icon>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4 text-muted">No banners registered yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($banners->hasPages())
                    <div class="card-footer bg-transparent border-top">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="text-muted mb-0 fs-13">Showing {{ $banners->firstItem() }} to {{ $banners->lastItem() }} of {{ $banners->total() }} banners</p>
                            <div>{{ $banners->links() }}</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
