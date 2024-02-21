@extends('client.layouts.master')
@section('title', 'View cart')
@section('client_content')
  <!-- breadcrumb -->
  <div class="container"
    style="margin-bottom: 20px;">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
      <a href="/"
        class="stext-109 cl8 hov-cl1 trans-04">
        Home
        <i class="fa fa-angle-right m-l-9 m-r-10"
          aria-hidden="true"></i>
      </a>

      <span class="stext-109 cl4">
        Shoping Cart
      </span>
    </div>
  </div>


  <!-- Shoping Cart -->
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
        <div class="m-l-25 m-r--38 m-lr-0-xl">
          <div class="wrap-table-shopping-cart">
            <table class="table-shopping-cart">
              <tr class="table_head">
                <th class="column-1">Product</th>
                <th class="column-2">Name</th>
                <th class="column-3">Size</th>
                <th class="column-4">Color</th>
                <th class="column-5">Price</th>
                <th class="column-6">Quantity</th>
                <th class="column-7">Total</th>
              </tr>
              @foreach (Cart::content() as $item)
                <tr class="table_row">
                  <td class="column-1">
                    <a href="{{ route('client.cart.remove', ['rowId' => $item->rowId]) }}">
                      <div class="how-itemcart1">
                        <img src="{{ asset('images/' . $item->options->image) }}"
                          alt="...">
                      </div>
                    </a>
                  </td>
                  <td class="column-2">{{ $item->name }}</td>
                  <td class="column-3">{{ $item->options->size }}</td>
                  <td class="column-4">{{ $item->options->color }}</td>
                  <td class="column-5">$ {{ $item->price }}</td>
                  <td class="column-6">
                    <form action="{{ route('client.cart.update', ['rowId' => $item->rowId]) }}"
                      method="post">
                      @csrf
                      <div class="wrap-num-product flex-w m-r-0">
                        <button type="submit"
                          class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                          <i class="fs-16 zmdi zmdi-minus"></i>
                        </button>

                        <input class="mtext-104 cl3 txt-center num-product"
                          type="number"
                          name="qty"
                          value="{{ $item->qty }}">

                        <button type="submit"
                          class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                          <i class="fs-16 zmdi zmdi-plus"></i>
                        </button>
                      </div>
                    </form>
                  </td>
                  <td class="column-7">$ {{ $item->qty * $item->price }}</td>
                </tr>
              @endforeach
            </table>
          </div>

          <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
            <div class="flex-w flex-m m-r-20 m-tb-5">
              <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5"
                type="text"
                name="coupon"
                placeholder="Coupon Code">

              <div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                Apply coupon
              </div>
            </div>

            <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
              Update Cart
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
          <h4 class="mtext-109 cl2 p-b-30">
            Cart Totals
          </h4>

          <div class="flex-w flex-t p-t-27 p-b-33">
            <div class="size-208">
              <span class="mtext-101 cl2">
                Total:
              </span>
            </div>

            <div class="size-209 p-t-1">
              <span class="mtext-110 cl2">
                ${{ Cart::priceTotal(0, '', '') }}
              </span>
            </div>
          </div>

          @if (Cart::count() > 0)
            <a href="{{ route('client.checkout.index') }}"
              class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
              Proceed to Checkout
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
