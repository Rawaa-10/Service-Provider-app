@extends('layouts.app')

@section('content')
    <h1>Create Category</h1>

    <form action="{{ route('category.store') }}" method="POST">
        @csrf

        <div>
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
            @error('name') <div style="color:red">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="parent_id">Parent Category (optional)</label>
            <select name="parent_id" id="parent_id">
                <option value="">None</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Create</button>
    </form>
@endsection
