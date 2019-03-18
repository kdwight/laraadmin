@extends('layouts_admin.master')

@section('content')
<a href="/users/create" class="btn btn-primary">Add User</a>
<a href="/users/roles" class="btn btn-danger">Roles</a>
<br><br>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">List of Users <a href="/users/export" class="btn btn-success">Export to csv</a></h4>
            <div class="table-responsive">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th width="70%">Username</th>
                            <th width="20%">Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tablecontents">
                        @foreach ($users as $user)
                        <tr class="row1" data-id="{{ $user->id }}">
                            <td>
                                <div style="font-size: 20px; cursor: pointer;" title="change display order">
                                    <i class="fa fa-sort"></i>
                                </div>
                            </td>
                            <td> {{ $user->username }} </td>
                            @if ($user->username != 'admin')
                                <td>
                                    <form action="/users/{{$user->id}}/status" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <div class="">
                                            <label class="">
                                                <input type="checkbox" class="" name="status" {{$user->status ? 'checked' : ''}} onChange="this.form.submit()">
                                                {{$user->status ? 'active' : 'not active'}}
                                            </label>
                                        </div>
                                    </form>
                                </td>
                                <td style="white-space: nowrap">
                                    <form class="confirmDelete" action="/users/{{$user->id}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a href="/users/{{$user->id}}/edit" type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>

                            @else
                            <td></td>
                            <td></td>
                            @endif

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<flash message="{{ session('success') }}"></flash>

@endsection

@push('scripts')
<script>
    function sendOrderToServer() {
        var order = [];
        $('tr.row1').each(function(index,element) {
            order.push({
            id: $(this).attr('data-id'),
            position: index+1
            });
        });

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ url('users/sort') }}",
            data: {
            order:order,
            _token: '{{csrf_token()}}'
            },
            success: (response) => {
                return console.log(response);
            },
            error: (error) => {
                return console.log('error');
            }
        });

    }
</script>
@endpush