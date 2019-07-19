<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Favicon -->
  <link href="{{ asset('images/favicon.png') }}" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

  <!-- Argon Dashboard-->
  <link href="{{ asset('argon/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
  <link href="{{ asset('argon/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('argon/css/argon.min.css') }}" rel="stylesheet">
  <script src="{{ asset('argon/vendor/jquery/dist/jquery.min.js') }}" defer></script>
  <script src="{{ asset('argon/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}" defer></script>
  <script src="{{ asset('argon/js/argon.min.js') }}" defer></script>
  <!-- Argon Dashboard-->
</head>

<body class="bg-default">
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-5">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">안녕!</h1>

              <p class="text-lead text-light">CMS by kdwight.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
          xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>

    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-danger mb-4">
                @if ($message = session('error'))
                <small>{{ $message }}</small>
                @endif
              </div>

              <form method="POST" action="{{ url('admin_login') }}">
                @csrf

                <div class="form-group mb-3 @error('username') has-danger @enderror">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                    </div>

                    <input type="text" class="form-control" name="username" placeholder="username"
                      value="{{ old('username') }}" autocomplete="username" required autofocus>
                  </div>
                </div>

                <div class="form-group @error('password') has-danger @enderror">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>

                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                  </div>

                </div>

                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id="remember" name="remember" type="checkbox"
                    {{ old('remember') ? 'checked' : '' }}>

                  <label class="custom-control-label" for="remember">
                    <span class="text-muted">{{ __('Remember Me') }}</span>
                  </label>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4">Sign in</button>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  {{-- <footer class="py-5">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; {{ date('Y') }} <a href="https://github.com/kdwight" class="font-weight-bold ml-1"
              target="_blank">Kdwight</a>
          </div>
        </div>
        <div class="col-xl-6">
          <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
              <a href="https://twitter.com/kisserdwight" class="nav-link" target="_blank">Twitter</a>
            </li>
            <li class="nav-item">
              <a href="https://github.com/kdwight" class="nav-link" target="_blank">GitHub</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer> --}}

</body>

</html>