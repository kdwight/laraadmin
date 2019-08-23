@extends('admin.partials.app')

@section('content')
<div>
    <div class="d-flex justify-content-end">
        <div>
            <a href="{{ url('admin/pages/create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add page
            </a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <div class="card shadow">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="mb-0">List of Pages</span>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th class="col">Title</th>
                                    <th width="20%">Status</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>

                            <tbody class="list">
                                @foreach ($pages as $page)
                                <tr>
                                    <td> {{ $page->title }} </td>
                                    <td>
                                        <form action="{{ url("admin/pages/$page->slug/status") }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="custom-control custom-checkbox">
                                                <input id="status-{{ $page->slug }}" class="custom-control-input" type="checkbox" name="status" {{$page->status ? 'checked' : ''}} onChange="this.form.submit()">
                                                <label for="status-{{ $page->slug }}" class="custom-control-label">{{$page->status ? 'Active' : 'Not Active'}}</label>
                                            </div>
                                        </form>
                                    </td>
                                    <td style="white-space:nowrap">
                                        <form class="confirmDelete" action="{{ url("admin/pages/$page->slug")}}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <a href="{{ url("admin/pages/$page->slug/edit") }}" class="btn btn-icons btn-rounded btn-success btn-sm" title="edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <button type="submit" class="btn btn-icons btn-rounded btn-danger btn-sm" title="delete">
                                                <i class="fa fa-trash"></i>
                                            </button>
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
    </div>
</div>
@endsection