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
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @stack('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include('backends.layouts.navbar')
  @include('backends.layouts.sidebar')
  <div class="content-wrapper">
    <div class="content pt-4">
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
