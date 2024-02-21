@extends('client.layouts.master')
@section('title', 'Homepage')
@section('client_content')
  @include('client.components.slider')
  @include('client.components.banner')
  <!-- Product -->
  <section class="bg0 p-t-23 p-b-140">
    <div class="container">
      <div class="p-b-10">
        <h3 class="ltext-103 cl5">
          Product Overview
        </h3>
      </div>

      <div class="flex-w flex-sb-m p-b-52">
        <div class="flex-w flex-l-m filter-tope-group m-tb-10">
          <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1"
            data-filter="*">
            All Products
          </button>

          @foreach ($product_cates as $product_cate)
            <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5"
              data-filter=".{{ $product_cate->name }}">
              {{ $product_cate->name }}
            </button>
          @endforeach
        </div>
      </div>

      <div class="row isotope-grid"
        id="products_list">
        @foreach ($products as $product)
          <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{ $product->product_category->name }}">
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
                      src="client/images/icons/icon-heart-01.png"
                      alt="ICON">
                    <img class="icon-heart2 dis-block trans-04 ab-t-l"
                      src="client/images/icons/icon-heart-02.png"
                      alt="ICON">
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection
