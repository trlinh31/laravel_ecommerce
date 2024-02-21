<!DOCTYPE html>
<html lang="en">

<head>
  <title>@yield('title')</title>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="icon"
    type="image/png"
    href="{{ asset('client/images/icons/favicon.png') }}" />
  <!--===============================================================================================-->
  <link rel="stylesheet"
    type="text/css"
    href="{{ asset('client/vendor/bootstrap/css/bootstrap.min.css') }} ">
  <!--===============================================================================================-->
  <link rel="stylesheet"
    type="text/css"
    href="{{ asset('client/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }} ">
  <!--===============================================================================================-->
  <link rel="stylesheet"
    type="text/css"
    href="{{ asset('client/fonts/iconic/css/material-design-iconic-font.min.css') }} ">
  <!--===============================================================================================-->
  <link rel="stylesheet"
    type="text/css"
    href="{{ asset('client/fonts/linearicons-v1.0.0/icon-font.min.css') }} ">
  <!--===============================================================================================-->
  <link rel="stylesheet"
    type="text/css"
    href="{{ asset('client/vendor/animate/animate.css') }} ">
  <!--===============================================================================================-->
  <link rel="stylesheet"
    type="text/css"
    href="{{ asset('client/vendor/css-hamburgers/hamburgers.min.css') }} ">
  <!--===============================================================================================-->
  <link rel="stylesheet"
    type="text/css"
    href="{{ asset('client/vendor/animsition/css/animsition.min.css') }} ">
  <!--===============================================================================================-->
  <link rel="stylesheet"
    type="text/css"
    href="{{ asset('client/vendor/select2/select2.min.css') }} ">
  <!--===============================================================================================-->
  <link rel="stylesheet"
    type="text/css"
    href="{{ asset('client/vendor/daterangepicker/daterangepicker.css') }} ">
  <!--===============================================================================================-->
  <link rel="stylesheet"
    type="text/css"
    href="{{ asset('client/vendor/slick/slick.css') }} ">
  <!--===============================================================================================-->
  <link rel="stylesheet"
    type="text/css"
    href="{{ asset('client/vendor/MagnificPopup/magnific-popup.css') }} ">
  <!--===============================================================================================-->
  <link rel="stylesheet"
    type="text/css"
    href="{{ asset('client/vendor/perfect-scrollbar/perfect-scrollbar.css') }} ">
  <!--===============================================================================================-->
  <link rel="stylesheet"
    type="text/css"
    href="{{ asset('client/css/util.css') }} ">
  <link rel="stylesheet"
    type="text/css"
    href="{{ asset('client/css/main.css') }} ">
  <!--===============================================================================================-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>


<body class="animsition">
  @include('client.components.header')
  @include('sweetalert::alert')
  @include('client.components.cart')
  @yield('client_content')
  @include('client.components.footer')
  <!-- Back to top -->
  <div class="btn-back-to-top"
    id="myBtn">
    <span class="symbol-btn-back-to-top">
      <i class="zmdi zmdi-chevron-up"></i>
    </span>
  </div>

  <!--===============================================================================================-->
  <script src="{{ asset('client/vendor/jquery/jquery-3.2.1.min.js') }} "></script>
  <!--===============================================================================================-->
  <script src="{{ asset('client/vendor/animsition/js/animsition.min.js') }} "></script>
  <!--===============================================================================================-->
  <script src="{{ asset('client/vendor/bootstrap/js/popper.js') }} "></script>
  <script src="{{ asset('client/vendor/bootstrap/js/bootstrap.min.js') }} "></script>
  <!--===============================================================================================-->
  <script src="{{ asset('client/vendor/select2/select2.min.js') }} "></script>
  <script>
    $(".js-select2").each(function() {
      $(this).select2({
        minimumResultsForSearch: 20,
        dropdownParent: $(this).next('.dropDownSelect2')
      });
    })
  </script>
  <!--===============================================================================================-->
  <script src="{{ asset('client/vendor/daterangepicker/moment.min.js') }} "></script>
  <script src="{{ asset('client/vendor/daterangepicker/daterangepicker.js') }} "></script>
  <!--===============================================================================================-->
  <script src="{{ asset('client/vendor/slick/slick.min.js') }} "></script>
  <script src="{{ asset('client/js/slick-custom.js') }} "></script>
  <!--===============================================================================================-->
  <script src="{{ asset('client/vendor/parallax100/parallax100.js') }} "></script>
  <script>
    $('.parallax100').parallax100();
  </script>
  <!--===============================================================================================-->
  <script src="{{ asset('client/vendor/MagnificPopup/jquery.magnific-popup.min.js') }} "></script>
  <script>
    $('.gallery-lb').each(function() { // the containers for all your galleries
      $(this).magnificPopup({
        delegate: 'a', // the selector for gallery item
        type: 'image',
        gallery: {
          enabled: true
        },
        mainClass: 'mfp-fade'
      });
    });
  </script>
  <!--===============================================================================================-->
  <script src="{{ asset('client/vendor/isotope/isotope.pkgd.min.js') }} "></script>
  <!--===============================================================================================-->
  <script src="{{ asset('client/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }} "></script>
  <script>
    $('.js-pscroll').each(function() {
      $(this).css('position', 'relative');
      $(this).css('overflow', 'hidden');
      var ps = new PerfectScrollbar(this, {
        wheelSpeed: 1,
        scrollingThreshold: 1000,
        wheelPropagation: false,
      });

      $(window).on('resize', function() {
        ps.update();
      })
    });
  </script>
  <!--===============================================================================================-->
  <script src="{{ asset('client/js/main.js') }} "></script>
  <script src="{{ asset('client/js/cart.js') }}"></script>
</body>

</html>
