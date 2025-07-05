@extends('frontends.layouts.master')
@section('title', 'Dashboard - Document Management System')

@section('content')
<div class="container-fluid p-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-2">
                                <i class="fas fa-tachometer-alt text-primary me-2"></i>
                                Welcome back, {{ $user->name }}!
                            </h2>
                            <p class="text-muted mb-0">Here's your personal dashboard with your activity and statistics</p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <span class="badge bg-primary fs-6">Member since {{ $user->created_at_formatted }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card card-custom">
                <div class="card-body p-4 text-center">
                    <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 60px; height: 60px;">
                        <i class="fas fa-file-alt text-white" style="font-size: 1.5rem;"></i>
                    </div>
                    <h3 class="fw-bold text-primary">{{ $totalDocuments }}</h3>
                    <p class="text-muted mb-0">Total Documents</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card card-custom">
                <div class="card-body p-4 text-center">
                    <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 60px; height: 60px;">
                        <i class="fas fa-star text-white" style="font-size: 1.5rem;"></i>
                    </div>
                    <h3 class="fw-bold text-success">{{ $totalEvaluations }}</h3>
                    <p class="text-muted mb-0">Your Reviews</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card card-custom">
                <div class="card-body p-4 text-center">
                    <div class="bg-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 60px; height: 60px;">
                        <i class="fas fa-star-half-alt text-white" style="font-size: 1.5rem;"></i>
                    </div>
                    <h3 class="fw-bold text-warning">{{ number_format($averageRating, 1) }}</h3>
                    <p class="text-muted mb-0">Avg Rating</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card card-custom">
                <div class="card-body p-4 text-center">
                    <div class="bg-info rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 60px; height: 60px;">
                        <i class="fas fa-clock text-white" style="font-size: 1.5rem;"></i>
                    </div>
                    <h3 class="fw-bold text-info">{{ $recentActivity->count() }}</h3>
                    <p class="text-muted mb-0">Recent Activities</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card card-custom">
                <div class="card-body p-4">
                    <h5 class="mb-3">
                        <i class="fas fa-history text-primary me-2"></i>
                        Recent Activity
                    </h5>

                    @if($recentActivity->count() > 0)
                        <div class="timeline">
                            @foreach($recentActivity as $activity)
                            <div class="timeline-item d-flex align-items-start mb-3">
                                <div class="timeline-icon me-3">
                                    <div class="bg-{{ $activity['color'] }} rounded-circle d-flex align-items-center justify-content-center"
                                         style="width: 40px; height: 40px;">
                                        <i class="{{ $activity['icon'] }} text-white"></i>
                                    </div>
                                </div>
                                <div class="timeline-content flex-grow-1">
                                    <h6 class="mb-1">{{ $activity['title'] }}</h6>
                                    <small class="text-muted">{{ $activity['date']->diffForHumans() }}</small>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-clock text-muted" style="font-size: 3rem;"></i>
                            <h6 class="mt-3 text-muted">No recent activity</h6>
                            <p class="text-muted">Start browsing documents to see your activity here!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-custom">
                <div class="card-body p-4">
                    <h5 class="mb-3">
                        <i class="fas fa-star text-warning me-2"></i>
                        Your Recent Reviews
                    </h5>

                    @if($myEvaluations->count() > 0)
                        @foreach($myEvaluations as $evaluation)
                        <div class="d-flex align-items-start mb-3 p-2 rounded" style="background: rgba(0,0,0,0.02);">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">
                                    <a href="{{ route('frontend.documents.show', $evaluation->document) }}"
                                       class="text-decoration-none">{{ Str::limit($evaluation->document->name, 25) }}</a>
                                </h6>
                                <div class="text-warning mb-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $evaluation->rating ? '' : '-o' }}"></i>
                                    @endfor
                                </div>
                                <small class="text-muted">{{ $evaluation->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-star text-muted" style="font-size: 3rem;"></i>
                            <h6 class="mt-3 text-muted">No reviews yet</h6>
                            <p class="text-muted">Start rating documents to see your reviews here!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-body p-4">
                    <h5 class="mb-3">
                        <i class="fas fa-bolt text-warning me-2"></i>
                        Quick Actions
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('frontend.documents') }}" class="btn btn-primary-custom btn-custom w-100">
                                <i class="fas fa-search me-2"></i>Browse Documents
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('frontend.categories') }}" class="btn btn-success-custom btn-custom w-100">
                                <i class="fas fa-folder me-2"></i>View Categories
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('frontend.search') }}" class="btn btn-info btn-custom w-100">
                                <i class="fas fa-search-plus me-2"></i>Advanced Search
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('frontend.profile') }}" class="btn btn-outline-primary btn-custom w-100">
                                <i class="fas fa-user me-2"></i>Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.timeline-item {
    position: relative;
}

.timeline-item:not(:last-child)::after {
    content: '';
    position: absolute;
    left: 20px;
    top: 40px;
    bottom: -20px;
    width: 2px;
    background: rgba(0,0,0,0.1);
}

.timeline-icon {
    position: relative;
    z-index: 1;
}
</style>
@endsection
