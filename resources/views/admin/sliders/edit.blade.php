@extends('layouts.admin')

@section('title', 'Edit Slide')

@section('content')
<div class="row">
    <div class="col-sm-12 col-xl-8">
        <div class="card">
            <div class="card-header">
                <h5>Edit Slide</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.sliders.update', $slider) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="col-form-label">Title (HTML allowed)</label>
                            <input type="text" name="title" value="{{ old('title', $slider->title) }}" class="form-control">
                            @error('title')<p class="text-danger f-12 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label class="col-form-label">Subtitle</label>
                            <input type="text" name="subtitle" value="{{ old('subtitle', $slider->subtitle) }}" class="form-control">
                        </div>

                        <div class="col-md-12 form-group mb-3">
                            <label class="col-form-label">Description</label>
                            <textarea name="description" rows="2" class="form-control">{{ old('description', $slider->description) }}</textarea>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label class="col-form-label">Foreground Image</label>
                            <input type="file" name="image" class="form-control">
                            @if($slider->image)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($slider->image) }}" width="100" class="img-thumbnail">
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label class="col-form-label">Background Image</label>
                            <input type="file" name="background_image" class="form-control">
                            @if($slider->background_image)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($slider->background_image) }}" width="100" class="img-thumbnail">
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label class="col-form-label">Background Color (e.g. #f1f0f0)</label>
                            <input type="text" name="background_color" value="{{ old('background_color', $slider->background_color) }}" class="form-control">
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label class="col-form-label">Text Alignment</label>
                            <select name="alignment" class="form-control">
                                <option value="left" {{ old('alignment', $slider->alignment) == 'left' ? 'selected' : '' }}>Left</option>
                                <option value="center" {{ old('alignment', $slider->alignment) == 'center' ? 'selected' : '' }}>Center</option>
                                <option value="right" {{ old('alignment', $slider->alignment) == 'right' ? 'selected' : '' }}>Right</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label class="col-form-label">Button Text</label>
                            <input type="text" name="button_text" value="{{ old('button_text', $slider->button_text) }}" class="form-control">
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label class="col-form-label">Button Link</label>
                            <input type="text" name="button_link" value="{{ old('button_link', $slider->button_link) }}" class="form-control">
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label class="col-form-label">Sort Order</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', $slider->sort_order) }}" class="form-control" min="0">
                        </div>

                        <div class="col-md-6 form-group mb-4 mt-md-4">
                            <div class="form-check mt-3">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" id="is_active"
                                    {{ old('is_active', $slider->is_active) ? 'checked' : '' }} class="form-check-input">
                                <label for="is_active" class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Slide</button>
                        <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
