@extends('layouts.app')

@section('content')
<style>
  body {
    background: linear-gradient(135deg, #ff7eb3, #6a11cb);
    color: #ffffff;
        font-family: 'Poppins', sans-serif;
        height: 50vh; 
    }

.card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 15px 25px rgba(0, 0, 0, 0.3);
    overflow: hidden;
}

.card-header {
    background: linear-gradient(135deg, #2575fc, #6a11cb);
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
    color: #ffffff;
    font-size: 1.5rem;
    padding: 1.5rem 0;
    letter-spacing: 1px;
}

.form-control {
    border: 2px solid #ddd;
    border-radius: 12px;
    box-shadow: none;
    transition: all 0.4s ease-in-out;
}

.form-control:focus {
    border-color: #6a11cb;
    box-shadow: 0 0 10px rgba(106, 17, 203, 0.5);
}

.btn-primary {
    background: linear-gradient(135deg, #6a11cb, #ff7eb3);
    border: none;
    border-radius: 50px;
    padding: 0.8rem 2rem;
    font-size: 1.1rem;
    color: #fff;
    transition: all 0.4s ease;
    letter-spacing: 0.5px;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #ff7eb3, #6a11cb);
    box-shadow: 0 5px 15px rgba(106, 17, 203, 0.5);
    transform: translateY(-2px);
}

.form-check-label {
    color: #333;
    font-size: 0.9rem;
}

.forgot-link {
    text-decoration: none;
    color: #6a11cb;
    font-weight: 500;
    transition: color 0.3s ease;
}

.forgot-link:hover {
    color: #ff7eb3;
}

.container {
    width: 100%;
    max-width: 900px;
}

.card-body {
    padding: 2rem;
}

.text-center {
    margin-top: 1rem;
}

</style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center h-100">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                {{ __('Login') }}
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Alerts -->
                    <div class="row mb-3">
                        <div class="col-12">
                            @include('backends.alerts.index')
                        </div>
                    </div>

                    <!-- Username -->
                    <div class="form-group mb-4">
                        <label for="username" class="form-label">{{ __('Username') }}</label>
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                            name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-4">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- <!-- Remember Me -->
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div> --}}

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                    </div>

                    <!-- Forgot Password -->
                    <div class="text-center mt-3">
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
