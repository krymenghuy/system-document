@extends('frontends.layouts.master')
@section('title', $document->name . ' - Document Management System')

@section('content')
<!-- Hero Section with Document Preview -->
<div class="document-hero" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 3rem 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom">
                        <li class="breadcrumb-item"><a href="{{ route('user.name') }}" class="text-white-50">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('frontend.documents') }}" class="text-white-50">Documents</a></li>
                        <li class="breadcrumb-item active text-white">{{ Str::limit($document->name, 30) }}</li>
                    </ol>
                </nav>

                <div class="d-flex align-items-center mb-3">
                    <div class="document-icon me-3">
                        <i class="fas fa-file-{{ $document->file_extension == 'pdf' ? 'pdf' : ($document->file_extension == 'doc' ? 'word' : 'alt') }} fa-3x"></i>
                    </div>
                    <div>
                        <h1 class="display-5 fw-bold mb-2">{{ $document->name }}</h1>
                        <div class="d-flex align-items-center flex-wrap">
                            <span class="badge bg-light text-dark me-2 mb-1">{{ strtoupper($document->file_extension) }}</span>
                            <span class="badge bg-primary me-2 mb-1">{{ $document->category->name ?? 'Uncategorized' }}</span>
                            <span class="text-white-50 mb-1">
                                <i class="fas fa-calendar me-1"></i>{{ $document->created_at ? $document->created_at->format('F d, Y') : 'N/A' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="document-stats d-flex align-items-center flex-wrap">
                    <div class="stat-item me-4 mb-2">
                        <i class="fas fa-download me-1"></i>
                        <span class="fw-bold">{{ $document->evaluations_count }}</span> reviews
                    </div>
                    <div class="stat-item me-4 mb-2">
                        <i class="fas fa-star me-1"></i>
                        <span class="fw-bold">{{ $document->evaluations_count }}</span> reviews
                    </div>
                    <div class="stat-item me-4 mb-2">
                        <i class="fas fa-eye me-1"></i>
                        <span class="fw-bold">{{ number_format($document->file_size / 1024, 1) }}</span> KB
                    </div>
                    @if($averageRating)
                    <div class="stat-item mb-2">
                        <div class="text-warning">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star{{ $i <= $averageRating ? '' : '-o' }}"></i>
                            @endfor
                            <span class="text-white-50 ms-1">({{ number_format($averageRating, 1) }})</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="action-buttons">
                    <a href="{{ route('frontend.documents.download', $document) }}"
                       class="btn btn-light btn-lg btn-custom me-2 mb-2">
                        <i class="fas fa-download me-2"></i>Download
                    </a>
                    <button class="btn btn-outline-light btn-lg btn-custom mb-2" onclick="shareDocument()">
                        <i class="fas fa-share-alt me-2"></i>Share
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid p-4">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Document Details -->
            <div class="card card-custom mb-4">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-3">
                                <i class="fas fa-info-circle text-primary me-2"></i>
                                Document Information
                            </h5>
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="info-label">Author:</span>
                                    <span class="info-value">{{ $document->author }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Category:</span>
                                    <span class="info-value">{{ $document->category->name ?? 'Uncategorized' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">File Type:</span>
                                    <span class="info-value">{{ strtoupper($document->file_extension) }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">File Size:</span>
                                    <span class="info-value">{{ number_format($document->file_size / 1024, 1) }} KB</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Upload Date:</span>
                                    <span class="info-value">{{ $document->created_at ? $document->created_at->format('F d, Y \a\t g:i A') : 'N/A' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Last Modified:</span>
                                    <span class="info-value">{{ $document->updated_at ? $document->updated_at->format('F d, Y \a\t g:i A') : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3">
                                <i class="fas fa-align-left text-primary me-2"></i>
                                Description
                            </h5>
                            <div class="description-content">
                                @if($document->description)
                                    <p class="text-muted">{{ $document->description }}</p>
                                @else
                                    <p class="text-muted fst-italic">No description available for this document.</p>
                                @endif
                            </div>

                            <div class="mt-4">
                                <h6 class="mb-2">Quick Actions</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    <button class="btn btn-outline-primary btn-sm" onclick="printDocument()">
                                        <i class="fas fa-print me-1"></i>Print
                                    </button>
                                    <button class="btn btn-outline-success btn-sm" onclick="addToFavorites()">
                                        <i class="fas fa-heart me-1"></i>Favorite
                                    </button>
                                    <button class="btn btn-outline-info btn-sm" onclick="showQRCode()">
                                        <i class="fas fa-qrcode me-1"></i>QR Code
                                    </button>
                                    <button class="btn btn-outline-warning btn-sm" onclick="reportDocument()">
                                        <i class="fas fa-flag me-1"></i>Report
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Document Preview -->
            <div class="card card-custom mb-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">
                        <i class="fas fa-eye text-primary me-2"></i>
                        Document Preview
                    </h5>
                    <div class="document-preview">
                        @if($document->file_extension == 'pdf')
                            <div class="pdf-preview">
                                <iframe src="{{ asset('storage/' . $document->file_path) }}"
                                        width="100%" height="500" frameborder="0"></iframe>
                            </div>
                        @else
                            <div class="file-preview text-center py-5">
                                <i class="fas fa-file-{{ $document->file_extension == 'pdf' ? 'pdf' : ($document->file_extension == 'doc' ? 'word' : 'alt') }} fa-5x text-muted mb-3"></i>
                                <h5 class="text-muted">Preview not available for {{ strtoupper($document->file_extension) }} files</h5>
                                <p class="text-muted">Click download to view this document</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="card card-custom mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">
                            <i class="fas fa-star text-warning me-2"></i>
                            Reviews & Ratings
                        </h5>
                        <button class="btn btn-primary-custom btn-custom" onclick="showReviewModal()">
                            <i class="fas fa-plus me-2"></i>Write Review
                        </button>
                    </div>

                    @if($document->evaluations->count() > 0)
                        <div class="reviews-container">
                            @foreach($document->evaluations->take(5) as $evaluation)
                            <div class="review-item">
                                <div class="d-flex align-items-start">
                                    <div class="review-avatar me-3">
                                        <div class="avatar-circle">
                                            {{ strtoupper(substr($evaluation->user->name, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="review-content flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="mb-1">{{ $evaluation->user->name }}</h6>
                                            <div class="text-warning">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star{{ $i <= $evaluation->rating ? '' : '-o' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        @if($evaluation->text)
                                            <p class="text-muted mb-2">{{ $evaluation->text }}</p>
                                        @endif
                                        <small class="text-muted">{{ $evaluation->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @if($document->evaluations->count() > 5)
                            <div class="text-center mt-3">
                                <a href="#" class="btn btn-outline-primary btn-custom">View All Reviews ({{ $document->evaluations->count() }})</a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-star text-muted" style="font-size: 3rem;"></i>
                            <h6 class="mt-3 text-muted">No reviews yet</h6>
                            <p class="text-muted">Be the first to review this document!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Related Documents -->
            @if($relatedDocuments->count() > 0)
            <div class="card card-custom mb-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">
                        <i class="fas fa-folder text-primary me-2"></i>
                        Related Documents
                    </h5>
                    @foreach($relatedDocuments as $related)
                    <div class="related-document">
                        <div class="d-flex align-items-center p-2 rounded" style="background: rgba(0,0,0,0.02);">
                            <div class="document-icon-small me-3">
                                <i class="fas fa-file-{{ $related->file_extension == 'pdf' ? 'pdf' : ($related->file_extension == 'doc' ? 'word' : 'alt') }} text-primary"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">
                                    <a href="{{ route('frontend.documents.show', $related) }}"
                                       class="text-decoration-none">{{ Str::limit($related->name, 30) }}</a>
                                </h6>
                                <small class="text-muted">
                                    <i class="fas fa-download me-1"></i>{{ $related->download_count }} downloads
                                </small>
                            </div>
                            <span class="badge bg-primary">{{ strtoupper($related->file_extension) }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Document Statistics -->
            <div class="card card-custom mb-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">
                        <i class="fas fa-chart-bar text-info me-2"></i>
                        Document Analytics
                    </h5>
                    <div class="analytics-grid">
                        <div class="analytics-item text-center">
                            <div class="analytics-icon bg-primary">
                                <i class="fas fa-download text-white"></i>
                            </div>
                            <h4 class="fw-bold text-primary">{{ $document->download_count }}</h4>
                            <small class="text-muted">Downloads</small>
                        </div>
                        <div class="analytics-item text-center">
                            <div class="analytics-icon bg-success">
                                <i class="fas fa-star text-white"></i>
                            </div>
                            <h4 class="fw-bold text-success">{{ $document->evaluations_count }}</h4>
                            <small class="text-muted">Reviews</small>
                        </div>
                        <div class="analytics-item text-center">
                            <div class="analytics-icon bg-warning">
                                <i class="fas fa-star-half-alt text-white"></i>
                            </div>
                            <h4 class="fw-bold text-warning">
                                @if($averageRating)
                                    {{ number_format($averageRating, 1) }}
                                @else
                                    0.0
                                @endif
                            </h4>
                            <small class="text-muted">Avg Rating</small>
                        </div>
                        <div class="analytics-item text-center">
                            <div class="analytics-icon bg-info">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                            <h4 class="fw-bold text-info">{{ number_format($document->file_size / 1024, 1) }}</h4>
                            <small class="text-muted">KB</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Share Document -->
            <div class="card card-custom mb-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">
                        <i class="fas fa-share-alt text-primary me-2"></i>
                        Share Document
                    </h5>
                    <div class="share-buttons">
                        <button class="btn btn-outline-primary btn-custom w-100 mb-2" onclick="shareOnFacebook()">
                            <i class="fab fa-facebook me-2"></i>Share on Facebook
                        </button>
                        <button class="btn btn-outline-info btn-custom w-100 mb-2" onclick="shareOnTwitter()">
                            <i class="fab fa-twitter me-2"></i>Share on Twitter
                        </button>
                        <button class="btn btn-outline-success btn-custom w-100 mb-2" onclick="shareOnWhatsApp()">
                            <i class="fab fa-whatsapp me-2"></i>Share on WhatsApp
                        </button>
                        <button class="btn btn-outline-secondary btn-custom w-100" onclick="copyLink()">
                            <i class="fas fa-link me-2"></i>Copy Link
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Write a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('frontend.documents.evaluate', $document) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Your Rating</label>
                        <div class="rating-stars-modal">
                            @for($i = 1; $i <= 5; $i++)
                                <input type="radio" name="rating" value="{{ $i }}" id="modal-star{{ $i }}"
                                       {{ $userEvaluation && $userEvaluation->rating == $i ? 'checked' : '' }}>
                                <label for="modal-star{{ $i }}" class="star-label-modal">
                                    <i class="fas fa-star"></i>
                                </label>
                            @endfor
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Your Comment (Optional)</label>
                        <textarea class="form-control form-control-custom" name="comment" rows="4"
                                  placeholder="Share your thoughts about this document...">{{ $userEvaluation->text ?? '' }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary-custom btn-custom">
                        <i class="fas fa-paper-plane me-2"></i>Submit Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Hero Section */
.document-hero {
    position: relative;
    overflow: hidden;
}

.document-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.breadcrumb-custom .breadcrumb-item + .breadcrumb-item::before {
    color: rgba(255,255,255,0.5);
}

.document-icon {
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

.stat-item {
    background: rgba(255,255,255,0.1);
    padding: 0.5rem 1rem;
    border-radius: 25px;
    backdrop-filter: blur(10px);
}

/* Info Grid */
.info-grid {
    display: grid;
    gap: 1rem;
}

.info-item {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.info-label {
    font-weight: 600;
    color: #6c757d;
}

.info-value {
    color: #495057;
}

/* Analytics Grid */
.analytics-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.analytics-item {
    padding: 1rem;
    border-radius: 10px;
    background: rgba(0,0,0,0.02);
}

.analytics-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
}

/* Reviews */
.review-item {
    padding: 1rem 0;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.review-item:last-child {
    border-bottom: none;
}

.avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

/* Rating Stars */
.rating-stars-modal {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-start;
}

.rating-stars-modal input {
    display: none;
}

.star-label-modal {
    cursor: pointer;
    font-size: 1.5rem;
    color: #ddd;
    transition: color 0.2s ease;
}

.rating-stars-modal input:checked ~ .star-label-modal,
.rating-stars-modal .star-label-modal:hover,
.rating-stars-modal .star-label-modal:hover ~ .star-label-modal {
    color: #ffc107;
}

/* Related Documents */
.related-document {
    margin-bottom: 1rem;
}

.related-document:last-child {
    margin-bottom: 0;
}

.document-icon-small {
    font-size: 1.5rem;
}

/* Responsive */
@media (max-width: 768px) {
    .document-hero {
        padding: 2rem 0;
    }

    .action-buttons {
        margin-top: 2rem;
    }

    .analytics-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
function showReviewModal() {
    const modal = new bootstrap.Modal(document.getElementById('reviewModal'));
    modal.show();
}

function shareDocument() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $document->name }}',
            text: 'Check out this document: {{ $document->name }}',
            url: window.location.href
        });
    } else {
        copyLink();
    }
}

function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        showToast('Link copied to clipboard!', 'success');
    });
}

function shareOnFacebook() {
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}`, '_blank');
}

function shareOnTwitter() {
    window.open(`https://twitter.com/intent/tweet?text=Check out this document: {{ $document->name }}&url=${encodeURIComponent(window.location.href)}`, '_blank');
}

function shareOnWhatsApp() {
    window.open(`https://wa.me/?text=Check out this document: {{ $document->name }} ${encodeURIComponent(window.location.href)}`, '_blank');
}

function printDocument() {
    window.print();
}

function addToFavorites() {
    showToast('Added to favorites!', 'success');
}

function showQRCode() {
    // Generate QR code for current URL
    const qrUrl = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(window.location.href)}`;
    window.open(qrUrl, '_blank');
}

function reportDocument() {
    showToast('Report submitted!', 'info');
}

function showToast(message, type) {
    // Create toast notification
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-white bg-${type} border-0`;
    toast.setAttribute('role', 'alert');
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">${message}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;

    const container = document.createElement('div');
    container.className = 'toast-container position-fixed top-0 end-0 p-3';
    container.appendChild(toast);
    document.body.appendChild(container);

    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();

    setTimeout(() => {
        container.remove();
    }, 3000);
}

// Initialize rating stars
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.rating-stars-modal input');
    const labels = document.querySelectorAll('.star-label-modal');

    stars.forEach((star, index) => {
        star.addEventListener('change', function() {
            labels.forEach((label, labelIndex) => {
                if (labelIndex >= index) {
                    label.style.color = '#ffc107';
                } else {
                    label.style.color = '#ddd';
                }
            });
        });
    });
});
</script>
@endsection
