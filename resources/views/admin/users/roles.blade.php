@extends('admin.partials.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                    <div class="col">
                        <span class="mb-0">Add Role</span>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form class="forms-sample" action="{{ url('admin/users/roles') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label class="form-control-label">Role</label>

                        <input type="text" name="name"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            value="{{ old('name')}}"
                            placeholder="Role">

                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Description</label>

                        <input type="text" name="description"
                            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                            placeholder="Description" value="{{ old('description')}}">

                        @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-control-label">Allowed Access</label>

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
                                    <input id="pages" class="custom-control-input" type="checkbox" name="access[]" value="pages">
                                    <label for="pages" class="custom-control-label">Pages</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input id="careers" class="custom-control-input" type="checkbox" name="access[]" value="careers">
                                    <label for="careers" class="custom-control-label">Careers</label>
                                </div>
                            </div>

                            <div class="">
                                <div class="custom-control custom-checkbox">
                                    <input id="articles" class="custom-control-input" type="checkbox" name="access[]" value="articles">
                                    <label for="articles" class="custom-control-label">Articles</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input id="works" class="custom-control-input" type="checkbox" name="access[]" value="works">
                                    <label for="works" class="custom-control-label">Works</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <a href="{{ url('admin/users') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card shadow">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <span class="mb-0">List of Roles</span>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table align-items-center table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Role</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>

                        <tbody class="list">
                            @foreach ($roles as $role)
                            <tr>
                                <td> {{ $role->description }} </td>
                                @if ($role->name != 'admin')
                                <td style="white-space: nowrap">
                                    <form class="confirmDelete" action="{{ url("admin/users/$role->id/delete-role") }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <a href="{{ url("admin/users/$role->id/edit-role") }}" class="btn btn-icons btn-rounded btn-success btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <button type="submit" class="btn btn-icons btn-rounded btn-danger btn-sm" title="delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                @else
                                <td></td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection