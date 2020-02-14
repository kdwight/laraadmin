@extends('admin.layouts.app')

@section('content')
<admin :attributes="{{ isset($attr) ? $attr : 'null' }}"></admin>
@endsection