@extends('admin.layouts.app')

@section('content')
<users inline-template>
  <div>
    <router-view></router-view>
  </div>
</users>
@endsection