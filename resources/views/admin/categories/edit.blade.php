@extends('layouts.master')

@section('title', 'Edit Category')

@section('content')
<div class="row">
    <div class="col-sm-12 col-xl-6">
        <div class="card">
            <div class="card-header">
                <h5>Edit Category</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                    @csrf @method('PUT')

                    <div class="form-group mb-3">
                        <label class="col-form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $category->name) }}" required class="form-control">
                        @error('name')
                            <p class="text-danger f-12 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="col-form-label">Parent Category</label>
                        <select name="parent_id" class="form-control">
                            <option value="">None (Top-level)</option>
                            @foreach($parentCategories as $cat)
                                <option value="{{ $cat->id }}" {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="col-form-label">Description</label>
                        <textarea name="description" rows="3" class="form-control">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <div class="form-group mb-4">
                        <div class="form-check">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" id="is_active"
                                {{ old('is_active', $category->is_active) ? 'checked' : '' }} class="form-check-input">
                            <label for="is_active" class="form-check-label">Active</label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Category</button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
