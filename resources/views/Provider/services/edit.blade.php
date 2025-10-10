@extends('layouts.app')

@section('title', 'Edit Service')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Service</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>There were some errors:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="title">Service Title</label>
            <input type="text" name="title" id="title" class="form-control"
                value="{{ old('title', $service->title) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="slug">Slug (Optional)</label>
            <input type="text" name="slug" id="slug" class="form-control"
                   value="{{ old('slug', $service->slug) }}">
        </div>

        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"
                      rows="4">{{ old('description', $service->description) }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" step="0.01" class="form-control"
                   value="{{ old('price', $service->price) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $service->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-4">
            <label for="is_active">Status</label>
            <select name="is_active" id="is_active" class="form-control" required>
                <option value="1" {{ old('is_active', $service->is_active) == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('is_active', $service->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Service</button>
        <a href="{{ route('services.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
