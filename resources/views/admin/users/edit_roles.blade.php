@extends('layouts_admin.master')

@section('content')
<div class="col-md-6 offset-3 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit</h4>
            <form class="forms-sample" action="/users/{{$role->id}}/update-role" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group">
                    <label for="name">Role</label>
                    <input type="text"
                        name="name"
                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        placeholder="Role"
                        value="{{ $role->name }}"
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
                        value="{{ $role->description }}"
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
                                <input type="checkbox" name="access[]" class="form-check-input" value="pages" {{ in_array("pages", json_decode($role->access)) ? 'checked' : '' }}> Pages
                                <i class="input-helper"></i></label>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success mr-2">Submit</button>
                <a href="/users/roles" class="btn btn-light">Cancel</a>
            </form>
        </div>
    </div>
</div>
<flash message="{{ session('success') }}"></flash>

@endsection

@push('scripts')
<script>
    $(".deleteMet").on("submit", function(){
        return confirm("Do you want to delete this item?");
    });
</script>
@endpush