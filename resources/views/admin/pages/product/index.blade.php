@extends('admin.layouts.master')
@section('title', 'Product management')
@section('admin_content')
  <main class="main">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between mb-5">
        <h2 class="main-title mb-0">@yield('title')</h2>
        <a href="{{ route('admin.products.create') }}"
          class="btn btn-primary shadow">Create New</a>
      </div>
      <table class="table table-hover table-bordered align-middle text-center">
        <thead>
          <tr>
            <th></th>
            <th>Image</th>
            <th>Brand</th>
            <th>Category</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Discount</th>
            <th>Featured</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $i => $product)
            <tr>
              <td>{{ $i + 1 }}</td>
              <td>
                <img src="{{ asset('images/' . $product->product_images[0]->path) }}"
                  class="object-fit-contain"
                  width="100"
                  height="100"
                  alt="...">
              </td>
              <td>{{ $product->brand->name }}</td>
              <td>{{ $product->product_category->name }}</td>
              <td>{{ $product->name }}</td>
              <td>
                <div class="line-clamp">
                  <div>{!! $product->description !!}</div>
                </div>
              </td>
              <td>${{ $product->price }}</td>
              <td>{{ $product->qty }}</td>
              <td>{{ $product->discount }}</td>
              <td>
                @if ($product->featured)
                  <span><i class="fa-solid fa-circle-check text-success"></i></span>
                @else
                  <span><i class="fa-solid fa-circle-xmark text-danger"></i></span>
                @endif
              </td>
              <td>
                <a href="{{ route('admin.products.edit', ['id' => $product->id]) }}"
                  class="mx-1 text-success"
                  title="Edit"><i class="fa-solid fa-pen"></i></a>
                <form action="{{ route('admin.products.delete', ['id' => $product->id]) }}"
                  method="post"
                  class="d-inline-block mx-1">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                    class="text-warning bg-transparent border-0"
                    title="Delete">
                    <i class="fa-solid fa-trash-can"></i>
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {!! $products->links() !!} <!-- Hiển thị thanh phân trang với lớp CSS của Bootstrap -->
    </div>
  </main>
@endsection
