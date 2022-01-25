@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Community</h1>
            @include('community/partials/list-links')
    </div>
        <div class="col-md-4">
            @include('community/partials/add-link')

            <div class="my-2"></div>

            @include('flash-message')
        </div>
    </div>
    {{$links->links()}}

</div>


@stop