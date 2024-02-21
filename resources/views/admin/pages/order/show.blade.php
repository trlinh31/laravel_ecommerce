@extends('admin.layouts.master')
@section('title', 'Order detail')
@section('admin_content')
  <main class="main">
    <div class="container">
      <table class="table table-hover table-bordered align-middle text-center">
        <tbody>
          <tr>
            <td>Customer Name</td>
            <td>{{ $order->full_name }}</td>
          </tr>
          <tr>
            <td>Email</td>
            <td>{{ $order->email }}</td>
          </tr>
          <tr>
            <td>Phone</td>
            <td>{{ $order->phone }}</td>
          </tr>
          <tr>
            <td>Country</td>
            <td>{{ $order->country }}</td>
          </tr>
          <tr>
            <td>City</td>
            <td>{{ $order->city }}</td>
          </tr>
          <tr>
            <td>Address</td>
            <td>{{ $order->address }}</td>
          </tr>
          <tr>
            <td>Payment type</td>
            <td>
              @if ($order->payment_type == 'card')
                <span>Card</span>
              @else
                <span>COD</span>
              @endif
            </td>
          </tr>
          <tr>
            <td>Is paid</td>
            <td>
              @if ($order->is_paid)
                <span><i class="fa-solid fa-circle-check text-success"></i></span>
              @else
                <span><i class="fa-solid fa-circle-xmark text-danger"></i></span>
              @endif
            </td>
          </tr>
          <tr>
            <td>Product name</td>
            <td>{{ $order->product_name }}</td>
          </tr>
          <tr>
            <td>Size</td>
            <td>{{ $order->size }}</td>
          </tr>
          <tr>
            <td>Color</td>
            <td>{{ $order->color }}</td>
          </tr>
          <tr>
            <td>Quantity</td>
            <td>{{ $order->quantity }}</td>
          </tr>
          <tr>
            <td>Total price</td>
            <td>${{ $order->price }}</td>
          </tr>
          <tr>
            <td>Order date</td>
            <td>{{ $order->created_at }}</td>
          </tr>
        </tbody>
      </table>
      <a href="{{ route('admin.orders.index') }}"
        class="btn btn-outline-primary">Cancel</a>
    </div>
  </main>
@endsection
