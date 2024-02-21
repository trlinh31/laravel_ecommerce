@extends('client.layouts.master')
@section('title', 'Products')
@section('client_content')
  <!-- Product -->
  <div class="bg0 m-t-23 p-b-140">
    <div class="container">
      <form action=""
        method="get">
        <div class="flex-w flex-sb-m p-b-52">
          <div class="flex-w flex-c-m m-tb-10">
            <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
              <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
              <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
              Filter
            </div>
          </div>

          <!-- Filter -->
          <div class="dis-none panel-filter w-full p-t-10">
            <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
              <div class="filter-col1 p-r-15 p-b-27">
                <div class="mtext-102 cl2 p-b-15">
                  Sort By
                </div>

                <ul>
                  <li class="p-b-6">
                    <div class="d-flex">
                      <input type="radio"
                        name="c"
                        value="all"
                        id="radio1"
                        {{ request()->input('c') == 'all' ? 'checked' : '' }}
                        onchange="this.form.submit()" />
                      <label for="radio1"
                        style="margin-left: 4px;">Default</label>
                    </div>
                  </li>

                  @foreach ($categories as $category)
                    <li class="p-b-6">
                      <div class="d-flex">
                        <input type="radio"
                          name="c"
                          value="{{ $category->id }}"
                          id="{{ $category->slug }}"
                          {{ request()->input('c') == $category->id ? 'checked' : '' }}
                          onchange="this.form.submit()" />
                        <label for="radio2"
                          style="margin-left: 4px;">{{ $category->name }}</label>
                      </div>
                    </li>
                  @endforeach
                </ul>
              </div>

              <div class="filter-col2 p-r-15 p-b-27">
                <div class="mtext-102 cl2 p-b-15">
                  Price
                </div>

                <ul>
                  <li class="p-b-6">
                    <div class="d-flex">
                      <input type="radio"
                        name="p"
                        value="all"
                        id="radio4"
                        {{ request()->input('c') == 'all' ? 'checked' : '' }}
                        onchange="this.form.submit()" />
                      <label for="radio4"
                        style="margin-left: 4px;">All</label>
                    </div>
                  </li>
                  <li class="p-b-6">
                    <div class="d-flex">
                      <input type="radio"
                        name="p"
                        value="00-50"
                        id="00-50"
                        {{ request()->input('c') == '00-50' ? 'checked' : '' }}
                        onchange="this.form.submit()" />
                      <label for="00-50"
                        style="margin-left: 4px;">$00 - $50</label>
                    </div>
                  </li>
                  <li class="p-b-6">
                    <div class="d-flex">
                      <input type="radio"
                        name="p"
                        value="50-100"
                        id="50-100"
                        {{ request()->input('c') == '50-100' ? 'checked' : '' }}
                        onchange="this.form.submit()" />
                      <label for="50-100"
                        style="margin-left: 4px;">$50 - $100</label>
                    </div>
                  </li>
                  <li class="p-b-6">
                    <div class="d-flex">
                      <input type="radio"
                        name="p"
                        value="100-150"
                        id="100-150"
                        {{ request()->input('c') == '100-150' ? 'checked' : '' }}
                        onchange="this.form.submit()" />
                      <label for="100-150"
                        style="margin-left: 4px;">$100 - $150</label>
                    </div>
                  </li>
                  <li class="p-b-6">
                    <div class="d-flex">
                      <input type="radio"
                        name="p"
                        value="200"
                        id="200"
                        {{ request()->input('c') == '200' ? 'checked' : '' }}
                        onchange="this.form.submit()" />
                      <label for="200"
                        style="margin-left: 4px;">$200+</label>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </form>

      <div class="row isotope-grid">
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
