<!DOCTYPE html>
<html lang="en" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{env('APP_NAME')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">

    {{-- staradmin template --}}
    <link rel="stylesheet" href="{{ asset('staradmin/vendors/iconfonts/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('staradmin/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('staradmin/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('staradmin/vendors/css/vendor.bundle.addons.css') }}">
    {{-- staradmin template --}}

    <link rel="stylesheet" href="{{ asset('staradmin/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('staradmin/images/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('datatables/datatables.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')

    <script>
        window.App = {!!
                json_encode([
                    'user' => auth()->user(),
                    'signedIn' => auth()->check(),
                    'sidebar' => $sidebar
                ])
            !!}
    </script>
</head>

<body>
    <div id="app">
        <v-app>

            <topbar></topbar>
            {{-- <sidebar></sidebar> --}}
            <flash message="{{ session('success') }}"></flash>

            {{-- <div class="container-scroller">

                @include('layouts_admin.navbar')

                <div class="container-fluid page-body-wrapper">

                    @include('layouts_admin.sidebar')

                    <div class="main-panel">
                        <div class="content-wrapper"> --}}
                            @yield('content')
                            {{-- <flash message="{{ session('success') }}"></flash>
                        </div>

                        @include('layouts_admin.footer')
                    </div>
                </div>
        </div> --}}
        </v-app>
    </div>

    {{-- staradmin template --}}
    <script src="{{ asset('staradmin/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('staradmin/vendors/js/vendor.bundle.addons.js') }}"></script>
    <script src="{{ asset('staradmin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('staradmin/js/misc.js') }}"></script>
    {{-- staradmin template --}}

    <script src="{{ asset('datatables/datatables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('datatables/jquery-ui.js') }}" ></script>
    <script type="text/javascript" src='{{asset('tinymce/tinymce.min.js')}}'></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    @stack('scripts')
</body>

</html>