@extends('layouts_admin.master')

@section('content')

<page-form inline-template>

    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body" @keyup="enable">
          <div class="form-group">
            <label for="title">Title</label>
            <input
              type="text"
              name="title"
              class="form-control"
              placeholder="Title"
              v-model="title"
              @keyup="slugify"
            >
            <p class="text-danger" v-if="errors.title" v-text="errors.title[0]"></p>
          </div>

          <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" placeholder="Slug" class="form-control" v-model="slug">
            <p class="text-danger" v-if="errors.slug" v-text="errors.slug[0]"></p>
          </div>

          <div class="form-group">
            <label for="description">Description</label>
            <p class="text-danger" v-if="errors.description" v-text="errors.description[0]"></p>
            <editor
              :plugins="plugins"
              :toolbar="toolbars"
              :init="{ file_browser_callback }"
              ref="tinymce"
              v-model="description"
              rows="10"
              @onKeyUp="enable"
            ></editor>
          </div>
          <button
            type="submit"
            class="btn btn-success mr-2"
            @click="createPage"
            :disabled="disabled"
          >Submit</button>
          <a href="/pages" class="btn btn-light">Cancel</a>
        </div>
      </div>
    </div>

</page-form>

{{-- <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add a page</h4>
            <form class="forms-sample" action="/pages" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title')}}" placeholder="Title">
                    @if ( $errors->has('title'))
                        <p class="text-danger">{{ $errors->first('title') }}</p>
                    @endif
                </div>
                <p></p>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" id="slug" name="slug" placeholder="Slug" class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" value="{{ old('slug')}}">
                    @if ( $errors->has('slug'))
                        <p class="text-danger">{{ $errors->first('slug') }}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Description"> {{ old('description')}} </textarea>
                    @if ( $errors->has('description'))
                        <p class="text-danger">{{ $errors->first('description') }}</p>
                    @endif
                </div>

                <button type="submit" class="btn btn-success mr-2">Submit</button>
                <a href="/pages" class="btn btn-light">Cancel</a>
            </form>
        </div>
    </div>
</div> --}}

@endsection