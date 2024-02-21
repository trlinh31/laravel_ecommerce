@extends('client.layouts.master')
@section('title', 'Checkout')
@section('client_content')
  <!-- breadcrumb -->
  <div class="container"
    style="margin-bottom: 20px;">
    <div class="bread-crumb flex-w p-t-30 p-lr-0-lg">
      <a href="/"
        class="stext-109 cl8 hov-cl1 trans-04">
        Home
        <i class="fa fa-angle-right m-l-9 m-r-10"
          aria-hidden="true"></i>
      </a>

      <span class="stext-109 cl4">
        Checkout
      </span>
    </div>
  </div>

  <div class="container m-b-50">
    <form action="{{ route('client.checkout.post') }}"
      method="post">
      @csrf
      <div class="row">
        <div class="col-lg-10 col-xl-7">
          <div class="row">
            <div class="col-6 m-b-20 wrap-input1 w-full p-b-4">
              <input class="input1 bg-none plh1 stext-107 cl7"
                type="text"
                name="name"
                placeholder="Full name">
              <div class="focus-input1 trans-04"></div>
              @error('name')
                <p style="color: red">{{ $message }}</p>
              @enderror
            </div>
            <div class="col-6 m-b-20 wrap-input1 w-full p-b-4">
              <input class="input1 bg-none plh1 stext-107 cl7"
                type="text"
                name="phone"
                placeholder="Phone Number">
              <div class="focus-input1 trans-04"></div>
              @error('phone')
                <p style="color: red">{{ $message }}</p>
              @enderror
            </div>
            <div class="col-6 m-b-20 wrap-input1 w-full p-b-4">
              <input class="input1 bg-none plh1 stext-107 cl7"
                type="text"
                name="country"
                placeholder="Country">
              <div class="focus-input1 trans-04"></div>
              @error('country')
                <p style="color: red">{{ $message }}</p>
              @enderror
            </div>
            <div class="col-6 m-b-20 wrap-input1 w-full p-b-4">
              <input class="input1 bg-none plh1 stext-107 cl7"
                type="text"
                name="city"
                placeholder="City">
              <div class="focus-input1 trans-04"></div>
              @error('city')
                <p style="color: red">{{ $message }}</p>
              @enderror
            </div>
            <div class="col-12 m-b-20 wrap-input1 w-full p-b-4">
              <input class="input1 bg-none plh1 stext-107 cl7"
                type="text"
                name="address"
                placeholder="Address">
              <div class="focus-input1 trans-04"></div>
              @error('address')
                <p style="color: red">{{ $message }}</p>
              @enderror
            </div>
            <div class="col-12">
              <div class="d-flex align-items-center m-b-10">
                <input type="radio"
                  class="m-r-3"
                  name="payment_type"
                  id="cod"
                  value="cod">
                <label for="cod">Payment on delivery (COD)</label>
              </div>
              <div class="d-flex align-items-center">
                <input type="radio"
                  class="m-r-3"
                  name="payment_type"
                  id="card"
                  value="card">
                <label for="card">Payment by card</label>
              </div>
              @error('payment_type')
                <p style="color: red">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>
        <div class="col-lg-10 col-xl-5">
          <ul class="header-cart-wrapitem w-full">
            @foreach (Cart::content() as $item)
              <li class="header-cart-item flex-w flex-t m-b-12">
                <div class="header-cart-item-img">
                  <img src="{{ asset('images/' . $item->options->image) }}"
                    alt="...">
                </div>
                <div class="header-cart-item-txt p-t-8">
                  <p class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                    {{ $item->name }}
                  </p>

                  <span class="header-cart-item-info">
                    {{ $item->qty }} x ${{ $item->price }}
                  </span>
                </div>
              </li>
            @endforeach
          </ul>
          <button type="submit""
            class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
            Checkout
          </button>
        </div>
      </div>
    </form>
  </div>
@endsection
