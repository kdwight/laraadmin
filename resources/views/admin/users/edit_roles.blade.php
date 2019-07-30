@extends('admin.partials.app')

@section('content')
<div class="d-flex flex-column">

    <div class="d-flex justify-content-around">
        <div class="col-md-6">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-between">
                        <div class="col-8">
                            <h3 class="mb-0">Edit Role</h3>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form class="forms-sample" action="{{ url('/admin/users/'. $role->id .'/update-role') }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label class="form-control-label">
                                <span class="text-danger">*</span> Role
                            </label>

                            <input type="text" name="name"
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                value="{{ $role->name }}"
                                placeholder="Role">

                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">
                                <span class="text-danger">*</span> Description
                            </label>

                            <input type="text" name="description"
                                class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                value="{{ $role->description }}"
                                placeholder="Description" >

                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">
                                <span class="text-danger">*</span> Allowed Access
                            </label>

                            @error('access')
                            <p class="text-warning">
                                <small>
                                    {{ $errors->first('access') }}
                                </small>
                            </p>
                            @enderror

                            <div class="row justify-content-around">
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input id="pages" class="custom-control-input" type="checkbox"
                                            name="access[]" value="pages"
                                            {{ in_array("pages", json_decode($role->access)) ? 'checked' : '' }}>
                                        <label for="pages" class="custom-control-label">Pages</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input id="careers" class="custom-control-input" type="checkbox"
                                            name="access[]" value="careers"
                                            {{ in_array("careers", json_decode($role->access)) ? 'checked' : '' }}>
                                        <label for="careers" class="custom-control-label">Careers</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox">
                                        <input id="articles" class="custom-control-input" type="checkbox"
                                            name="access[]" value="articles"
                                            {{ in_array("articles", json_decode($role->access)) ? 'checked' : '' }}>
                                        <label for="articles" class="custom-control-label">Articles</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input id="works" class="custom-control-input" type="checkbox"
                                            name="access[]" value="works"
                                            {{ in_array("works", json_decode($role->access)) ? 'checked' : '' }}>
                                        <label for="works" class="custom-control-label">Works</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ url('admin/users/roles') }}" class="btn btn-light">Cancel</a>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection