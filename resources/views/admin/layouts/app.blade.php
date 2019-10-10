<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="auth" content="{{ auth()->user() }}">

        <title>{{ config('app.name', 'LARACMS') }}</title>

        <!-- Favicon -->
        <link href="{{ asset('img') }}/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

        <!-- Argon Dashboard-->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
        <!-- Argon Dashboard-->

        <!-- Plugins -->
        <script src="{{ asset('plugins/tagsinput/jquery.tagsinput.min.js') }}" ></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/tagsinput/jquery.tagsinput.min.css') }}" />
        <!-- Plugins -->

        <link href="{{ asset('css') }}/admin.css" rel="stylesheet">
        <script src="{{ asset('js') }}/admin.js" defer></script>

        @stack('styles')
        @stack('js')
    </head>
    <body class="{{ $class ?? '' }}">
        <noscript>
            <strong>We're sorry but the cms doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
        </noscript>

        <div id="admin">
            @auth()
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                @include('admin.layouts.navbars.sidebar')
            @endauth

            <div class="main-content">
                @auth()
                    @include('admin.layouts.navbars.topbar')

                    @if (request()->is('admin/dashboard*'))
                        @include('admin.layouts.headers.cards')
                    @else
                        @include('admin.layouts.headers.header')
                    @endif
                @endauth

                @guest
                    @include('admin.layouts.headers.guest')
                @endguest

                <!-- Page content -->
                <div class="{{ $yieldClass ?? 'container-fluid mt--7' }}">
                    @yield('content')
                    <flash message="{{ session('success') }}" status="{{ session('status') }}"></flash>

                    @auth
                        @include('admin.layouts.footer')
                    @endauth
                </div>
            </div>
        </div>
    </body>
</html>