@extends('frontends.layouts.master')
@section('title', $category->name . ' - Document Management System')

@section('content')
<div class="container-fluid p-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.name') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('frontend.categories') }}">Categories</a></li>
            <li class="breadcrumb-item active">{{ $category->name }}</li>
        </ol>
    </nav>

    <!-- Category Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-2">
                                <i class="fas fa-folder text-primary me-2"></i>
                                {{ $category->name }}
                            </h2>
                            <p class="text-muted mb-3">{{ $category->description ?? 'No description available.' }}</p>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-primary me-2">{{ $documents->total() }} documents</span>
                                <span class="text-muted small">
                                    <i class="fas fa-calendar me-1"></i>
                                    Created {{ $category->created_at ? $category->created_at->format('F d, Y') : 'N/A' }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <a href="{{ route('frontend.documents') }}?category={{ $category->id }}"
                               class="btn btn-primary-custom btn-custom">
                                <i class="fas fa-search me-2"></i>Search in Category
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Documents in Category -->
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
                                    {{ Str::limit($document->title, 50) }}
                                </a>
                            </h5>
                            <p class="text-muted small mb-2">
                                <i class="fas fa-user me-1"></i>
                                {{ $document->user->name }}
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
                            <div class="text-primary fw-bold">{{ $document->evaluations_count ?? 0 }}</div>
                            <small class="text-muted">Reviews</small>
                        </div>
                        <div class="col-4">
                            <div class="text-success fw-bold">{{ $document->evaluations_count ?? 0 }}</div>
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
                            <i class="fas fa-calendar me-1"></i>
                            {{ $document->created_at ? $document->created_at->format('M d, Y') : 'N/A' }}
                        </small>
                        <div class="d-flex gap-2">
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
        </div>
        @empty
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-body text-center p-5">
                    <i class="fas fa-file-alt text-muted" style="font-size: 4rem;"></i>
                    <h4 class="mt-3 text-muted">No documents in this category</h4>
                    <p class="text-muted">Documents will appear here once they are added to this category.</p>
                    <a href="{{ route('frontend.documents') }}" class="btn btn-primary-custom btn-custom">
                        <i class="fas fa-search me-2"></i>Browse All Documents
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
                        {{ $documents->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Category Statistics -->
    @if($documents->total() > 0)
    <div class="row mt-5">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-body p-4">
                    <h5 class="mb-4">
                        <i class="fas fa-chart-bar text-info me-2"></i>
                        Category Statistics
                    </h5>
                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                            <div class="text-primary fw-bold fs-4">{{ $documents->total() }}</div>
                            <small class="text-muted">Total Documents</small>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="text-success fw-bold fs-4">{{ $documents->sum('evaluations_count') }}</div>
                            <small class="text-muted">Total Reviews</small>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="text-warning fw-bold fs-4">
                                @php
                                    $avgRating = $documents->avg(function($doc) {
                                        return $doc->evaluations->avg('rating');
                                    });
                                @endphp
                                {{ $avgRating ? number_format($avgRating, 1) : '0.0' }}
                            </div>
                            <small class="text-muted">Average Rating</small>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="text-info fw-bold fs-4">
                                {{ $documents->unique('user_id')->count() }}
                            </div>
                            <small class="text-muted">Contributors</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
