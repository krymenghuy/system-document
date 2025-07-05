@extends('frontends.layouts.master')
@section('title', 'Home - Document Management System')

@section('content')
<!-- Hero Section with Parallax -->
<section class="hero-section position-relative overflow-hidden">
    <div class="hero-background">
        <div class="particles"></div>
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>
    </div>

    <div class="container position-relative">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="hero-content">
                    <h1 class="display-3 fw-bold text-white mb-4">
                        Manage Documents
                        <span class="text-gradient">Intelligently</span>
                    </h1>
                    <p class="lead text-white-50 mb-5">
                        Experience the future of document management with AI-powered organization,
                        advanced search capabilities, and seamless collaboration tools.
                    </p>
                    <div class="hero-buttons">
                        <a href="{{ route('frontend.documents') }}" class="btn btn-light btn-lg btn-custom me-3 mb-3">
                            <i class="fas fa-rocket me-2"></i>Get Started
                        </a>
                        <a href="#features" class="btn btn-outline-light btn-lg btn-custom mb-3">
                            <i class="fas fa-play me-2"></i>Watch Demo
                        </a>
                    </div>
                    <div class="hero-stats mt-5">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="stat-item">
                                    <h3 class="text-white fw-bold">{{ App\Models\Document::count() }}+</h3>
                                    <p class="text-white-50 mb-0">Documents</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <h3 class="text-white fw-bold">{{ App\Models\User::count() }}+</h3>
                                    <p class="text-white-50 mb-0">Users</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <h3 class="text-white fw-bold">99.9%</h3>
                                    <p class="text-white-50 mb-0">Uptime</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="hero-visual">
                    <div class="floating-card card-1">
                        <i class="fas fa-file-pdf text-danger"></i>
                        <span>PDF Documents</span>
                    </div>
                    <div class="floating-card card-2">
                        <i class="fas fa-file-word text-primary"></i>
                        <span>Word Files</span>
                    </div>
                    <div class="floating-card card-3">
                        <i class="fas fa-file-excel text-success"></i>
                        <span>Excel Sheets</span>
                    </div>
                    <div class="floating-card card-4">
                        <i class="fas fa-file-image text-warning"></i>
                        <span>Images</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-5" style="background: rgba(255,255,255,0.95);">
        <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-3">Why Choose DocManager?</h2>
                <p class="lead text-muted">Powerful features designed for modern document management</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card card-custom h-100">
                    <div class="feature-icon">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h4 class="mb-3">AI-Powered Search</h4>
                    <p class="text-muted">
                        Find documents instantly with our intelligent search engine that understands
                        context and content, not just keywords.
                    </p>
                    <div class="feature-highlights">
                        <span class="badge bg-primary me-2">Smart Tags</span>
                        <span class="badge bg-success me-2">Content Analysis</span>
                        <span class="badge bg-info">Auto-Classification</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card card-custom h-100">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="mb-3">Enterprise Security</h4>
                    <p class="text-muted">
                        Bank-level encryption, role-based access control, and audit trails ensure
                        your documents are always protected.
                    </p>
                    <div class="feature-highlights">
                        <span class="badge bg-primary me-2">256-bit Encryption</span>
                        <span class="badge bg-success me-2">Access Control</span>
                        <span class="badge bg-info">Audit Logs</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card card-custom h-100">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="mb-3">Team Collaboration</h4>
                    <p class="text-muted">
                        Work together seamlessly with real-time editing, comments, and version
                        control for all your documents.
                    </p>
                    <div class="feature-highlights">
                        <span class="badge bg-primary me-2">Real-time Sync</span>
                        <span class="badge bg-success me-2">Version Control</span>
                        <span class="badge bg-info">Comments</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-card card-custom h-100">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h4 class="mb-3">Mobile First</h4>
                    <p class="text-muted">
                        Access your documents anywhere with our responsive design and native
                        mobile apps for iOS and Android.
                    </p>
                    <div class="feature-highlights">
                        <span class="badge bg-primary me-2">Responsive Design</span>
                        <span class="badge bg-success me-2">Mobile Apps</span>
                        <span class="badge bg-info">Offline Access</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="feature-card card-custom h-100">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4 class="mb-3">Advanced Analytics</h4>
                    <p class="text-muted">
                        Get insights into document usage, user behavior, and system performance
                        with detailed analytics and reports.
                    </p>
                    <div class="feature-highlights">
                        <span class="badge bg-primary me-2">Usage Analytics</span>
                        <span class="badge bg-success me-2">Performance Metrics</span>
                        <span class="badge bg-info">Custom Reports</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="feature-card card-custom h-100">
                    <div class="feature-icon">
                        <i class="fas fa-cloud"></i>
                    </div>
                    <h4 class="mb-3">Cloud Native</h4>
                    <p class="text-muted">
                        Built for the cloud with automatic backups, global CDN, and seamless
                        scaling to handle any workload.
                    </p>
                    <div class="feature-highlights">
                        <span class="badge bg-primary me-2">Auto Backup</span>
                        <span class="badge bg-success me-2">Global CDN</span>
                        <span class="badge bg-info">Auto Scaling</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section with Animation -->
