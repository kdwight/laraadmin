@extends('admin.layouts.app', [
    'class' => 'bg-default',
    'yieldClass' => 'container mt--8 pb-5'
])

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-danger mb-4">
                    @if ($message = session('error'))
                    <small>{{ $message }}</small>
                    @endif

                    @if ($warning = session('warning'))
                    <small>{{ $warning }}</small>
                    @endif
                </div>

                <form role="form" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group {{ $errors->has('username') ? 'has-danger' : '' }} mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                            </div>

                            <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                                placeholder="{{ __('Username') }}"
                                type="text"
                                name="username"
                                value="{{ old('username') }}"
                                required
                                autofocus
                            >
                        </div>

                        @error('username')
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>

                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password" value="6.62607004" required>
                        </div>

                        @error('password')
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="custom-control custom-control-alternative custom-checkbox">
                        <input class="custom-control-input" name="remember" id="customCheckLogin" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                        {{ old('remember') ? 'checked' : '' }}

                        <label class="custom-control-label" for="customCheckLogin">
                            <span class="text-muted">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary my-4">{{ __('Sign in') }}</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-6">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-light">
                        <small>{{ __('Forgot password?') }}</small>
                    </a>
                @endif
            </div>

            <div class="col-6 text-right">
                <a href="{{ route('register') }}" class="text-light">
                    <small>{{ __('Create new account') }}</small>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
