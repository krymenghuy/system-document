@extends('backends.layouts.master')
@section('title', 'Edit Company Information - Admin Panel')

@section('content')
    <!-- Hero Section -->
    <div class="edit-hero-section">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <h1 class="hero-title">
                            <i class="fas fa-edit me-3"></i>
                            Edit Company Information
                        </h1>
                        <p class="hero-subtitle">Update your company details and branding to reflect your organization's identity</p>
                    </div>
                </div>
                <div class="col-lg-4 text-end">
                    <a href="{{ route('admin.company') }}" class="btn btn-outline-light btn-hero">
                        <i class="fas fa-arrow-left me-2"></i>Back to Company
                    </a>
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
            <!-- Edit Form -->
            <div class="col-lg-8">
                <div class="glass-card edit-form-card">
                    <div class="card-header-glass">
                        <h3 class="card-title">
                            <i class="fas fa-building me-2"></i>
                            Company Details
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.company.update') }}" method="POST" enctype="multipart/form-data" id="companyForm">
                            @csrf

                            <!-- Logo Upload Section -->
                            <div class="logo-upload-section mb-4">
                                <div class="upload-area" id="uploadArea">
                                    <div class="upload-content">
                                        <div class="upload-icon">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </div>
                                        <h5>Upload Company Logo</h5>
                                        <p>Drag and drop your logo here or click to browse</p>
                                        <input type="file"
                                               id="photo"
                                               name="photo"
                                               accept="image/*"
                                               class="file-input"
                                               style="display: none;">
                                        <button type="button" class="btn btn-primary btn-upload" onclick="document.getElementById('photo').click()">
                                            Choose File
                                        </button>
                                    </div>
                                    <div class="upload-preview" id="uploadPreview" style="display: none;">
                                        <img id="previewImage" src="" alt="Logo Preview" class="preview-img">
                                        <button type="button" class="btn btn-sm btn-outline-danger remove-upload" onclick="removeUpload()">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <small class="form-text text-muted">
                                    Recommended: 200x200px, JPG, PNG, or GIF format
                                </small>
                            </div>

                            <!-- Form Fields -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="name" class="form-label">
                                            <i class="fas fa-building me-2"></i>Company Name *
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-modern"
                                               id="name"
                                               name="name"
                                               value="{{ $company->name ?? '' }}"
                                               required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email" class="form-label">
                                            <i class="fas fa-envelope me-2"></i>Email Address
                                        </label>
                                        <input type="email"
                                               class="form-control form-control-modern"
                                               id="email"
                                               name="email"
                                               value="{{ $company->email ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="phone" class="form-label">
                                            <i class="fas fa-phone me-2"></i>Phone Number
                                        </label>
                                        <input type="text"
                                               class="form-control form-control-modern"
                                               id="phone"
                                               name="phone"
                                               value="{{ $company->phone ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="website" class="form-label">
                                            <i class="fas fa-globe me-2"></i>Website
                                        </label>
                                        <input type="url"
                                               class="form-control form-control-modern"
                                               id="website"
                                               name="website"
                                               value="{{ $company->website ?? '' }}"
                                               placeholder="https://example.com">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="address" class="form-label">
                                            <i class="fas fa-map-marker-alt me-2"></i>Address
                                        </label>
                                        <textarea class="form-control form-control-modern"
                                                  id="address"
                                                  name="address"
                                                  rows="3">{{ $company->address ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <div class="form-group">
                                        <label for="description" class="form-label">
                                            <i class="fas fa-align-left me-2"></i>Description
                                        </label>
                                        <textarea class="form-control form-control-modern"
                                                  id="description"
                                                  name="description"
                                                  rows="4">{{ $company->description ?? '' }}</textarea>
                                        <small class="form-text text-muted">
                                            Brief description of your company and services
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <a href="{{ route('admin.company') }}" class="btn btn-secondary btn-modern">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary btn-modern">
                                    <i class="fas fa-save me-2"></i>Update Company
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Live Preview -->
            <div class="col-lg-4">
                <div class="glass-card preview-card">
                    <div class="card-header-glass">
                        <h4 class="card-title">
                            <i class="fas fa-eye me-2"></i>
                            Live Preview
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="preview-content">
                            <div class="preview-logo-section text-center mb-4">
                                                                    <div id="previewLogo" class="preview-logo">
                                        @if($company && $company->photo)
                                            <img src="{{ asset($company->photo) }}" alt="Company Logo" class="preview-logo-img">
                                        @else
                                            <div class="preview-logo-placeholder">
                                                <i class="fas fa-building"></i>
                                            </div>
                                        @endif
                                    </div>
                            </div>
                            <div class="preview-info">
                                <h4 id="previewName" class="preview-title">Company Name</h4>
                                <p id="previewDescription" class="preview-description">Company description will appear here...</p>
                                <div class="preview-contact">
                                    <div class="contact-item">
                                        <i class="fas fa-envelope text-primary"></i>
                                        <span id="previewEmail">email@example.com</span>
                                    </div>
                                    <div class="contact-item">
                                        <i class="fas fa-phone text-success"></i>
                                        <span id="previewPhone">+1 (555) 123-4567</span>
                                    </div>
                                    <div class="contact-item">
                                        <i class="fas fa-globe text-info"></i>
                                        <span id="previewWebsite">https://example.com</span>
                                    </div>
                                    <div class="contact-item">
                                        <i class="fas fa-map-marker-alt text-warning"></i>
                                        <span id="previewAddress">Company address</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tips Card -->
                <div class="glass-card tips-card mt-4">
                    <div class="card-header-glass">
                        <h4 class="card-title">
                            <i class="fas fa-lightbulb me-2"></i>
                            Tips
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="tips-list">
                            <div class="tip-item">
                                <div class="tip-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="tip-content">
                                    <h6>High-Quality Logo</h6>
                                    <p>Use a clear, high-resolution logo (200x200px recommended)</p>
                                </div>
                            </div>
                            <div class="tip-item">
                                <div class="tip-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="tip-content">
                                    <h6>Complete Information</h6>
                                    <p>Fill in all contact details for better user experience</p>
                                </div>
                            </div>
                            <div class="tip-item">
                                <div class="tip-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="tip-content">
                                    <h6>Clear Description</h6>
                                    <p>Write a compelling description of your company</p>
                                </div>
                            </div>
                            <div class="tip-item">
                                <div class="tip-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="tip-content">
                                    <h6>Valid Website</h6>
                                    <p>Ensure your website URL is correct and accessible</p>
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
/* Edit Hero Section */
.edit-hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 2rem 0;
    color: white;
    position: relative;
    overflow: hidden;
}

.edit-hero-section::before {
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

.hero-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.hero-subtitle {
    font-size: 1rem;
    opacity: 0.9;
    margin: 0;
}

.btn-hero {
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

.card-body {
    padding: 2rem;
}

/* Logo Upload Section */
.logo-upload-section {
    border: 2px dashed #dee2e6;
    border-radius: 15px;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    background: rgba(0,0,0,0.02);
}

.logo-upload-section:hover {
    border-color: #667eea;
    background: rgba(102, 126, 234, 0.05);
}

.upload-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}

.upload-icon {
    font-size: 3rem;
    color: #667eea;
    margin-bottom: 1rem;
}

.upload-content h5 {
    margin: 0;
    color: #495057;
    font-weight: 600;
}

.upload-content p {
    margin: 0;
    color: #6c757d;
    font-size: 0.9rem;
}

.btn-upload {
    border-radius: 25px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.upload-preview {
    position: relative;
    display: inline-block;
}

.preview-img {
    width: 150px;
    height: 150px;
    border-radius: 15px;
    object-fit: cover;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.remove-upload {
    position: absolute;
    top: -10px;
    right: -10px;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #dc3545;
    color: white;
    border: none;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

/* Form Controls */
.form-control-modern {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: rgba(255,255,255,0.9);
}

.form-control-modern:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    background: white;
}

.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
    display: block;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-group {
    margin-bottom: 1.5rem;
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    padding-top: 2rem;
    border-top: 1px solid #e9ecef;
    margin-top: 2rem;
}

.btn-modern {
    border-radius: 25px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Preview Section */
.preview-content {
    text-align: center;
}

.preview-logo {
    margin-bottom: 1.5rem;
}

.preview-logo-img {
    width: 120px;
    height: 120px;
    border-radius: 20px;
    object-fit: cover;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    border: 3px solid #f8f9fa;
}

.preview-logo-placeholder {
    width: 120px;
    height: 120px;
    border-radius: 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: white;
    margin: 0 auto;
}

.preview-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #495057;
    margin-bottom: 1rem;
}

.preview-description {
    color: #6c757d;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.preview-contact {
    text-align: left;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.75rem;
    padding: 0.5rem;
    background: rgba(0,0,0,0.02);
    border-radius: 8px;
}

.contact-item i {
    width: 20px;
    text-align: center;
}

.contact-item span {
    color: #6c757d;
    font-size: 0.9rem;
}

/* Tips Section */
.tips-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.tip-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 1rem;
    background: rgba(0,0,0,0.02);
    border-radius: 12px;
    transition: all 0.3s ease;
}

.tip-item:hover {
    background: rgba(0,0,0,0.05);
    transform: translateX(5px);
}

.tip-icon {
    width: 30px;
    height: 30px;
    border-radius: 8px;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    flex-shrink: 0;
}

.tip-content h6 {
    margin: 0 0 0.25rem 0;
    font-weight: 600;
    color: #495057;
    font-size: 0.9rem;
}

.tip-content p {
    margin: 0;
    color: #6c757d;
    font-size: 0.8rem;
    line-height: 1.4;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 1.5rem;
    }

    .form-actions {
        flex-direction: column;
    }

    .preview-logo-img,
    .preview-logo-placeholder {
        width: 100px;
        height: 100px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // File upload handling
    const fileInput = document.getElementById('photo');
    const uploadArea = document.getElementById('uploadArea');
    const uploadContent = uploadArea.querySelector('.upload-content');
    const uploadPreview = document.getElementById('uploadPreview');
    const previewImage = document.getElementById('previewImage');
    const previewLogo = document.getElementById('previewLogo');

    // Drag and drop functionality
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.style.borderColor = '#667eea';
        uploadArea.style.background = 'rgba(102, 126, 234, 0.1)';
    });

    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        uploadArea.style.borderColor = '#dee2e6';
        uploadArea.style.background = 'rgba(0,0,0,0.02)';
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            handleFile(files[0]);
        }
        uploadArea.style.borderColor = '#dee2e6';
        uploadArea.style.background = 'rgba(0,0,0,0.02)';
    });

    fileInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            handleFile(e.target.files[0]);
        }
    });

    function handleFile(file) {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                uploadContent.style.display = 'none';
                uploadPreview.style.display = 'block';

                // Update preview logo
                previewLogo.innerHTML = `<img src="${e.target.result}" alt="Company Logo" class="preview-logo-img">`;
            };
            reader.readAsDataURL(file);
        } else {
            alert('Please select an image file.');
        }
    }

    function removeUpload() {
        fileInput.value = '';
        uploadContent.style.display = 'flex';
        uploadPreview.style.display = 'none';

        // Reset preview logo
        previewLogo.innerHTML = `<div class="preview-logo-placeholder"><i class="fas fa-building"></i></div>`;
    }

    // Live preview functionality
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');
    const websiteInput = document.getElementById('website');
    const addressInput = document.getElementById('address');
    const descriptionInput = document.getElementById('description');

    // Update preview on input change
    nameInput.addEventListener('input', function() {
        document.getElementById('previewName').textContent = this.value || 'Company Name';
    });

    emailInput.addEventListener('input', function() {
        document.getElementById('previewEmail').textContent = this.value || 'email@example.com';
    });

    phoneInput.addEventListener('input', function() {
        document.getElementById('previewPhone').textContent = this.value || '+1 (555) 123-4567';
    });

    websiteInput.addEventListener('input', function() {
        document.getElementById('previewWebsite').textContent = this.value || 'https://example.com';
    });

    addressInput.addEventListener('input', function() {
        document.getElementById('previewAddress').textContent = this.value || 'Company address';
    });

    descriptionInput.addEventListener('input', function() {
        document.getElementById('previewDescription').textContent = this.value || 'Company description will appear here...';
    });

    // Form validation
    const form = document.getElementById('companyForm');
    form.addEventListener('submit', function(e) {
        const name = nameInput.value.trim();
        if (!name) {
            e.preventDefault();
            alert('Please enter a company name.');
            nameInput.focus();
            return false;
        }
    });
});

// Make removeUpload function global
function removeUpload() {
    const fileInput = document.getElementById('photo');
    const uploadContent = document.querySelector('.upload-content');
    const uploadPreview = document.getElementById('uploadPreview');
    const previewLogo = document.getElementById('previewLogo');

    fileInput.value = '';
    uploadContent.style.display = 'flex';
    uploadPreview.style.display = 'none';

    // Reset preview logo
    previewLogo.innerHTML = `<div class="preview-logo-placeholder"><i class="fas fa-building"></i></div>`;
}
</script>
@endsection
