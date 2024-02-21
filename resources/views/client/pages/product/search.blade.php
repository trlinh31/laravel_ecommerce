@extends('client.layouts.master')
@section('title', 'Search Results')
@section('client_content')
  <!-- Product -->
  <div class="bg0 m-t-23 p-b-140">
    <div class="container">
      <p class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-35">Search result: {{ $products->count() }}</p>
      <div class="row isotope-grid">
        @foreach ($products as $product)
          <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
            <div class="block2">
              <div class="block2-pic hov-img0">
                <img src="{{ asset('images/' . $product->product_images[0]->path) }}"
                  height="334"
                  alt="...">
              </div>

              <div class="block2-txt flex-w flex-t p-t-14">
                <div class="block2-txt-child1 flex-col-l ">
                  <a href="{{ route('client.products.show', ['id' => $product->id, 'slug' => $product->slug]) }}"
                    class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                    {{ $product->name }}
                  </a>

                  <div class="d-flex align-items-center">
                    <span class="stext-105 cl5">
                      ${{ $product->price - ($product->price * $product->discount) / 100 }}
                    </span>
                    @if ($product->discount > 0)
                      <span class="stext-112 cl12"
                        style="padding-left: 8px; text-decoration: line-through;">
                        ${{ $product->price }}
                      </span>
                    @endif
                  </div>
                </div>

                <div class="block2-txt-child2 flex-r p-t-3">
                  <a href="#"
                    class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                    <img class="icon-heart1 dis-block trans-04"
                      src="{{ asset('client/images/icons/icon-heart-01.png') }}"
                      alt="ICON">
                    <img class="icon-heart2 dis-block trans-04 ab-t-l"
                      src="{{ asset('client/images/icons/icon-heart-02.png') }}"
                      alt="ICON">
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
