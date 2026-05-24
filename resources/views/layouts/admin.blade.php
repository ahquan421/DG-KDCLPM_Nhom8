<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title', 'Admin Dashboard')</title>

  {{-- ========== CSS Skydash (có sẵn) ========== --}}
  <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('js/select.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  {{-- ========== Vite của Laravel Breeze ========== --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  {{-- Stack styles cho từng trang (nếu cần thêm CSS ngoài) --}}
  @stack('styles')
</head>

<body>
  <div class="container-scroller">
    {{-- Thanh navbar --}}
    @include('partials.navbar')

    <div class="container-fluid page-body-wrapper">
      {{-- Thanh sidebar --}}
      @include('partials.sidebar')

      <div class="main-panel">
        <div class="content-wrapper">
          {{-- Nội dung trang con --}}
          @yield('content')
        </div>

        {{-- Footer --}}
        @include('partials.footer')
      </div>

      {{-- Settings panel --}}
      @include('partials.settings-panel')
    </div>
  </div>

  {{-- ========== JS Skydash (có sẵn) ========== --}}
  <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('js/dataTables.select.min.js') }}"></script>
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('js/template.js') }}"></script>
  <script src="{{ asset('js/settings.js') }}"></script>
  <script src="{{ asset('js/todolist.js') }}"></script>
  <script src="{{ asset('js/dashboard.js') }}"></script>
  <script src="{{ asset('js/Chart.roundedBarCharts.js') }}"></script>

  {{-- Stack scripts cho từng trang (nếu cần thêm JS ngoài) --}}
  @stack('scripts')
</body>
</html>
