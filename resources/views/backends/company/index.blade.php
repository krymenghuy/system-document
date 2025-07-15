@extends('backends.layouts.master')
@section('title', 'Company Information - Admin Panel')

@section('content')
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <div class="company-logo-hero">
                            @if($company && $company->photo)
                                <img src="{{ asset($company->photo) }}"
                                     alt="Company Logo"
                                     class="hero-logo">
                            @else
                                <div class="hero-logo-placeholder">
                                    <i class="fas fa-building"></i>
                                </div>
                            @endif
                        </div>
                        <div class="hero-text">
                            <h1 class="hero-title">{{ $company->name ?? 'Document Management System' }}</h1>
                            <p class="hero-subtitle">{{ $company->description ?? 'Professional document management solution for modern organizations' }}</p>
                            <div class="hero-actions">
                                <a href="{{ route('admin.company.edit') }}" class="btn btn-primary btn-hero">
                                    <i class="fas fa-edit me-2"></i>Edit Company
                                </a>
                                <button class="btn btn-outline-light btn-hero" onclick="shareCompany()">
                                    <i class="fas fa-share-alt me-2"></i>Share
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="hero-stats">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number" data-target="{{ \App\Models\Document::count() }}">0</h3>
                                <p class="stat-label">Documents</p>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number" data-target="{{ \App\Models\User::count() }}">0</h3>
                                <p class="stat-label">Users</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-fluid">
        @if(session('status') == 'success')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('sms') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @elseif(session('status') == 'error')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('sms') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            <!-- Company Information Card -->
            <div class="col-lg-8">
                <div class="glass-card company-info-card">
                    <div class="card-header-glass">
                        <h3 class="card-title">
                            <i class="fas fa-info-circle me-2"></i>
                            Company Details
                        </h3>
                        <div class="card-actions">
                            <button class="btn btn-sm btn-outline-primary" onclick="copyCompanyInfo()">
                                <i class="fas fa-copy me-1"></i>Copy
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="info-content">
                                        <label>Email Address</label>
                                        <p>
                                            @if($company && $company->email)
                                                <a href="mailto:{{ $company->email }}" class="info-link">
                                                    {{ $company->email }}
                                                </a>
                                            @else
                                                <span class="text-muted">Not set</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="info-content">
                                        <label>Phone Number</label>
                                        <p>
                                            @if($company && $company->phone)
                                                <a href="tel:{{ $company->phone }}" class="info-link">
                                                    {{ $company->phone }}
                                                </a>
                                            @else
                                                <span class="text-muted">Not set</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-globe"></i>
                                    </div>
                                    <div class="info-content">
                                        <label>Website</label>
                                        <p>
                                            @if($company && $company->website)
                                                <a href="{{ $company->website }}" target="_blank" class="info-link">
                                                    {{ $company->website }}
                                                </a>
                                            @else
                                                <span class="text-muted">Not set</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="info-content">
                                        <label>Address</label>
                                        <p>{{ $company->address ?? 'Not set' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-align-left"></i>
                                    </div>
                                    <div class="info-content">
                                        <label>Description</label>
                                        <p>{{ $company->description ?? 'No description available.' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Cards -->
            <div class="col-lg-4">
                <!-- System Statistics -->
                <div class="glass-card stats-card mb-4">
                    <div class="card-header-glass">
                        <h4 class="card-title">
                            <i class="fas fa-chart-bar me-2"></i>
                            System Overview
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="stats-grid">
                            <div class="stat-item">
                                <div class="stat-icon-small bg-primary">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div class="stat-details">
                                    <h5 class="stat-number-small" data-target="{{ \App\Models\Document::count() }}">0</h5>
                                    <span class="stat-label-small">Documents</span>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon-small bg-success">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-details">
                                    <h5 class="stat-number-small" data-target="{{ \App\Models\User::count() }}">0</h5>
                                    <span class="stat-label-small">Users</span>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon-small bg-warning">
                                    <i class="fas fa-folder"></i>
                                </div>
                                <div class="stat-details">
                                    <h5 class="stat-number-small" data-target="{{ \App\Models\DocumentCategory::count() }}">0</h5>
                                    <span class="stat-label-small">Categories</span>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon-small bg-info">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="stat-details">
                                    <h5 class="stat-number-small" data-target="{{ \App\Models\DocumentEvaluation::count() }}">0</h5>
                                    <span class="stat-label-small">Reviews</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="glass-card actions-card">
                    <div class="card-header-glass">
                        <h4 class="card-title">
                            <i class="fas fa-bolt me-2"></i>
                            Quick Actions
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="actions-grid">
                            <a href="{{ route('admin.documents.create') }}" class="action-item">
                                <div class="action-icon bg-primary">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <span>Add Document</span>
                            </a>
                            <a href="{{ route('admin.user.create') }}" class="action-item">
                                <div class="action-icon bg-success">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <span>Add User</span>
                            </a>
                            <a href="{{ route('admin.document_category') }}" class="action-item">
                                <div class="action-icon bg-warning">
                                    <i class="fas fa-folder-plus"></i>
                                </div>
                                <span>Categories</span>
                            </a>
                            <a href="{{ route('admin.company.edit') }}" class="action-item">
                                <div class="action-icon bg-info">
                                    <i class="fas fa-edit"></i>
                                </div>
                                <span>Edit Company</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Information -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="glass-card system-info-card">
                    <div class="card-header-glass">
                        <h4 class="card-title">
                            <i class="fas fa-server me-2"></i>
                            System Information
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="system-grid">
                            <div class="system-item">
                                <div class="system-icon">
                                    <i class="fas fa-code"></i>
                                </div>
                                <div class="system-content">
                                    <h6>Laravel Version</h6>
                                    <p>{{ app()->version() }}</p>
                                </div>
                            </div>
                            <div class="system-item">
                                <div class="system-icon">
                                    <i class="fas fa-database"></i>
                                </div>
                                <div class="system-content">
                                    <h6>Database</h6>
                                    <p>MySQL</p>
                                </div>
                            </div>
                            <div class="system-item">
                                <div class="system-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="system-content">
                                    <h6>Server Time</h6>
                                    <p>{{ now()->format('H:i:s') }}</p>
                                </div>
                            </div>
                            <div class="system-item">
                                <div class="system-icon">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <div class="system-content">
                                    <h6>Current Date</h6>
                                    <p>{{ now()->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 3rem 0;
    color: white;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.company-logo-hero {
    margin-bottom: 2rem;
}

.hero-logo {
    width: 120px;
    height: 120px;
    border-radius: 20px;
    object-fit: cover;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    border: 4px solid rgba(255,255,255,0.2);
}

.hero-logo-placeholder {
    width: 120px;
    height: 120px;
    border-radius: 20px;
    background: rgba(255,255,255,0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    border: 4px solid rgba(255,255,255,0.2);
}

.hero-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.hero-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.hero-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn-hero {
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.btn-hero:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.3);
}

.hero-stats {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.stat-card {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    border: 1px solid rgba(255,255,255,0.2);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.stat-content h3 {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
}

.stat-content p {
    margin: 0;
    opacity: 0.8;
    font-size: 0.9rem;
}

/* Glass Cards */
.glass-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.3s ease;
}

.glass-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.card-header-glass {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-title {
    margin: 0;
    font-weight: 600;
    font-size: 1.2rem;
}

.card-actions .btn {
    border-radius: 25px;
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
}

.card-body {
    padding: 2rem;
}

/* Info Items */
.info-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    background: rgba(0,0,0,0.02);
    border-radius: 12px;
    transition: all 0.3s ease;
}

.info-item:hover {
    background: rgba(0,0,0,0.05);
    transform: translateX(5px);
}

.info-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.info-content {
    flex: 1;
}

.info-content label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
    display: block;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-content p {
    margin: 0;
    color: #6c757d;
    line-height: 1.5;
}

.info-link {
    color: #667eea;
    text-decoration: none;
    transition: color 0.3s ease;
}

.info-link:hover {
    color: #764ba2;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem;
    background: rgba(0,0,0,0.02);
    border-radius: 12px;
    transition: all 0.3s ease;
}

.stat-item:hover {
    background: rgba(0,0,0,0.05);
    transform: scale(1.02);
}

.stat-icon-small {
    width: 35px;
    height: 35px;
    border-radius: 8px;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
}

.stat-details {
    flex: 1;
}

.stat-number-small {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
    color: #495057;
}

.stat-label-small {
    font-size: 0.8rem;
    color: #6c757d;
    margin: 0;
}

/* Actions Grid */
.actions-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.action-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    padding: 1.5rem 1rem;
    background: rgba(0,0,0,0.02);
    border-radius: 12px;
    text-decoration: none;
    color: #495057;
    transition: all 0.3s ease;
}

.action-item:hover {
    background: rgba(0,0,0,0.05);
    transform: translateY(-3px);
    color: #495057;
    text-decoration: none;
}

.action-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.action-item span {
    font-size: 0.9rem;
    font-weight: 500;
    text-align: center;
}

/* System Grid */
.system-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.system-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem;
    background: rgba(0,0,0,0.02);
    border-radius: 12px;
    transition: all 0.3s ease;
}

.system-item:hover {
    background: rgba(0,0,0,0.05);
    transform: translateX(5px);
}

.system-icon {
    width: 45px;
    height: 45px;
    border-radius: 10px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
}

.system-content h6 {
    margin: 0 0 0.25rem 0;
    font-weight: 600;
    color: #495057;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.system-content p {
    margin: 0;
    color: #6c757d;
    font-weight: 500;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }

    .hero-actions {
        flex-direction: column;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }

    .actions-grid {
        grid-template-columns: 1fr;
    }

    .system-grid {
        grid-template-columns: 1fr;
    }
}

/* Animation for counters */
@keyframes countUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.stat-number, .stat-number-small {
    animation: countUp 1s ease-out;
}
</style>

<script>
// Animate counters on page load
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.stat-number, .stat-number-small');

    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60fps
        let current = 0;

        const updateCounter = () => {
            current += increment;
            if (current < target) {
                counter.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        };

        updateCounter();
    });
});

// Copy company info function
function copyCompanyInfo() {
    const companyInfo = {
        name: '{{ $company->name ?? "Document Management System" }}',
        email: '{{ $company->email ?? "" }}',
        phone: '{{ $company->phone ?? "" }}',
        website: '{{ $company->website ?? "" }}',
        address: '{{ $company->address ?? "" }}'
    };

    const infoText = `Company: ${companyInfo.name}\nEmail: ${companyInfo.email}\nPhone: ${companyInfo.phone}\nWebsite: ${companyInfo.website}\nAddress: ${companyInfo.address}`;

    navigator.clipboard.writeText(infoText).then(() => {
        // Show success message
        const btn = event.target.closest('.btn');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
        btn.classList.add('btn-success');

        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('btn-success');
        }, 2000);
    });
}

// Share company function
function shareCompany() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $company->name ?? "Document Management System" }}',
            text: '{{ $company->description ?? "Professional document management solution" }}',
            url: window.location.href
        });
    } else {
        // Fallback for browsers that don't support Web Share API
        copyCompanyInfo();
    }
}
</script>
@endsection
