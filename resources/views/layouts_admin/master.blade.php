<!DOCTYPE html>
<html lang="en" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{env('APP_NAME')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('staradmin/images/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')

    <script type="text/javascript" src='{{asset('tinymce/tinymce.min.js')}}'></script>
    <script>
        window.App = {!!
                json_encode([
                    'user' => auth()->user(),
                    'signedIn' => auth()->check(),
                    'sidebar' => $sidebar,
                    'previousURL' => url()->previous()
                ])
            !!}

        @if (request()->segment(1) == 'users' && (request()->segment(2) == 'create' || request()->segment(3) == 'edit'))
            window.Roles = {!!
                json_encode([
                    'roles' => $roles
                ])
            !!}
        @endif
    </script>
</head>

<body>
    <div id="app">
        <v-app>

            <sidebar></sidebar>
            <topbar></topbar>
            <flash></flash>

            @yield('content')
        </v-app>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>