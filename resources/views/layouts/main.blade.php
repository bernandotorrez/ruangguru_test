<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <base href="../" />

    <title>Dashboard - Ace Admin</title>

    <!-- include common vendor stylesheets & fontawesome -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/regular.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/brands.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/solid.min.css">
    <!-- include vendor stylesheets used in "Dashboard" page. see "/views//pages/partials/dashboard/@vendor-stylesheets.hbs" -->

    <!-- include fonts -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600&display=swap">

    <!-- ace.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/ace.min.css') }}">

    <!-- favicon -->
    <link rel="icon" type="image/png" href="./assets/favicon.png" />

    @stack('css')

</head>

<body>
    <div class="body-container">

        @include('layouts.top-menu')

        <div class="main-container bgc-white">

            @include('layouts.left-menu')

            <div role="main" class="main-content">

                {{-- Dynamic Content --}}
                @yield('content')
                {{-- Dynamic Content --}}

                @include('layouts.footer')

            </div>


        </div>
    </div>

    <!-- include common vendor scripts used in demo pages -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

    <!-- include vendor scripts used in "Dashboard" page. see "/views//pages/partials/dashboard/@vendor-scripts.hbs" -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.13.0/Sortable.min.js"></script>

    <!-- include ace.js -->
    <script src="{{ asset('assets/js/ace.min.js') }}"></script>

    <!-- demo.js is only for Ace's demo and you shouldn't use it -->
    <script src="{{ asset('assets/js/demo.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.ba-throttle-debounce.min.js') }}"></script>

    @stack('js')
</body>

</html>
