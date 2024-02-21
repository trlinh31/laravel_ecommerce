@extends('auth.layouts.master')
@section('title', 'Sign Up')
@section('auth_content')
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
          class="img-fluid"
          alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <form action="{{ route('auth.signup.post') }}"
          method="POST">
          @csrf
          <!-- Name input -->
          <div class="form-outline mb-4">
            <label class="form-label"
              for="name">Full name</label>
            <input type="text"
              name="name"
              id="name"
              class="form-control form-control-lg @error('name') is-invalid @enderror"
              value="{{ old('name') }}" />
            @error('name')
              <strong class="text-danger">{{ $message }}</strong>
            @enderror
          </div>

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

          <!-- Confirm input -->
          <div class="form-outline mb-4">
            <label class="form-label"
              for="password-confirm">Confirm password</label>
            <input type="password"
              name="password_confirmation"
              id="password-confirm"
              class="form-control form-control-lg" />
          </div>

          <!-- Submit button -->
          <button type="submit"
            class="btn btn-success btn-lg btn-block w-100">Sign up</button>
        </form>
      </div>
    </div>
  </div>
@endsection
