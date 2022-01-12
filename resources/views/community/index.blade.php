@extends('layouts.app')
@section('content')
<div class="text-center">
<h1>Community</h1>

<div class="m-3">
@foreach ($links as $link)
  <li class="mt-1">{{$link->title}}</li>
  <small>Contributed by: {{$link->creator->name}} {{$link->updated_at->diffForHumans()}}</small>
@endforeach
</div>
{{$links->links()}}
</div>
@stop