<section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3 class="counter fw-bold" data-target="{{ App\Models\Document::count() }}">0</h3>
                    <p class="mb-0">Documents Available</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-folder"></i>
                    </div>
                    <h3 class="counter fw-bold" data-target="{{ App\Models\DocumentCategory::count() }}">0</h3>
                    <p class="mb-0">Categories</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="counter fw-bold" data-target="{{ App\Models\User::count() }}">0</h3>
                    <p class="mb-0">Registered Users</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="400">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="counter fw-bold" data-target="{{ App\Models\DocumentEvaluation::count() }}">0</h3>
                    <p class="mb-0">Total Reviews</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-5" style="background: rgba(255,255,255,0.95);">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-3">How It Works</h2>
                <p class="lead text-muted">Get started in minutes with our simple 3-step process</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="step-card card-custom text-center">
                    <div class="step-number">1</div>
                    <div class="step-icon">
                        <i class="fas fa-upload"></i>
                    </div>
                    <h4 class="mb-3">Upload Documents</h4>
                    <p class="text-muted">
                        Drag and drop your documents or use our bulk upload feature.
                        We support all major file formats.
                    </p>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="step-card card-custom text-center">
                    <div class="step-number">2</div>
                    <div class="step-icon">
                        <i class="fas fa-magic"></i>
                    </div>
                    <h4 class="mb-3">Auto-Organize</h4>
                    <p class="text-muted">
                        Our AI automatically categorizes and tags your documents
                        for easy discovery and management.
                    </p>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="step-card card-custom text-center">
                    <div class="step-number">3</div>
                    <div class="step-icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <h4 class="mb-3">Share & Collaborate</h4>
                    <p class="text-muted">
                        Share documents with your team, set permissions, and
                        collaborate in real-time with comments and edits.
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Testimonials Section -->
<section class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-3">What Our Users Say</h2>
                <p class="lead text-muted">Join thousands of satisfied users worldwide</p>
            </div>
        </div>

            <div class="row g-4">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="testimonial-card card-custom">
                    <div class="testimonial-content">
                        <div class="stars mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="mb-4">
                            "DocManager has revolutionized how we handle documents. The AI-powered search
                            is incredibly fast and accurate. Highly recommended!"
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="author-info">
                                <h6 class="mb-1">Sarah Johnson</h6>
                                <small class="text-muted">Marketing Director, TechCorp</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial-card card-custom">
                    <div class="testimonial-content">
                        <div class="stars mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="mb-4">
                            "The collaboration features are amazing. Our team can work on documents
                            together in real-time. It's like Google Docs but for enterprise."
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="author-info">
                                <h6 class="mb-1">Michael Chen</h6>
                                <small class="text-muted">Project Manager, InnovateLab</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="testimonial-card card-custom">
                    <div class="testimonial-content">
                        <div class="stars mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="mb-4">
                            "Security was our top concern, and DocManager delivers. The encryption
                            and access controls give us peace of mind."
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="author-info">
                                <h6 class="mb-1">Emily Rodriguez</h6>
                                <small class="text-muted">IT Security Manager, SecureNet</small>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- CTA Section -->
<section class="py-5" style="background: linear-gradient(135deg, #343a40 0%, #495057 100%); color: white;">
        <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <h2 class="display-6 fw-bold mb-3">Ready to Get Started?</h2>
                <p class="lead mb-4">
                    Join thousands of users who trust DocManager for their document management needs.
                    Start your free trial today!
                </p>
                <div class="cta-features">
                    <div class="feature-item">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <span>Free 30-day trial</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <span>No credit card required</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <span>Cancel anytime</span>
                    </div>
                </div>
                </div>
            <div class="col-lg-4 text-center" data-aos="fade-left">
                <div class="cta-buttons">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg btn-custom mb-3 w-100">
                        <i class="fas fa-rocket me-2"></i>Start Free Trial
                    </a>
                    <a href="{{ route('frontend.documents') }}" class="btn btn-outline-light btn-lg btn-custom w-100">
                        <i class="fas fa-eye me-2"></i>Browse Documents
                    </a>
                </div>
                </div>
        </div>
        </div>
    </section>

