@extends('backends.layouts.master')
@section('title')
    Dashboard - Document Management System
@endsection
@section('content')

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    .dashboard-container {
        padding: 20px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        margin: 20px;
    }

    .stat-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }

    .bg-gradient-info {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .bg-gradient-warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .bg-gradient-danger {
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        color: #333;
    }

    .bg-gradient-dark {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .bg-gradient-light {
        background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        color: #333;
    }

    .chart-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        backdrop-filter: blur(10px);
    }

    .quick-action-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        backdrop-filter: blur(10px);
    }

    .activity-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        backdrop-filter: blur(10px);
    }

    .analytics-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .analytics-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    }

    .btn-custom {
        border-radius: 25px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .stat-icon {
        font-size: 2.5rem;
        opacity: 0.8;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .recent-activity {
        max-height: 300px;
        overflow-y: auto;
    }

    .activity-item {
        padding: 10px 0;
        border-bottom: 1px solid #eee;
        transition: all 0.3s ease;
    }

    .activity-item:hover {
        background: rgba(102, 126, 234, 0.1);
        border-radius: 8px;
    }

    .progress-custom {
        height: 8px;
        border-radius: 10px;
        background: rgba(0,0,0,0.1);
    }

    .progress-custom .progress-bar {
        border-radius: 10px;
    }

    .chart-container {
        position: relative;
        height: 200px;
        margin: 20px 0;
    }

    .mini-chart {
        height: 60px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        border-radius: 8px;
        position: relative;
        overflow: hidden;
    }

    .chart-line {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: rgba(255,255,255,0.3);
    }

    .chart-point {
        position: absolute;
        width: 4px;
        height: 4px;
        background: white;
        border-radius: 50%;
        bottom: 0;
    }

    .analytics-metric {
        text-align: center;
        padding: 15px;
    }

    .metric-value {
        font-size: 1.8rem;
        font-weight: bold;
        color: #333;
    }

    .metric-label {
        font-size: 0.8rem;
        color: #666;
        margin-top: 5px;
    }

    .trend-indicator {
        font-size: 0.7rem;
        padding: 2px 8px;
        border-radius: 10px;
        margin-left: 5px;
    }

    .trend-up {
        background: rgba(40, 167, 69, 0.2);
        color: #28a745;
    }

    .trend-down {
        background: rgba(220, 53, 69, 0.2);
        color: #dc3545;
    }
</style>

<div class="dashboard-container">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="chart-card p-4">
                <h2 class="text-primary mb-0">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    Welcome to Document Management System
                </h2>
                <p class="text-muted mb-0">Manage your documents, users, and system efficiently</p>
            </div>
        </div>
    </div>

    <!-- Statistics Cards Row 1 -->
    <div class="row g-4 mb-4">
        <!-- Total Users -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card card bg-gradient-primary text-white">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-number">{{ $total_User }}</div>
                            <div class="stat-label">Total Users</div>
                        </div>
                        <i class="fas fa-users stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Documents -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card card bg-gradient-success text-white">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-number">{{ $total_Document }}</div>
                            <div class="stat-label">Total Documents</div>
                        </div>
                        <i class="fas fa-file-alt stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card card bg-gradient-info text-white">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-number">{{ $total_DocumentCategory }}</div>
                            <div class="stat-label">Categories</div>
                        </div>
                        <i class="fas fa-folder stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Roles -->
        <div class="col-lg-3 col-md-6">
            <div class="stat-card card bg-gradient-warning text-white">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-number">{{ $total_Role }}</div>
                            <div class="stat-label">User Roles</div>
                        </div>
                        <i class="fas fa-user-shield stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Cards Row -->
    <div class="row g-4 mb-4">
        <!-- Document Upload Analytics -->
        <div class="col-lg-3 col-md-6">
            <div class="analytics-card p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h6 class="text-muted mb-1">Document Uploads</h6>
                        <h3 class="mb-0">2,847</h3>
                        <span class="trend-indicator trend-up">+12.5%</span>
                    </div>
                    <i class="fas fa-upload text-primary" style="font-size: 1.5rem;"></i>
                </div>
                <div class="mini-chart">
                    <div class="chart-line"></div>
                    <div class="chart-point" style="left: 10%; bottom: 20%;"></div>
                    <div class="chart-point" style="left: 30%; bottom: 40%;"></div>
                    <div class="chart-point" style="left: 50%; bottom: 60%;"></div>
                    <div class="chart-point" style="left: 70%; bottom: 80%;"></div>
                    <div class="chart-point" style="left: 90%; bottom: 90%;"></div>
                </div>
            </div>
        </div>

        <!-- User Activity Analytics -->
        <div class="col-lg-3 col-md-6">
            <div class="analytics-card p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h6 class="text-muted mb-1">Active Users</h6>
                        <h3 class="mb-0">1,234</h3>
                        <span class="trend-indicator trend-up">+8.3%</span>
                    </div>
                    <i class="fas fa-users text-success" style="font-size: 1.5rem;"></i>
                </div>
                <div class="mini-chart">
                    <div class="chart-line"></div>
                    <div class="chart-point" style="left: 15%; bottom: 30%;"></div>
                    <div class="chart-point" style="left: 35%; bottom: 50%;"></div>
                    <div class="chart-point" style="left: 55%; bottom: 70%;"></div>
                    <div class="chart-point" style="left: 75%; bottom: 85%;"></div>
                    <div class="chart-point" style="left: 95%; bottom: 95%;"></div>
                </div>
            </div>
        </div>

        <!-- Storage Analytics -->
        <div class="col-lg-3 col-md-6">
            <div class="analytics-card p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h6 class="text-muted mb-1">Storage Used</h6>
                        <h3 class="mb-0">75%</h3>
                        <span class="trend-indicator trend-down">-2.1%</span>
                    </div>
                    <i class="fas fa-hdd text-warning" style="font-size: 1.5rem;"></i>
                </div>
                <div class="mini-chart">
                    <div class="chart-line"></div>
                    <div class="chart-point" style="left: 20%; bottom: 40%;"></div>
                    <div class="chart-point" style="left: 40%; bottom: 60%;"></div>
                    <div class="chart-point" style="left: 60%; bottom: 75%;"></div>
                    <div class="chart-point" style="left: 80%; bottom: 85%;"></div>
                    <div class="chart-point" style="left: 95%; bottom: 90%;"></div>
                </div>
            </div>
        </div>

        <!-- Performance Analytics -->
        <div class="col-lg-3 col-md-6">
            <div class="analytics-card p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h6 class="text-muted mb-1">System Performance</h6>
                        <h3 class="mb-0">98.5%</h3>
                        <span class="trend-indicator trend-up">+1.2%</span>
                    </div>
                    <i class="fas fa-tachometer-alt text-info" style="font-size: 1.5rem;"></i>
                </div>
                <div class="mini-chart">
                    <div class="chart-line"></div>
                    <div class="chart-point" style="left: 10%; bottom: 85%;"></div>
                    <div class="chart-point" style="left: 30%; bottom: 90%;"></div>
                    <div class="chart-point" style="left: 50%; bottom: 95%;"></div>
                    <div class="chart-point" style="left: 70%; bottom: 98%;"></div>
                    <div class="chart-point" style="left: 90%; bottom: 99%;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Analytics Row -->
    <div class="row g-4 mb-4">
        <!-- Document Type Distribution -->
        <div class="col-lg-4">
            <div class="analytics-card p-4">
                <h6 class="fw-bold mb-3">
                    <i class="fas fa-chart-pie me-2 text-primary"></i>
                    Document Types
                </h6>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="analytics-metric">
                            <div class="metric-value text-primary">45%</div>
                            <div class="metric-label">PDF Files</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="analytics-metric">
                            <div class="metric-value text-success">30%</div>
                            <div class="metric-label">Word Docs</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="analytics-metric">
                            <div class="metric-value text-warning">15%</div>
                            <div class="metric-label">Excel Files</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="analytics-metric">
                            <div class="metric-value text-info">10%</div>
                            <div class="metric-label">Others</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Activity Timeline -->
        <div class="col-lg-4">
            <div class="analytics-card p-4">
                <h6 class="fw-bold mb-3">
                    <i class="fas fa-clock me-2 text-success"></i>
                    Activity Timeline
                </h6>
                <div class="row g-2">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Morning (6AM-12PM)</span>
                            <span class="badge bg-primary">45%</span>
                        </div>
                        <div class="progress progress-custom mb-3">
                            <div class="progress-bar bg-primary" style="width: 45%"></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Afternoon (12PM-6PM)</span>
                            <span class="badge bg-success">35%</span>
                        </div>
                        <div class="progress progress-custom mb-3">
                            <div class="progress-bar bg-success" style="width: 35%"></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Evening (6PM-12AM)</span>
                            <span class="badge bg-warning">20%</span>
                        </div>
                        <div class="progress progress-custom">
                            <div class="progress-bar bg-warning" style="width: 20%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Health -->
        <div class="col-lg-4">
            <div class="analytics-card p-4">
                <h6 class="fw-bold mb-3">
                    <i class="fas fa-heartbeat me-2 text-danger"></i>
                    System Health
                </h6>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="text-center">
                            <div class="metric-value text-success">99.9%</div>
                            <div class="metric-label">Uptime</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <div class="metric-value text-info">2.3ms</div>
                            <div class="metric-label">Response Time</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <div class="metric-value text-warning">1.2GB</div>
                            <div class="metric-label">Memory Usage</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <div class="metric-value text-primary">45°C</div>
                            <div class="metric-label">CPU Temp</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Activity Section -->
    <div class="row g-4">
        <!-- Chart Section -->
        <div class="col-lg-8">
            <div class="chart-card p-4">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-chart-line me-2 text-primary"></i>
                    System Analytics
                </h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Document Uploads</label>
                            <div class="progress progress-custom">
                                <div class="progress-bar bg-success" style="width: 75%"></div>
                            </div>
                            <small class="text-muted">75% of monthly target</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">User Activity</label>
                            <div class="progress progress-custom">
                                <div class="progress-bar bg-info" style="width: 60%"></div>
                            </div>
                            <small class="text-muted">60% active users</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">System Performance</label>
                            <div class="progress progress-custom">
                                <div class="progress-bar bg-warning" style="width: 90%"></div>
                            </div>
                            <small class="text-muted">90% optimal performance</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Storage Usage</label>
                            <div class="progress progress-custom">
                                <div class="progress-bar bg-danger" style="width: 45%"></div>
                            </div>
                            <small class="text-muted">45% of total storage</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4">
            <div class="quick-action-card p-4">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-bolt me-2 text-warning"></i>
                    Quick Actions
                </h5>
                <div class="d-grid gap-2">
                    @if (checkPermission('document', 'create'))
                    <a href="{{ route('admin.documents.create') }}" class="btn btn-success btn-custom">
                        <i class="fas fa-plus-circle me-2"></i>Add Document
                    </a>
                    @endif

                    @if (checkPermission('user', 'create'))
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-custom">
                        <i class="fas fa-user-plus me-2"></i>Add User
                    </a>
                    @endif

                    @if (checkPermission('document_category', 'create'))
                    <a href="{{ route('admin.document_category.create') }}" class="btn btn-info btn-custom">
                        <i class="fas fa-folder-plus me-2"></i>Add Category
                    </a>
                    @endif

                    @if (checkPermission('role', 'create'))
                    <a href="{{ route('admin.role.create') }}" class="btn btn-warning btn-custom">
                        <i class="fas fa-user-shield me-2"></i>Add Role
                    </a>
                    @endif

                    <a href="{{ route('admin.company') }}" class="btn btn-secondary btn-custom">
                        <i class="fas fa-building me-2"></i>Company Settings
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity and System Info -->
    <div class="row g-4 mt-4">
        <!-- Recent Activity -->
        <div class="col-lg-6">
            <div class="activity-card p-4">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-clock me-2 text-info"></i>
                    Recent Activity
                </h5>
                <div class="recent-activity">
                    <div class="activity-item">
                        <div class="d-flex align-items-center">
                            <div class="bg-success rounded-circle p-2 me-3">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                            <div>
                                <strong>New document uploaded</strong>
                                <br><small class="text-muted">2 minutes ago</small>
                            </div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary rounded-circle p-2 me-3">
                                <i class="fas fa-user-plus text-white"></i>
                            </div>
                            <div>
                                <strong>New user registered</strong>
                                <br><small class="text-muted">15 minutes ago</small>
                            </div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning rounded-circle p-2 me-3">
                                <i class="fas fa-folder-plus text-white"></i>
                            </div>
                            <div>
                                <strong>New category created</strong>
                                <br><small class="text-muted">1 hour ago</small>
                            </div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="d-flex align-items-center">
                            <div class="bg-info rounded-circle p-2 me-3">
                                <i class="fas fa-download text-white"></i>
                            </div>
                            <div>
                                <strong>Document downloaded</strong>
                                <br><small class="text-muted">2 hours ago</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Information -->
        <div class="col-lg-6">
            <div class="activity-card p-4">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-info-circle me-2 text-primary"></i>
                    System Information
                </h5>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="text-center p-3 bg-light rounded">
                            <i class="fas fa-server text-primary mb-2" style="font-size: 1.5rem;"></i>
                            <div><strong>Server Status</strong></div>
                            <small class="text-success">Online</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center p-3 bg-light rounded">
                            <i class="fas fa-database text-info mb-2" style="font-size: 1.5rem;"></i>
                            <div><strong>Database</strong></div>
                            <small class="text-success">Connected</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center p-3 bg-light rounded">
                            <i class="fas fa-shield-alt text-warning mb-2" style="font-size: 1.5rem;"></i>
                            <div><strong>Security</strong></div>
                            <small class="text-success">Protected</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center p-3 bg-light rounded">
                            <i class="fas fa-sync-alt text-secondary mb-2" style="font-size: 1.5rem;"></i>
                            <div><strong>Last Backup</strong></div>
                            <small class="text-muted">2 hours ago</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
