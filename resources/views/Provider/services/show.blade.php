@extends('layouts.app')

@section('title', 'Service Details')

@section('content')
<div class="container-fluid my-4">
    <div class="row">
        <div class="col-12">

            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-light">
                    <h3 class="card-title mb-0">Service Details</h3>
                    <a href="{{ route('services.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Back to List
                    </a>
                </div>

                <div class="card-body">
                    <div class="row g-4">

                        <div class="col-md-6">
                            <div class="border rounded p-3">
                                <h6 class="mb-1 text-muted">Service Name</h6>
                                <p class="mb-0 fw-bold">{{ $service->title ?? '—' }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded p-3">
                                <h6 class="mb-1 text-muted">Slug</h6>
                                <p class="mb-0 fw-bold">{{ $service->slug ?? '—' }}</p>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="border rounded p-3">
                                <h6 class="mb-1 text-muted">Description</h6>
                                <p class="mb-0">{{ $service->description ?? 'No description available.' }}</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="border rounded p-3">
                                <h6 class="mb-1 text-muted">Price</h6>
                                <p class="mb-0 fw-bold">${{ number_format($service->price, 2) }}</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="border rounded p-3">
                                <h6 class="mb-1 text-muted">Status</h6>
                                @if($service->is_active == true)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="border rounded p-3">
                                <h6 class="mb-1 text-muted">Created At</h6>
                                <p class="mb-0">{{ optional($service->created_at)->format('Y-m-d') ?? '—' }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded p-3">
                                <h6 class="mb-1 text-muted">Category</h6>
                                <p class="mb-0 fw-bold">{{ $service->category->name ?? '—' }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded p-3">
                                <h6 class="mb-1 text-muted">Provider</h6>
                                <p class="mb-0 fw-bold">{{ $service->user->name ?? '—' }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
