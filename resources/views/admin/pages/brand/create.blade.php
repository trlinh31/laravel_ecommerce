@extends('admin.layouts.master')
@section('title', 'Create new brand')
@section('admin_content')
  <main class="main">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between mb-5">
        <h2 class="main-title mb-0">@yield('title')</h2>
      </div>
      <form action="{{ route('admin.brands.store') }}"
        method="POST">
        @csrf
        <div class="row">
          <div class="col-6">
            <div class="mb-3">
              <p class="form-label"><span class="text-danger">*</span> Brand name</p>
              <input class="form-input"
                name="name"
                type="text"
                placeholder="Enter brand name"
                value="{{ old('name') }}">
              @error('name')
                <strong class="text-danger">{{ $message }}</strong>
              @enderror
            </div>
          </div>
        </div>
        <div>
          <a href="{{ route('admin.brands.index') }}"
            class="btn btn-outline-primary">Cancel</a>
          <button type="submit"
            class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </main>
@endsection
