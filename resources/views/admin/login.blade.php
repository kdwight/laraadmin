<!DOCTYPE html>
<html lang="en" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{env('APP_NAME')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('staradmin/vendors/iconfonts/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('staradmin/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('staradmin/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('staradmin/vendors/css/vendor.bundle.addons.css') }}">
    <link rel="stylesheet" href="{{ asset('staradmin/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('staradmin/images/favicon.png') }}" />

    <style>
        .login-bg {
            background: #112a2e !important;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
            <div class="login-bg content-wrapper d-flex align-items-center auth theme-one">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">

                        @if ($message = session('error'))
                            <div class="alert alert-danger alert-block ">
                            {{ $message }}
                            </div>
                        @endif

                        <div class="auto-form-wrapper">

                            <form method="POST" action="{{'/admin_login'}}">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label class="label">Username</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" autofocus>
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-user"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="label">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" placeholder="*********">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-key"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary submit-btn btn-block">Login</button>
                                </div>

                            </form>

                        </div>
                        <ul class="auth-footer">
                            <li>
                                <a href="#">Conditions</a>
                            </li>
                            <li>
                                <a href="#">Help</a>
                            </li>
                            <li>
                                <a href="#">Terms</a>
                            </li>
                        </ul>
                        <p class="footer-text text-center">copyright © 2018 CarbonDigital Inc. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('staradmin/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('staradmin/vendors/js/vendor.bundle.addons.js') }}"></script>
    <script src="{{ asset('staradmin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('staradmin/js/misc.js') }}"></script>
</body>

</html>