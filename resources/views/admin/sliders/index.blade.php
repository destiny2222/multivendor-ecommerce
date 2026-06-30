@extends('layouts.master')

@section('title', 'Sliders')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Slider List</h5>
                <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary pull-right">
                    <i data-feather="plus"></i> Add Slide
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table all-package">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Sort Order</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sliders as $slider)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($slider->background_image)
                                            <img src="{{ asset('upload/sliders/'.$slider->background_image) }}" alt="BG" width="60" class="img-thumbnail">
                                        @else
                                            <div style="width:60px;height:40px;background-color:{{ $slider->background_color ?? '#ccc' }}"></div>
                                        @endif
                                    </td>
                                    <td>{{ strip_tags($slider->title ?? 'No title') }}</td>
                                    <td class="digits">{{ $slider->sort_order }}</td>
                                    <td>
                                        @if($slider->is_active)
                                            <span class="order-success digits">Active</span>
                                        @else
                                            <span class="order-cancle digits">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.sliders.edit', $slider) }}" class="btn btn-primary btn-xs me-2">
                                            <i data-feather="edit-2"></i>
                                        </a>
                                        <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this slide?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No slides yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">{{ $sliders->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
