@extends('admin.layouts.master')
@section('title', 'User management')
@section('admin_content')
  <main class="main">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between mb-5">
        <h2 class="main-title mb-0">@yield('title')</h2>
        <a href="{{ route('admin.users.create') }}"
          class="btn btn-primary shadow">Create New</a>
      </div>
      <table class="table table-hover table-bordered align-middle text-center">
        <thead>
          <tr>
            <th></th>
            <th>Avatar</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $i => $user)
            <tr>
              <td>{{ $i + 1 }}</td>
              <td>
                @if ($user->avatar == null)
                  <div class="rounded-circle bg-secondary-subtle mx-auto"
                    style="width: 50px; height: 50px;"></div>
                @else
                  <img src="{{ asset('images/' . $user->avatar) }}"
                    class="rounded-circle mx-auto object-fit-cover"
                    width="50"
                    height="50" />
                @endif
              </td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                @if ($user->role)
                  <span>Admin</span>
                @else
                  <span>User</span>
                @endif
              </td>
              <td>
                @if ($user->status)
                  <div class="btn bg-success text-white btn-sm mx-auto d-flex align-items-center py-1"
                    style="width: 100px">
                    <div class="spinner-border spinner-border-sm"
                      role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                    <span class="flex-grow-1">Active</span>
                  </div>
                @else
                  <div class="btn bg-danger text-white btn-sm mx-auto d-flex align-items-center py-1"
                    style="width: 100px">
                    <div class="spinner-border spinner-border-sm"
                      role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                    <span class="flex-grow-1">Passive</span>
                  </div>
                @endif
              </td>
              <td>
                <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}"
                  class="mx-1 text-success"
                  title="Edit"><i class="fa-solid fa-pen"></i></a>
                <form action="{{ route('admin.users.lock', ['id' => $user->id]) }}"
                  method="post"
                  class="d-inline-block mx-1">
                  @csrf
                  @method('PATCH')
                  <button type="submit"
                    class="text-danger bg-transparent border-0"
                    title="{{ $user->status == 1 ? 'Lock' : 'Unlock' }}">
                    <i class="{{ $user->status == 1 ? 'fa-solid fa-lock' : 'fa-solid fa-lock-open' }}"></i>
                  </button>
                </form>
                <form action="{{ route('admin.users.delete', ['id' => $user->id]) }}"
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
