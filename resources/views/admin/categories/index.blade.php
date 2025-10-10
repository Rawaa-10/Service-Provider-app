{{-- @extends('layouts.app')

@section('content')
    <h1>Categories</h1>

    <a href="{{ route('category.create') }}" class="btn btn-primary">Add New Category</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(isset($categories) && $categories->count())
        <ul>
            @foreach($categories as $cat)
                <li>
                    <strong>{{ $cat->name }}</strong>
                    @if(optional($cat->parent)->name)
                        (Child of: {{ $cat->parent->name }})
                    @endif
                    <div>
                        <a href="{{ route('category.show', $cat->id) }}">View</a> |
                        <a href="{{ route('category.update', $cat->id) }}">Update</a> |
                        <form action="{{ route('category.destroy', $cat->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p>No categories found.</p>
    @endif
@endsection --}}



@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Categories</h1>

    <a href="{{ route('category.create') }}" class="btn btn-primary mb-3">Add New Category</a>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(isset($categories) && $categories->count())
        <div class="list-group">
            @foreach($categories as $cat)
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">{{ $cat->name }}</h5>
                        @if(optional($cat->parent)->name)
                            <small class="text-muted">Child of: {{ $cat->parent->name }}</small>
                        @endif
                    </div>
                    <div class="btn-group" role="group" aria-label="Category Actions">
                        <a href="{{ route('category.show', $cat->id) }}" class="btn btn-outline-primary btn-sm">View</a>
                        <a href="{{ route('category.edit', $cat->id) }}" class="btn btn-outline-warning btn-sm">Update</a>
                        <form action="{{ route('category.destroy', $cat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">No categories found.</p>
    @endif
</div>
@endsection
