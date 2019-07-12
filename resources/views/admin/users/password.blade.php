@extends('admin.partials.app')

@section('content')
<div class="d-flex flex-column">

    <div class="d-flex justify-content-around">
        <div class="col-md-6">
            <div class="card bg-secondary shadow">

                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Change Password</h3>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form class="forms-sample" action="{{ url('admin/users/'. $user->id .'/change-password') }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="form-control-label">Old Password</label>

                            <input type="password" name="old_password"
                                class="form-control {{ $errors->has('old_password') ? 'is-invalid' : '' }}"
                                placeholder="Old Password">

                            @error('old_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                            @if ($message = session('error'))
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="password">New Password</label>
                            <input type="password" name="password"
                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                placeholder="Unit type">

                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation"
                                class="form-control"
                                placeholder="Confirm Password">
                        </div>

                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection