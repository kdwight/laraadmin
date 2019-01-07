@extends('layouts_admin.master')

@section('content')

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit a page</h4>

            <form class="forms-sample" action="/pages/{{$page->id}}" method="post">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"  value="{{ null !== old('title') ? old('title') : $page->title }}" placeholder="Title">
                    @if ( $errors->has('title'))
                        <p class="text-danger">{{ $errors->first('title') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="slug">City</label>
                    <input type="text" id="slug" name="slug" placeholder="Slug" class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" value="{{ null !== old('slug') ? old('slug') : $page->slug }}">
                    @if ( $errors->has('slug'))
                        <p class="text-danger">{{ $errors->first('slug') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description">{!! $page->description !!}</textarea>
                    @if ( $errors->has('description'))
                        <p class="text-danger">{{ $errors->first('description') }}</p>
                    @endif
                </div>

                <button type="submit" class="btn btn-success mr-2">Submit</button>
                <a href="/pages" class="btn btn-light">Cancel</a>
            </form>

        </div>
    </div>
</div>

@endsection