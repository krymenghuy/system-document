@extends('frontends.layouts.master')
@section('title', 'Document Categories - Document Management System')

@section('content')
<div class="container-fluid p-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h2 class="mb-2">
                                <i class="fas fa-folder text-primary me-2"></i>
                                Document Categories
                            </h2>
                            <p class="text-muted mb-0">Browse documents by category to find what you need</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <span class="badge bg-primary fs-6">{{ $categories->count() }} categories available</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Grid -->
    <div class="row g-4">
        @forelse($categories as $category)
        <div class="col-lg-4 col-md-6">
            <div class="card card-custom h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-2">
                                <a href="{{ route('frontend.categories.show', $category) }}"
                                   class="text-decoration-none text-dark">
                                    {{ $category->name }}
                                </a>
                            </h5>
                            <p class="text-muted small mb-2">
                                <i class="fas fa-file-alt me-1"></i>
                                {{ $category->documents_count }} documents
                            </p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-primary">{{ $category->documents_count }}</span>
                        </div>
                    </div>

                    <p class="card-text text-muted mb-3">
                        {{ Str::limit($category->description ?? 'No description available.', 100) }}
                    </p>

                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="fas fa-calendar me-1"></i>
                            Created {{ $category->created_at ? $category->created_at->format('M d, Y') : 'N/A' }}
                        </small>
                        <a href="{{ route('frontend.categories.show', $category) }}"
                           class="btn btn-primary-custom btn-sm">
                            <i class="fas fa-eye me-1"></i>Browse
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-body text-center p-5">
                    <i class="fas fa-folder text-muted" style="font-size: 4rem;"></i>
                    <h4 class="mt-3 text-muted">No categories found</h4>
                    <p class="text-muted">Categories will appear here once they are created.</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Category Statistics -->
    @if($categories->count() > 0)
    <div class="row mt-5">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-body p-4">
                    <h5 class="mb-4">
                        <i class="fas fa-chart-pie text-info me-2"></i>
                        Category Overview
                    </h5>
                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                            <div class="text-primary fw-bold fs-4">{{ $categories->count() }}</div>
                            <small class="text-muted">Total Categories</small>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="text-success fw-bold fs-4">{{ $categories->sum('documents_count') }}</div>
                            <small class="text-muted">Total Documents</small>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="text-warning fw-bold fs-4">
                                {{ $categories->avg('documents_count') > 0 ? number_format($categories->avg('documents_count'), 1) : 0 }}
                            </div>
                            <small class="text-muted">Avg Documents/Category</small>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="text-info fw-bold fs-4">
                                {{ $categories->where('documents_count', 0)->count() }}
                            </div>
                            <small class="text-muted">Empty Categories</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
