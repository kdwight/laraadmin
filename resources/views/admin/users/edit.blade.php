@extends('layouts_admin.master')

@section('content')

<div class="col-md-7 offset-2 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit User</h4>

            <form class="forms-sample" action="/users/{{ $user->id }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username"
                        name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                        value="{{ null !== old('username') ? old('username') : $user->username }}"
                        placeholder="Username"
                    >
                    @if ( $errors->has('username'))
                        <p class="text-danger">{{ $errors->first('username') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" id="select" class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}">
                        <option value="">Please select</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ $user->type == $role->name ? 'selected' : '' }}>{{ $role->description }}</option>
                        @endforeach
                    </select>
                    @if ( $errors->has('type'))
                        <p class="text-danger">{{ $errors->first('type') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password"
                        name="password"
                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        placeholder="Password"
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
                <a href="/users" class="btn btn-light">Cancel</a>
            </form>

        </div>
    </div>
</div>

@endsection