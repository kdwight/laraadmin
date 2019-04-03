@extends('layouts_admin.master')

@section('content')
    <user-roles></user-roles>

    <div class="col-md-6 offset-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Role</h4>
                <form class="forms-sample" action="/users/roles" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name">Role</label>
                        <input type="text"
                            name="name"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            placeholder="Role"
                            value="{{ old('name')}}"
                        >
                        @if ( $errors->has('name'))
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text"
                            name="description"
                            class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                            placeholder="Description"
                            value="{{ old('description')}}"
                        >
                        @if ( $errors->has('description'))
                            <p class="text-danger">{{ $errors->first('description') }}</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Allowed access</label>
                        @if ( $errors->has('access'))
                            <p class="text-danger">{{ $errors->first('access') }}</p>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                    <input type="checkbox" name="access[]" class="form-check-input" value="pages"> Pages
                                    <i class="input-helper"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <a href="/users" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6 offset-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List of Roles</h4>
                <div class="table-responsive">
                    <table id="table" class="table table-hover">
                        <thead>
                            <tr>
                                <th width="80%">Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td> {{ $role->description }} </td>
                                @if ($role->name != 'admin')
                                <td style="white-space: nowrap">
                                    <form class="confirmDelete" action="/users/{{$role->id }}/delete-role" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a href="/users/{{$role->id}}/edit-role" type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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

@endsection