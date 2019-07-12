@extends('admin.partials.app')

@section('content')
<div class="d-flex flex-column">

    <div class="d-flex justify-content-around">
        <div class="col-md-6">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-between">
                        <div class="col-8">
                            <h3 class="mb-0">Edit User</h3>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ url("admin/users/$user->id") }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="form-control-label">Username</label>

                            <input type="text" id="username" name="username"
                                class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                                value="{{ null !== old('username') ? old('username') : $user->username }}"
                                placeholder="Username">

                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Type</label>

                            <select name="type" id="select" class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}">
                                <option value="">Please select</option>

                                @foreach ($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->type == $role->name ? 'selected' : '' }}>
                                    {{ $role->description }}
                                </option>
                                @endforeach
                            </select>

                            @error('type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Password</label>

                            <input type="password" name="password"
                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                placeholder="Password">

                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">Confirm Password</label>

                            <input type="password" name="password_confirmation"
                                class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                placeholder="Confirm Password">
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ url('admin/users') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection