<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- global headers -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="auth" content="{{ \App\User::with('role')->find(auth()->id()) }}">

    <title>{{ config('app.name', 'Bonak') }}</title>

    <!-- Favicon -->
    <link href="{{ asset('img') }}/favicon.png" rel="icon" type="image/png">

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">

    <!-- compiled laravel resources -->
    <link href="{{ asset('css') }}/admin.css" rel="stylesheet">
    <script src="{{ asset('js') }}/admin.js" defer></script>

    <!-- page's internal styles and scripts -->
    @stack('styles')
    @stack('js')
</head>

<body>
    <noscript>
        <strong>We're sorry but the cms doesn't work properly without JavaScript enabled. Please enable it to
            continue.</strong>
    </noscript>

    <div id="admin" v-cloak>
        @guest
        @include('admin.login')
        @endguest

        @auth
        <admin :attributes="{{ isset($attr) ? $attr : 'null' }}"></admin>
        @endauth
    </div>
</body>

</html>