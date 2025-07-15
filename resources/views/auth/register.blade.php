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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
