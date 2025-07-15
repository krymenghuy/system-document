@extends('frontends.layouts.master')
@section('title', 'Profile - Document Management System')

@section('content')
<div class="container-fluid p-4">
    <!-- Profile Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card card-custom">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center">
                            <div class="profile-avatar mb-3">
                                @if($user->photo)
                                    <img src="{{ asset('storage/' . $user->photo) }}"
                                         alt="{{ $user->name }}"
                                         class="avatar-image">
                                @else
                                    <div class="avatar-placeholder">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <div class="profile-actions">
                                <a href="{{ route('frontend.profile.edit') }}" class="btn btn-primary-custom btn-custom btn-sm">
                                    <i class="fas fa-edit me-1"></i>Edit Profile
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2 class="mb-2">{{ $user->name }}</h2>
                            <p class="text-muted mb-2">
                                <i class="fas fa-envelope me-2"></i>{{ $user->email }}
                            </p>
                            @if($user->phone)
                                <p class="text-muted mb-2">
                                    <i class="fas fa-phone me-2"></i>{{ $user->phone }}
                                </p>
                            @endif
                            @if($user->location)
                                <p class="text-muted mb-2">
                                    <i class="fas fa-map-marker-alt me-2"></i>{{ $user->location }}
                                </p>
                            @endif
                            @if($user->bio)
                                <p class="text-muted mb-0">{{ $user->bio }}</p>
                            @endif
                        </div>
                        <div class="col-md-3 text-md-end">
                            <div class="profile-stats">
                                <div class="stat-item">
                                    <h4 class="text-primary">{{ $totalEvaluations }}</h4>
                                    <small class="text-muted">Reviews</small>
                                </div>
                                <div class="stat-item">
                                    <h4 class="text-success">{{ number_format($averageRating, 1) }}</h4>
                                    <small class="text-muted">Avg Rating</small>
                                </div>
                                <div class="stat-item">
                                    <h4 class="text-info">{{ $user->created_at_formatted }}</h4>
                                    <small class="text-muted">Member Since</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Profile Information -->
        <div class="col-lg-8">
            <!-- Recent Activity -->
            <div class="card card-custom mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">
                            <i class="fas fa-history text-primary me-2"></i>
                            Recent Activity
                        </h5>
                        <a href="{{ route('frontend.profile.activity') }}" class="btn btn-outline-primary btn-custom btn-sm">
                            <i class="fas fa-external-link-alt me-1"></i>View All
                        </a>
                    </div>

                    @if($activities->count() > 0)
                        <div class="timeline">
                            @foreach($activities as $activity)
                            <div class="timeline-item d-flex align-items-start mb-3">
                                <div class="timeline-icon me-3">
                                    <div class="bg-{{ $activity['color'] }} rounded-circle d-flex align-items-center justify-content-center"
                                         style="width: 40px; height: 40px;">
                                        <i class="{{ $activity['icon'] }} text-white"></i>
                                    </div>
                                </div>
                                <div class="timeline-content flex-grow-1">
                                    <h6 class="mb-1">{{ $activity['title'] }}</h6>
                                    @if(isset($activity['rating']))
                                        <div class="text-warning mb-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= $activity['rating'] ? '' : '-o' }}"></i>
                                            @endfor
                                        </div>
                                    @endif
                                    <small class="text-muted">{{ $activity['date']->diffForHumans() }}</small>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-clock text-muted" style="font-size: 3rem;"></i>
                            <h6 class="mt-3 text-muted">No recent activity</h6>
                            <p class="text-muted">Start rating documents to see your activity here!</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Reviews -->
            <div class="card card-custom mb-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">
                        <i class="fas fa-star text-warning me-2"></i>
                        Recent Reviews
                    </h5>

                    @if($recentEvaluations->count() > 0)
                        @foreach($recentEvaluations as $evaluation)
                        <div class="review-item d-flex align-items-start mb-3 p-3 rounded" style="background: rgba(0,0,0,0.02);">
                            <div class="review-avatar me-3">
                                <div class="avatar-circle">
                                    {{ strtoupper(substr($evaluation->document->name, 0, 1)) }}
                                </div>
                            </div>
                            <div class="review-content flex-grow-1">
                                <h6 class="mb-1">
                                    <a href="{{ route('frontend.documents.show', $evaluation->document) }}"
                                       class="text-decoration-none">{{ $evaluation->document->name }}</a>
                                </h6>
                                <p class="text-muted small mb-2">{{ $evaluation->document->category->name ?? 'Uncategorized' }}</p>
                                <div class="text-warning mb-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star{{ $i <= $evaluation->rating ? '' : '-o' }}"></i>
                                    @endfor
                                </div>
                                @if($evaluation->text)
                                    <p class="text-muted small mb-2">{{ $evaluation->text }}</p>
                                @endif
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

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card card-custom mb-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">
                        <i class="fas fa-bolt text-warning me-2"></i>
                        Quick Actions
                    </h5>
                    <div class="d-grid gap-2">
                        <a href="{{ route('frontend.profile.edit') }}" class="btn btn-outline-primary btn-custom">
                            <i class="fas fa-user-edit me-2"></i>Edit Profile
                        </a>
                        <a href="{{ route('frontend.profile.settings') }}" class="btn btn-outline-info btn-custom">
                            <i class="fas fa-cog me-2"></i>Settings
                        </a>
                        <a href="{{ route('frontend.profile.activity') }}" class="btn btn-outline-success btn-custom">
                            <i class="fas fa-chart-line me-2"></i>Activity
                        </a>
                        <a href="{{ route('frontend.profile.export') }}" class="btn btn-outline-secondary btn-custom">
                            <i class="fas fa-download me-2"></i>Export Data
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="card card-custom mb-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">
                        <i class="fas fa-chart-bar text-info me-2"></i>
                        Your Statistics
                    </h5>
                    <div class="stats-grid">
                        <div class="stat-card text-center">
                            <div class="stat-icon bg-primary">
                                <i class="fas fa-star text-white"></i>
                            </div>
                            <h4 class="fw-bold text-primary">{{ $totalEvaluations }}</h4>
                            <small class="text-muted">Total Reviews</small>
                        </div>
                        <div class="stat-card text-center">
                            <div class="stat-icon bg-warning">
                                <i class="fas fa-star-half-alt text-white"></i>
                            </div>
                            <h4 class="fw-bold text-warning">{{ number_format($averageRating, 1) }}</h4>
                            <small class="text-muted">Average Rating</small>
                        </div>
                        <div class="stat-card text-center">
                            <div class="stat-icon bg-success">
                                <i class="fas fa-calendar text-white"></i>
                            </div>
                            <h4 class="fw-bold text-success">{{ $user->created_at->diffForHumans() }}</h4>
                            <small class="text-muted">Member Since</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Actions -->
            <div class="card card-custom">
                <div class="card-body p-4">
                    <h5 class="mb-3">
                        <i class="fas fa-shield-alt text-danger me-2"></i>
                        Account Actions
                    </h5>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-warning btn-custom" onclick="showChangePasswordModal()">
                            <i class="fas fa-key me-2"></i>Change Password
                        </button>
                        <button class="btn btn-outline-danger btn-custom" onclick="showDeleteAccountModal()">
                            <i class="fas fa-trash me-2"></i>Delete Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('frontend.profile.password') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control form-control-custom" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control form-control-custom" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control form-control-custom" name="new_password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary-custom btn-custom">
                        <i class="fas fa-key me-2"></i>Change Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Delete Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('frontend.profile.delete') }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Warning:</strong> This action cannot be undone. All your data will be permanently deleted.
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Enter your password to confirm</label>
                        <input type="password" class="form-control form-control-custom" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmation" class="form-label">Type "DELETE" to confirm</label>
                        <input type="text" class="form-control form-control-custom" name="confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-custom">
                        <i class="fas fa-trash me-2"></i>Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.profile-avatar {
    position: relative;
}

.avatar-image {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid rgba(102, 126, 234, 0.2);
}

.avatar-placeholder {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 3rem;
    font-weight: bold;
    border: 4px solid rgba(102, 126, 234, 0.2);
}

.profile-stats {
    display: flex;
    justify-content: space-around;
}

.stat-item {
    text-align: center;
}

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

.review-avatar .avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
}

.stats-grid {
    display: grid;
    gap: 1rem;
}

.stat-card {
    padding: 1rem;
    border-radius: 10px;
    background: rgba(0,0,0,0.02);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
}

@media (max-width: 768px) {
    .profile-stats {
        flex-direction: column;
        gap: 1rem;
    }

    .avatar-image,
    .avatar-placeholder {
        width: 80px;
        height: 80px;
        font-size: 2rem;
    }
}
</style>

<script>
function showChangePasswordModal() {
    const modal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
    modal.show();
}

function showDeleteAccountModal() {
    const modal = new bootstrap.Modal(document.getElementById('deleteAccountModal'));
    modal.show();
}

// Add animation to profile cards
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card-custom');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('fade-in');
    });
});
</script>
@endsection