<style>
/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    overflow: hidden;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
}

.particles {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image:
        radial-gradient(circle at 20% 80%, rgba(255,255,255,0.1) 1px, transparent 1px),
        radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 1px, transparent 1px),
        radial-gradient(circle at 40% 40%, rgba(255,255,255,0.1) 1px, transparent 1px);
    background-size: 50px 50px, 30px 30px, 40px 40px;
    animation: float 20s ease-in-out infinite;
}

.floating-shapes {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

.shape {
    position: absolute;
    border-radius: 50%;
    background: rgba(255,255,255,0.1);
    animation: float 6s ease-in-out infinite;
}

.shape-1 {
    width: 100px;
    height: 100px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.shape-2 {
    width: 60px;
    height: 60px;
    top: 60%;
    right: 20%;
    animation-delay: 2s;
}

.shape-3 {
    width: 80px;
    height: 80px;
    bottom: 20%;
    left: 20%;
    animation-delay: 4s;
}

.shape-4 {
    width: 40px;
    height: 40px;
    top: 30%;
    right: 10%;
    animation-delay: 6s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

.hero-content {
    position: relative;
    z-index: 2;
}

.text-gradient {
    background: linear-gradient(135deg, #ffd700, #ffed4e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-visual {
    position: relative;
    height: 400px;
}

.floating-card {
    position: absolute;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 15px;
    padding: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: white;
    animation: float 4s ease-in-out infinite;
}

.card-1 {
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.card-2 {
    top: 40%;
    right: 20%;
    animation-delay: 1s;
}

.card-3 {
    bottom: 30%;
    left: 20%;
    animation-delay: 2s;
}

.card-4 {
    bottom: 20%;
    right: 10%;
    animation-delay: 3s;
}

/* Feature Cards */
.feature-card {
    text-align: center;
    padding: 2rem;
    transition: all 0.3s ease;
}

.feature-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
    font-size: 2rem;
    transition: all 0.3s ease;
}

.feature-card:hover .feature-icon {
    transform: scale(1.1) rotate(5deg);
}

.feature-highlights {
    margin-top: 1rem;
}

/* Statistics */
.stat-card {
    padding: 2rem;
    text-align: center;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 1.5rem;
}

.counter {
    font-size: 3rem;
    margin-bottom: 0.5rem;
}

/* Step Cards */
.step-card {
    padding: 2rem;
    position: relative;
}

.step-number {
    position: absolute;
    top: -20px;
    left: 50%;
    transform: translateX(-50%);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.2rem;
}

.step-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 2rem auto 1.5rem;
    color: white;
    font-size: 2rem;
}

/* Testimonials */
.testimonial-card {
    padding: 2rem;
    height: 100%;
}

.testimonial-content {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.stars {
    font-size: 1.2rem;
}

.testimonial-author {
    display: flex;
    align-items: center;
    margin-top: auto;
}

.author-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 1rem;
}

/* CTA Section */
.cta-features {
    margin-bottom: 2rem;
}

.feature-item {
    margin-bottom: 0.5rem;
    font-size: 1.1rem;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-visual {
        height: 300px;
    }

    .floating-card {
        font-size: 0.9rem;
        padding: 0.5rem;
    }

    .display-3 {
        font-size: 2.5rem;
    }
}
</style>

<script>
// Counter animation
function animateCounter(element) {
    const target = parseInt(element.getAttribute('data-target'));
    const duration = 2000;
    const step = target / (duration / 16);
    let current = 0;

    const timer = setInterval(() => {
        current += step;
        if (current >= target) {
            current = target;
            clearInterval(timer);
        }
        element.textContent = Math.floor(current);
    }, 16);
}

// Intersection Observer for counter animation
const observerOptions = {
    threshold: 0.5,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const counters = entry.target.querySelectorAll('.counter');
            counters.forEach(counter => {
                animateCounter(counter);
            });
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observe statistics section
document.addEventListener('DOMContentLoaded', function() {
    const statsSection = document.querySelector('.stat-card').parentElement.parentElement;
    observer.observe(statsSection);
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Parallax effect for hero section
window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const parallax = document.querySelector('.hero-section');
    const speed = scrolled * 0.5;

    if (parallax) {
        parallax.style.transform = `translateY(${speed}px)`;
    }
});

// Add hover effects to feature cards
document.querySelectorAll('.feature-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-10px) scale(1.02)';
    });

    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
    });
});
</script>
@endsection
