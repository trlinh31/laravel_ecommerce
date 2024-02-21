<!-- Cart -->
<div class="wrap-header-cart js-panel-cart">
  <div class="s-full js-hide-cart"></div>

  <div class="header-cart flex-col-l p-l-65 p-r-25">
    <div class="header-cart-title flex-w flex-sb-m p-b-8">
      <span class="mtext-103 cl2">
        Your Cart
      </span>

      <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
        <i class="zmdi zmdi-close"></i>
      </div>
    </div>

    <div class="header-cart-content flex-w js-pscroll">
      <ul class="header-cart-wrapitem w-full">
        @foreach (Cart::content() as $item)
          <li class="header-cart-item flex-w flex-t m-b-12">
            <a href="{{ route('client.cart.remove', ['rowId' => $item->rowId]) }}">
              <div class="header-cart-item-img">
                <img src="{{ asset('images/' . $item->options->image) }}"
                  alt="...">
              </div>
            </a>
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

      @if (Cart::count() > 0)
        <div class="w-full">
          <div class="header-cart-total w-full p-tb-40">
            Total: ${{ Cart::priceTotal(0, '', '') }}
          </div>

          <div class="header-cart-buttons flex-w w-full">
            <a href="{{ route('client.cart.index') }}"
              class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
              View Cart
            </a>

            <a href="{{ route('client.checkout.index') }}"
              class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
              Check Out
            </a>
          </div>
        </div>
      @endif
    </div>
  </div>
</div>
