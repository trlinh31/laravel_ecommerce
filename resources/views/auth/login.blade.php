@extends('auth.layouts.master')
@section('title', 'Sign In')
@section('auth_content')
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
          class="img-fluid"
          alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        @if (session('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
        @endif
        <form action="{{ route('auth.login.post') }}"
          method="POST">
          @csrf
          <!-- Email input -->
          <div class="form-outline mb-4">
            <label class="form-label"
              for="email">Email</label>
            <input type="text"
              name="email"
              id="email"
              class="form-control form-control-lg @error('email') is-invalid @enderror"
              value="{{ old('email') }}" />
            @error('email')
              <strong class="text-danger">{{ $message }}</strong>
            @enderror
          </div>

          <!-- Password input -->
          <div class="form-outline mb-4">
            <label class="form-label"
              for="password">Password</label>
            <input type="password"
              name="password"
              id="password"
              class="form-control form-control-lg @error('password') is-invalid @enderror" />
            @error('password')
              <strong class="text-danger">{{ $message }}</strong>
            @enderror
          </div>

          <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- Checkbox -->
            <div class="form-check">
              <input class="form-check-input"
                type="checkbox"
                value=""
                id="remember" />
              <label class="form-check-label"
                for="remember"> Remember me </label>
            </div>
            @if (Route::has('auth.forgot'))
              <a href="#!">Forgot password?</a>
            @endif
          </div>

          <!-- Submit button -->
          <button type="submit"
            class="btn btn-success btn-lg btn-block w-100">Sign in</button>

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
          </div>
          <a class="btn btn-primary btn-lg w-100 border-0"
            style="background-color: #D6503E"
            href="{{ route('auth.google.index') }}"
            role="button">
            <i class="fa-brands fa-google me-2"></i>Continue with Gmail</a>

          <p class="text-center pt-3">Do not have an account? <a href="{{ route('auth.signup') }}">Sign up</a></p>
        </form>
      </div>
    </div>
  </div>
@endsection
