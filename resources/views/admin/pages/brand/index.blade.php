@extends('admin.layouts.master')
@section('title', 'Brand management')
@section('admin_content')
  <main class="main">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between mb-5">
        <h2 class="main-title mb-0">@yield('title')</h2>
        <a href="{{ route('admin.brands.create') }}"
          class="btn btn-primary shadow">Create New</a>
      </div>
      <table class="table table-hover table-bordered align-middle text-center">
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Create at</th>
            <th>Update at</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($brands as $i => $brand)
            <tr>
              <td>{{ $i + 1 }}</td>
              <td>{{ $brand->name }}</td>
              <td>{{ date_format($brand->created_at, 'd/m/Y') }}</td>
              <td>{{ date_format($brand->updated_at, 'd/m/Y') }}</td>
              <td>
                <a href="{{ route('admin.brands.edit', ['id' => $brand->id, 'slug' => $brand->slug]) }}"
                  class="mx-1 text-success"
                  title="Edit"><i class="fa-solid fa-pen"></i></a>
                <form action="{{ route('admin.brands.delete', ['id' => $brand->id]) }}"
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
    </div>
  </main>
@endsection
