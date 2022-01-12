@extends('layouts.app')
@section('content')
<div class="text-center">
<h1>Community</h1>

<div class="m-3">
@foreach ($links as $link)
  <li>{{$link->title}}</li>
@endforeach
</div>
{{$links->links()}}
</div>
@stop