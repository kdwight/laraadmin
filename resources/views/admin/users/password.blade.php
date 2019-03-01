@extends('layouts_admin.master')

@section('content')

<div class="col-md-7 offset-2 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">New Password</h4>

            <form class="forms-sample" action="/users/{{$user->id}}/change-password" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group">
                    <label for="old_password">Old Password</label>
                    <input type="password"
                        name="old_password"
                        class="form-control {{ $errors->has('old_password') ? 'is-invalid' : '' }}"
                        value="{{ old('old_password')}}"
                        placeholder="Unit type"
                    >
                    @if ( $errors->has('old_password'))
                        <p class="text-danger">{{ $errors->first('old_password') }}</p>
                    @endif

                    @if ($message = session('error'))
                        <p class="text-danger">{{ $message }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password"
                        name="password"
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        placeholder="Unit type"
                    >
                    @if ( $errors->has('password'))
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password"
                        name="password_confirmation"
                        class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                        placeholder="Confirm Password"
                    >
                </div>

                <button type="submit" class="btn btn-success mr-2">Submit</button>
                <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
            </form>

        </div>
    </div>
</div>

@endsection