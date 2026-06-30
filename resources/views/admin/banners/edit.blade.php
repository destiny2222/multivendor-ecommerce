@extends('layouts.master')

@section('title', 'Edit Banner')

@section('content')
<div class="row">
    <div class="col-sm-12 col-xl-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Edit Banner</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.banners.update', $banner) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="col-form-label">Title</label>
                            <input type="text" name="title" value="{{ old('title', $banner->title) }}" class="form-control">
                            @error('title')<p class="text-danger fs-12 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label class="col-form-label">Subtitle</label>
                            <input type="text" name="subtitle" value="{{ old('subtitle', $banner->subtitle) }}" class="form-control">
                            @error('subtitle')<p class="text-danger fs-12 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label class="col-form-label">Price / Promo Info (e.g. 30% Off or Starting At $120.00)</label>
                            <input type="text" name="price_info" value="{{ old('price_info', $banner->price_info) }}" class="form-control">
                            @error('price_info')<p class="text-danger fs-12 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label class="col-form-label">Banner Image</label>
                            <input type="file" name="image" class="form-control">
                            <div class="mt-2">
                                <label class="fs-13 text-muted">Current Image:</label><br>
                                @if($banner->image)
                                    @if(str_starts_with($banner->image, 'assets/'))
                                        <img src="{{ asset($banner->image) }}" alt="Banner" width="100" class="img-thumbnail rounded">
                                    @else
                                        <img src="{{ asset('upload/banners/'.$banner->image) }}" alt="Banner" width="100" class="img-thumbnail rounded">
                                    @endif
                                @else
                                    <span class="text-muted fs-13">No image uploaded</span>
                                @endif
                            </div>
                            @error('image')<p class="text-danger fs-12 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label class="col-form-label">Button Link</label>
                            <input type="text" name="button_link" value="{{ old('button_link', $banner->button_link) }}" class="form-control">
                            @error('button_link')<p class="text-danger fs-12 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label class="col-form-label">Position Spot</label>
                            <select name="position" class="form-select">
                                <option value="home_left" {{ old('position', $banner->position) === 'home_left' ? 'selected' : '' }}>Home Left (Dark Style)</option>
                                <option value="home_right" {{ old('position', $banner->position) === 'home_right' ? 'selected' : '' }}>Home Right (Light Style)</option>
                            </select>
                            @error('position')<p class="text-danger fs-12 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label class="col-form-label">Sort Order</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', $banner->sort_order) }}" class="form-control" min="0">
                            @error('sort_order')<p class="text-danger fs-12 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="col-md-6 form-group mb-4 mt-md-4">
                            <div class="form-check mt-3">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" id="is_active"
                                    {{ old('is_active', $banner->is_active) ? 'checked' : '' }} class="form-check-input">
                                <label for="is_active" class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">Update Banner</button>
                        <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
