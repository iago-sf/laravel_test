@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if(!$channel)
                <h1>Community</h1>
            @else
                <h1><a class="a-link" href="/home">Community</a> - {{ $links[0]->channel->slug }} </h1>
            @endif
            @include('community/partials/list-links')
    </div>
        <div class="col-md-4">
            @include('community/partials/add-link')

            <div class="my-2"></div>

            @include('flash-message')
        </div>
    </div>
</div>


@stop