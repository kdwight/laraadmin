@extends('admin.partials.app')

@section('content')
<div>
    <div class="d-flex justify-content-end">
        <div>
            <a href="{{ url('admin/users/create') }}" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Create User
            </a>

            <a href="{{ url('admin/users/roles') }}" class="btn btn-danger">
                <i class="fas fa-user-tag"></i> Roles
            </a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <div class="card shadow">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="mb-0">List of Users</span>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="ajax-table" data-url="{{ url('admin/userlist') }}">
                            <thead class="thead-light">
                                <tr>
                                    <th width="50%">Username</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection