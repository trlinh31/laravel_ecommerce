@extends('admin.layouts.master')
@section('title', 'Update user')
@section('admin_content')
  <main class="main">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between mb-5">
        <h2 class="main-title mb-0">@yield('title')</h2>
      </div>
      <form action="{{ route('admin.users.update', ['id' => $user->id]) }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-6">
            <div class="image-wrapper">
              <label for="upload-button1"
                class="form-label"><span class="text-danger">*</span> Image 1</label>
              <figure class="image-container"
                style="height: 400px;">
                <img id="imagePreview1"
                  src="{{ asset('images/' . $user->avatar) }}" />
                <label for="upload-button1"
                  class="upload-label text-muted fs-1">
                  <i class="fa-solid fa-plus"></i>
                </label>
              </figure>
              <input hidden
                type="file"
                id="upload-button1"
                name="images"
                accept="image/*"
                onchange="previewImage(event, 1)">
            </div>
            @error('avatar')
              <strong class="text-danger">{{ $message }}</strong>
            @enderror
          </div>
          <div class="col-6">
            <div class="mb-3">
              <p class="form-label"><span class="text-danger">*</span> Full name</p>
              <input class="form-input"
                name="name"
                type="text"
                placeholder="Enter your name"
                value="{{ $user->name }}">
              @error('name')
                <strong class="text-danger">{{ $message }}</strong>
              @enderror
            </div>
            <div class="mb-3">
              <p class="form-label"><span class="text-danger">*</span> Email</p>
              <input class="form-input"
                type="text"
                name="email"
                placeholder="Enter your email"
                value="{{ $user->email }}">
              @error('email')
                <strong class="text-danger">{{ $message }}</strong>
              @enderror
            </div>
            <div class="mb-3">
              <p class="form-label"><span class="text-danger">*</span> Role</p>
              <select name="role"
                class="form-input">
                <option value="1"
                  {{ $user->role == 1 ? 'selected' : null }}>Admin</option>
                <option value="0"
                  {{ $user->role == 0 ? 'selected' : null }}>User</option>
              </select>
            </div>
            <div class="mt-3">
              <a href="{{ route('admin.users.index') }}"
                class="btn btn-outline-primary">Cancel</a>
              <button type="submit"
                class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
@endsection
