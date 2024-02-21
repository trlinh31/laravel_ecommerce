@extends('admin.layouts.master')
@section('title', 'Update product')
@section('admin_content')
  <main class="main">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between mb-5">
        <h2 class="main-title mb-0">@yield('title')</h2>
      </div>
      <form action="{{ route('admin.products.update', ['id' => $product->id]) }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-6"
            style="height: max-content;">
            <div class="mb-3">
              <p class="form-label"><span class="text-danger">*</span> Brand</p>
              <select name="brand"
                class="form-input">
                <option value="">Select</option>
                @foreach ($brands as $brand)
                  <option value="{{ $brand->id }}"
                    {{ $product->brand_id == $brand->id ? 'selected' : false }}>
                    {{ $brand->name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <p class="form-label"><span class="text-danger">*</span> Category</p>
              <select name="category"
                class="form-input">
                <option value="">Select</option>
                @foreach ($product_cates as $product_cate)
                  <option value="{{ $product_cate->id }}"
                    {{ $product->product_category_id == $product_cate->id ? 'selected' : false }}>
                    {{ $product_cate->name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <p class="form-label"><span class="text-danger">*</span> Name</p>
              <input class="form-input"
                name="name"
                type="text"
                placeholder="Enter product name"
                value="{{ $product->name }}">
              @error('name')
                <strong class="text-danger">{{ $message }}</strong>
              @enderror
            </div>
            <div class="mb-3">
              <p class="form-label">Description</p>
              <textarea id="editor"
                name="description">
                {!! $product->description !!}
              </textarea>
            </div>
            <div class="mb-3">
              <p class="form-label"><span class="text-danger">*</span> Price</p>
              <input class="form-input"
                name="price"
                type="text"
                id="price"
                placeholder="Enter product price"
                value="{{ $product->price }}">
              @error('price')
                <strong class="text-danger">{{ $message }}</strong>
              @enderror
            </div>
            <div class="mb-3">
              <p class="form-label">Discount</p>
              <input class="form-input"
                name="discount"
                type="number"
                min="0"
                max="100"
                placeholder="Enter product discount"
                value="{{ $product->discount }}">
            </div>
            <div class="mb-3">
              <p class="form-label"><span class="text-danger">*</span> Quantity</p>
              <input class="form-input"
                name="qty"
                type="number"
                min="0"
                placeholder="Enter product qty"
                value="{{ $product->qty }}">
              @error('qty')
                <strong class="text-danger">{{ $message }}</strong>
              @enderror
            </div>
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input"
                  type="checkbox"
                  name="featured"
                  value="1"
                  {{ $product->featured ? 'checked' : false }}
                  id="featured">
                <label class="form-check-label form-label"
                  for="featured">
                  Featured
                </label>
              </div>
            </div>
            <div>
              <a href="{{ route('admin.products.index') }}"
                class="btn btn-outline-primary">Cancel</a>
              <button type="submit"
                class="btn btn-primary">Submit</button>
            </div>
          </div>
          <div class="col-6">
            <div class="mb-3">
              <div class="image-wrapper">
                <label for="upload-button1"
                  class="form-label"><span class="text-danger">*</span> Image 1</label>
                <figure class="image-container"
                  style="height: 400px;">
                  <img id="imagePreview1"
                    src="{{ asset('images/' . $product->product_images[0]->path) }}" />
                  <label for="upload-button1"
                    class="upload-label text-muted fs-1">
                    <i class="fa-solid fa-plus"></i>
                  </label>
                </figure>
                <input hidden
                  type="file"
                  id="upload-button1"
                  name="images[]"
                  accept="image/*"
                  onchange="previewImage(event, 1)">
              </div>
              @error('images')
                <strong class="text-danger">{{ $message }}</strong>
              @enderror
            </div>
            <div class="mb-3">
              <div class="image-wrapper">
                <label for="upload-button2"
                  class="form-label"><span class="text-danger">*</span> Image 2</label>
                <figure class="image-container"
                  style="height: 400px;">
                  <img id="imagePreview2"
                    src="{{ asset('images/' . $product->product_images[1]->path) }}" />
                  <label for="upload-button2"
                    class="upload-label text-muted fs-1">
                    <i class="fa-solid fa-plus"></i>
                  </label>
                </figure>
                <input hidden
                  type="file"
                  id="upload-button2"
                  name="images[]"
                  accept="image/*"
                  onchange="previewImage(event, 2)">
              </div>
              @error('images')
                <strong class="text-danger">{{ $message }}</strong>
              @enderror
            </div>
            <div class="mb-3">
              <div class="image-wrapper">
                <label for="upload-button3"
                  class="form-label"><span class="text-danger">*</span> Image 3</label>
                <figure class="image-container"
                  style="height: 400px;">
                  <img id="imagePreview3"
                    src="{{ asset('images/' . $product->product_images[2]->path) }}" />
                  <label for="upload-button3"
                    class="upload-label text-muted fs-1">
                    <i class="fa-solid fa-plus"></i>
                  </label>
                </figure>
                <input hidden
                  type="file"
                  id="upload-button3"
                  name="images[]"
                  accept="image/*"
                  onchange="previewImage(event, 3)">
              </div>
              @error('images')
                <strong class="text-danger">{{ $message }}</strong>
              @enderror
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
@endsection
