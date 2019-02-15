@extends('layouts_admin.master')

@section('content')
<a href="/pages/create" class="btn btn-primary">Add Page</a>
<br><br>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">List of Pages</h4>
            <div class="table-responsive">
                <table id="table" class="table table-hover">
                    <thead>
                        <tr>
                            <th width="70%">Page Title</th>
                            <th width="20%">Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $page)
                        <tr>
                            <td> {{ $page->title }} </td>
                            <td>
                                <form action="/pages/{{$page->id}}/status" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    <div class="">
                                        <label class="">
                                            <input type="checkbox" class="" name="status" {{$page->status ? 'checked' : ''}} onChange="this.form.submit()">
                                            {{$page->status ? 'active' : 'not active'}}
                                        </label>
                                    </div>
                                </form>
                            </td>
                            <td style="white-space:nowrap">
                                <form class="confirmDelete" action="/pages/{{$page->id}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a href="/pages/{{$page->id}}/edit" type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection