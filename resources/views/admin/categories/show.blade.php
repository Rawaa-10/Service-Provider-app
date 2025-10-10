{{-- @extends('layouts.app')

@section('content')
    <h1>Category Details</h1>

    <p><strong>Name:</strong> {{ $category->name }}</p>

    @if($category->parent)
        <p><strong>Parent:</strong> {{ $category->parent->name }}</p>
    @else
        <p><strong>Parent:</strong> None</p>
    @endif

    <a href="{{ route('category.index') }}">Back to list</a>
@endsection --}}


@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Category Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $category->name }}</h5>
            <p class="card-text">
                <strong>Parent:</strong> 
                @if($category->parent)
                    {{ $category->parent->name }}
                @else
                    <span class="text-muted">None</span>
                @endif
            </p>
        </div>
    </div>

    <a href="{{ route('category.index') }}" class="btn btn-secondary mt-3">Back to list</a>
</div>
@endsection
