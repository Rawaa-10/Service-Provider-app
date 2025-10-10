@extends('layouts.app')

@section('title', 'Services Management')

@section('content')
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Services Management</h3>
                        <a href="{{ route('services.create') }}" class="btn btn-primary btn-sm">Add New Service</a>
                    </div>

                    <div class="card-body">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($services->count())
                            <div class="table-responsive">
                                <table class="table table-striped table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Service Name</th>
                                            <th>Slug</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Category</th>
                                            <th>Provider Name</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($services as $index => $service)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $service->title }}</td>
                                                <td>{{ $service->slug }}</td>
                                                <td>{{ Str::limit($service->description, 50) }}</td>
                                                <td>{{ $service->price }}</td>
                                                <td>
                                                    @if($service->is_active == true)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif </td>
                                                <td>{{ $service->category->name ?? '—' }}</td>
                                                <td>{{ $service->user->name ?? '—' }}</td>
                                                <td>{{ $service->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <a href="{{ route('services.show', $service) }}"
                                                        class="btn btn-sm btn-outline-primary">View</a>
                                                    <a href="{{ route('services.edit', $service->id) }}"
                                                        class="btn btn-sm btn-outline-warning">Edit</a>
                                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                {{ $services->links() }}
                                </div>
                            </div>
                        @else
                            <p class="text-muted">No services found.</p>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
    
@endsection


{{-- <!-- TODO: Create a responsive table to display services -->

<!-- Table headers: ID, Name, Description, Provider, Category, Price, Status, Actions -->

<!-- TODO: Loop through $services collection using @forelse -->
<!-- TODO: Display service information in table rows -->
<!-- TODO: Add status management dropdown for each service -->
<!-- TODO: Add view action button for each service -->
<!-- TODO: Handle empty services collection with @empty --> --}}