@extends('backends.layouts.master')
@section('title')
    Home page
@endsection
@section('content')
<style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f8f9fa;
    }
    .card-custom {
      border: none;
      border-radius: 12px;
      overflow: hidden;
    }
    .bg-gradient-primary {
      background: linear-gradient(135deg, #4e73df, #224abe);
      color: white;
    }
    .bg-gradient-success {
      background: linear-gradient(135deg, #1cc88a, #0f7c5e);
      color: white;
    }
    .bg-gradient-secondary {
      background: linear-gradient(135deg, #858796, #343a40);
      color: white;
    }
    .chart-placeholder {
      height: 300px;
      background: linear-gradient(135deg, #e3f2fd, #bbdefb);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #555;
      border-radius: 12px;
    }
    .quick-actions .btn {
      border-radius: 50px;
    }
    .quick-actions .btn i {
      margin-right: 5px;
    }
  </style>
 <!-- Statistics Row -->
<div class="row g-4">
    <!-- Total Users -->
    <div class="col-md-4">
      <div class="card shadow-sm bg-gradient-primary text-white">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h2>{{ $total_User }}</h2>
              <p class="mb-0">Total Users</p>
            </div>
            <i class="bi bi-people-fill fs-1"></i>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Total Documents -->
    <div class="col-md-4">
      <div class="card shadow-sm bg-gradient-success text-white">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h2>{{ $total_Document }}</h2>
              <p class="mb-0">Total Documents</p>
            </div>
            <i class="bi bi-file-earmark-fill fs-1"></i>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Total Roles -->
    <div class="col-md-4">
      <div class="card shadow-sm bg-gradient-secondary text-white">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h2>{{ $total_Role }}</h2>
              <p class="mb-0">Total Roles</p>
            </div>
            <i class="bi bi-shield-lock-fill fs-1"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Activity and Charts -->
  <div class="row mt-5">
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="fw-bold">Activity Overview</h5>
          <div class="chart-placeholder">
            <p>Add your chart library (e.g., Chart.js) here</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="fw-bold">Quick Actions</h5>
          <div class="quick-actions">
            <button class="btn btn-primary w-100 my-2"><i class="bi bi-person-plus-fill"></i> Add User</button>
            <button class="btn btn-success w-100 my-2"><i class="bi bi-upload"></i> Upload Document</button>
            <button class="btn btn-secondary w-100 my-2"><i class="bi bi-gear-fill"></i> Manage Roles</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
