@extends('admin.layouts.master')
@section('title', 'Order management')
@section('admin_content')
  <main class="main">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between mb-5">
        <h2 class="main-title mb-0">@yield('title')</h2>
      </div>
      <table class="table table-hover table-bordered align-middle text-center">
        <thead>
          <tr>
            <th></th>
            <th>Customer name</th>
            <th>Phone</th>
            <th>Product name</th>
            <th>Quantity</th>
            <th>Amount</th>
            <th>Is paid</th>
            <th>Order date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $i => $order)
            <tr>
              <td>{{ $i + 1 }}</td>
              <td>{{ $order->order->full_name }}</td>
              <td>{{ $order->order->phone }}</td>
              <td>{{ $order->product->name }}</td>
              <td>{{ $order->quantity }}</td>
              <td>${{ $order->price }}</td>
              <td>
                @if ($order->order->is_paid)
                  <span><i class="fa-solid fa-circle-check text-success"></i></span>
                @else
                  <span><i class="fa-solid fa-circle-xmark text-danger"></i></span>
                @endif
              </td>
              <td>{{ date_format($order->created_at, 'd/m/Y') }}</td>
              <td>
                <a href="{{ route('admin.orders.show', ['id' => $order->id]) }}"
                  class="mx-1 text-primary"
                  title="Show"><i class="fa-solid fa-eye"></i></i></a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </main>
@endsection
