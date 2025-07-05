@extends('frontends.layouts.master')
@section('title', 'Documents - Document Management System')

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
                                <i class="fas fa-file-alt text-primary me-2"></i>
                                Browse Documents
                            </h2>
                            <p class="text-muted mb-0">Discover and access our comprehensive document library</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <span class="badge bg-primary fs-6">{{ $documents->total() }} documents available</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-body p-4">
                    <form action="{{ route('frontend.documents') }}" method="GET" class="row g-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text"
                                       class="form-control form-control-custom border-start-0"
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Search documents...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select form-control-custom" name="category">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select form-control-custom" name="sort">
                                <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Date</option>
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                                <option value="author" {{ request('sort') == 'author' ? 'selected' : '' }}>Author</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select form-control-custom" name="order">
                                <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Newest</option>
                                <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Oldest</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary-custom btn-custom w-100">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Documents Grid -->
    <div class="row g-4">
        @forelse($documents as $document)
        <div class="col-lg-4 col-md-6">
            <div class="card card-custom h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-2">
                                <a href="{{ route('frontend.documents.show', $document) }}"
                                   class="text-decoration-none text-dark">
                                    {{ Str::limit($document->name, 50) }}
                                </a>
                            </h5>
                            <p class="text-muted small mb-2">
                                <i class="fas fa-folder me-1"></i>
                                {{ $document->category->name ?? 'Uncategorized' }}
                            </p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-primary">{{ strtoupper($document->file_extension) }}</span>
                        </div>
                    </div>

                    <p class="card-text text-muted mb-3">
                        {{ Str::limit($document->description, 100) }}
                    </p>

                    <div class="row text-center mb-3">
                        <div class="col-4">
                            <div class="text-primary fw-bold">{{ $document->evaluations_count }}</div>
                            <small class="text-muted">Reviews</small>
                        </div>
                        <div class="col-4">
                            <div class="text-success fw-bold">{{ $document->evaluations_count }}</div>
                            <small class="text-muted">Reviews</small>
                        </div>
                        <div class="col-4">
                            <div class="text-warning fw-bold">
                                @if($document->evaluations_count > 0)
                                    {{ number_format($document->evaluations->avg('rating'), 1) }}
                                @else
                                    0.0
                                @endif
                            </div>
                            <small class="text-muted">Rating</small>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="fas fa-user me-1"></i>
                            {{ $document->author }}
                        </small>
                        <small class="text-muted">
                            <i class="fas fa-calendar me-1"></i>
                            {{ $document->created_at_formatted }}
                        </small>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('frontend.documents.show', $document) }}"
                           class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-1"></i>View
                        </a>
                        <a href="{{ route('frontend.documents.download', $document) }}"
                           class="btn btn-success-custom btn-sm">
                            <i class="fas fa-download me-1"></i>Download
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-body text-center p-5">
                    <i class="fas fa-file-alt text-muted" style="font-size: 4rem;"></i>
                    <h4 class="mt-3 text-muted">No documents found</h4>
                    <p class="text-muted">Try adjusting your search criteria or browse all categories.</p>
                    <a href="{{ route('frontend.documents') }}" class="btn btn-primary-custom btn-custom">
                        <i class="fas fa-refresh me-2"></i>Clear Filters
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($documents->hasPages())
    <div class="row mt-4">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-body">
                    <nav aria-label="Document pagination">
                        {{ $documents->appends(request()->query())->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
