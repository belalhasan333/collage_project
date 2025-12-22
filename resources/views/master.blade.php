<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/css/vendor.bundle.base.css') }}">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">

    <!-- Layout CSS -->
    <link rel="stylesheet" href="{{ asset('Backend/assets/css/style.css') }}">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

    <link rel="shortcut icon" href="{{ asset('Backend/assets/images/favicon.png') }}" />

    <style>
        .fixed-sidebar {
            position: fixed !important;
            top: 0;
            left: 0;
            bottom: 0;
            height: 100vh !important;
            overflow-y: auto !important;
            z-index: 999;
            width: 200px !important;
        }

        .main-panel {
            margin-left: 200px !important;
            transition: margin-left 0.3s ease;
            min-height: 100vh;
        }

        @media (max-width: 991px) {
            .fixed-sidebar { left: -200px !important; transition: left 0.3s ease; }
            .main-panel { margin-left: 0 !important; }
        }
    </style>

    @stack('styles')
</head>
<body>
<div class="container-scroller">
    @include('backend.partials.sidebar')

    <div class="container-fluid page-body-wrapper">
        @include('backend.partials.navbar')

        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
            @include('backend.partials.footer')
        </div>
    </div>
</div>

<!-- Vendor bundle (jQuery, Bootstrap) -->
<script src="{{ asset('Backend/assets/vendors/js/vendor.bundle.base.js') }}"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<!-- CSRF setup -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });
</script>

<!-- Template JS -->
<script src="{{ asset('Backend/assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('Backend/assets/js/misc.js') }}"></script>
<script src="{{ asset('Backend/assets/js/settings.js') }}"></script>
<script src="{{ asset('Backend/assets/js/todolist.js') }}"></script>

<!-- Page-specific push -->
@stack('scripts')

</body>
</html>
