<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible"
    content="IE=edge" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0" />
  <title>@yield('title') | Admin</title>
  <!-- Favicon -->
  <link rel="shortcut icon"
    href="{{ asset('admin/img/svg/logo.svg') }}"
    type="image/x-icon" />
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet">
  <link rel="stylesheet"
    href="{{ asset('admin/css/style.css') }}" />
  <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
</head>

<body>
  @include('sweetalert::alert')
  <div class="layer"></div>
  <a class="skip-link sr-only"
    href="#skip-target">Skip to content</a>
  <div class="d-flex">
    @include('admin.components.sidebar')
    <div class="main-wrapper">
      @include('admin.components.navbar')
      @yield('admin_content')
    </div>
  </div>
  {{-- Ckeditor --}}
  <script src="{{ asset('admin/js/admin.js') }}"></script>
  <script>
    ClassicEditor
      .create(document.querySelector('#editor'))
      .catch(error => {
        console.error(error);
      });
  </script>
</body>

</html>
