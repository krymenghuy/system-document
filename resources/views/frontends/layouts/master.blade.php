<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>system management document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
     body {
    background: linear-gradient(135deg, #c4e1ed, #e0f7fa); /* Soft gradient from light blue to mint */
    font-family: 'Arial', sans-serif;
    color: #333; /* A subtle dark gray for text to provide contrast */
    margin: 0;
    padding: 0;
}
      .bg-primary {
      background-color: #0d6efd !important; /* Primary blue */
    }
    .bg-light {
      background-color: #f8f9fa !important; /* Light grey */
    }
    .bg-dark {
      background-color: #212529 !important; /* Dark grey */
    }
    .navbar-nav .nav-link {
    transition: color 0.3s ease; /* Smooth transition */
  }

  .navbar-nav .nav-link:hover {
    color: #f1faee; /* Light color on hover */
    text-decoration: underline; /* Optional underline effect */
  }
    .text-primary {
      color: #0d6efd !important; /* Primary blue */
    }
    .btn-primary {
      background-color: #0d6efd; /* Custom primary blue */
      border: none;
    }
    .btn-primary:hover {
      background-color: #084298;
    }
    footer p {
      margin: 0;
    }
    .card {
      border: none;
      border-radius: 10px;
    }
    .card-title {
      font-weight: bold;
    }
    .rounded-pill {
      border-radius: 50rem !important;
    }
    textarea:focus, input:focus {
      border-color: #0d6efd;
      box-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
    }
    </style>
    @stack('css')
  </head>
  <body>
    @include('frontends.layouts.navbar')
    {{-- <h1>Hello, world!</h1> --}}
    <div class="row">
        <div class="col-12 bg-light">
            <div class="container  bg-light"> 
                @yield('content')
                @include('frontends.alerts.index')
               </div>
        </div>
    </div>

  


 @include('frontends.layouts.login')   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
@stack('js')
  </body>
</html>