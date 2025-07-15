<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/adminlte.min.css')}}">
  @stack('css')

    <style>
    /* Custom styles for better spacing */
    .content-wrapper {
      margin-left: 250px;
      transition: margin-left 0.3s ease-in-out;
    }

    .sidebar-mini .content-wrapper {
      margin-left: 4.6rem;
    }

    .content {
      padding: 20px;
      min-height: calc(100vh - 60px);
    }

    .container-fluid {
      padding: 0 15px;
    }

    /* Improve sidebar spacing */
    .main-sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      z-index: 1038;
    }

    /* Navbar spacing */
    .main-header {
      margin-left: 250px;
      transition: margin-left 0.3s ease-in-out;
    }

    .sidebar-mini .main-header {
      margin-left: 4.6rem;
    }

    /* Company page specific styles */
    .hero-section,
    .edit-hero-section {
      margin: -20px -15px 20px -15px;
      padding: 40px 20px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-radius: 0;
    }

    /* Better responsive behavior */
    @media (max-width: 768px) {
      .content-wrapper,
      .main-header {
        margin-left: 0;
      }

      .sidebar-mini .content-wrapper,
      .sidebar-mini .main-header {
        margin-left: 0;
      }

      .hero-section,
      .edit-hero-section {
        margin: -20px -15px 20px -15px;
        padding: 20px 15px;
      }
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include('backends.layouts.navbar')
  @include('backends.layouts.sidebar')
  <div class="content-wrapper">
    <div class="content">
      <div class="container-fluid">
        @include('backends.alerts.index')
        @yield('content')
      </div>
    </div>
  </div>
  @include('backends.layouts.footer')
</div>
<!-- jQuery -->
<script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist/js/adminlte.min.js')}}"></script>
@stack('js')
</body>
</html>
