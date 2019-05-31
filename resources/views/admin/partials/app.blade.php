<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'laracms') }}</title>

        <!-- Favicon -->
        <link href="{{ asset('argon/img/brand/favicon.png') }}" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

        <!-- Argon Dashboard-->
        <link href="{{ asset('argon/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
        <link href="{{ asset('argon/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ asset('argon/css/argon.min.css') }}" rel="stylesheet">
        <script src="{{ asset('argon/vendor/jquery/dist/jquery.min.js') }}" defer></script>
        <script src="{{ asset('argon/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}" defer></script>
        <script src="{{ asset('argon/js/argon.min.js') }}" defer></script>
        <!-- Argon Dashboard-->

        <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
        <script src="{{ asset('js/admin.js') }}" defer></script>
    </head>
    <body>
        <div id="admin">
            @include('admin.partials.sidenav')

            <div class="main-content">

                @include('admin.partials.topnav')

                <!-- Page content -->
                <div class="container-fluid pt-8">
                    @yield('content')
                    <flash></flash>

                    @include('admin.partials.footer')
                </div>
            </div>
        </div>
    </body>
</html>
