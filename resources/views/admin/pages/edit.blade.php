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
                    <label for="description">Textarea</label>
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

@push('scripts')
<script type="text/javascript" src='{{asset('tinymce/tinymce.min.js')}}'></script>
<script>
    tinymce.init({
        path_absolute : "/",
        selector: "#description",
        height: 400,
        plugins: [
        "advlist autolink lists link image charmap hr anchor pagebreak",
        "searchreplace wordcount code fullscreen",
        "insertdatetime nonbreaking contextmenu",
        "paste textcolor colorpicker textpattern"
        ],
        toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code",
        relative_urls: false,
        file_browser_callback : elFinderBrowser
    });

    function elFinderBrowser (field_name, url, type, win) {
        tinymce.activeEditor.windowManager.open({
            file: '<?= route('elfinder.tinymce4') ?>',// use an absolute path!
            title: 'elFinder 2.0',
            width: 900,
            height: 450,
            resizable: 'yes'
        }, {
            setUrl: function (url) {
            win.document.getElementById(field_name).value = url;
            }
        });
        return false;
    }

    const box1 = document.getElementById('title');
    const box2 = document.getElementById('slug');
    function onchange() {
        box2.value = box1.value.replace(/\s+/g, '-').toLowerCase();
    }
    box1.addEventListener('keyup', onchange);

</script>
@endpush