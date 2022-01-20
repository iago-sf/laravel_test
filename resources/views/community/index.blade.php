@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Community</h1>
            @if(count($links) == 0)
            <div class="fs-5">No contributions yet</div>
            @endif
            @foreach ($links as $link)
            <li class="lista-item">
                <span class="child channel label label-default" style="background: {{ $link->channel->color }}; @if($link->channel->color == 'blue') color: white; @endif">
                    {{ $link->channel->title }}
                </span>
                <a class="child link" href="{{$link->link}}" target="_blank">
                    {{$link->title}}
                </a>
                <small class="child creator">Contributed by: {{$link->creator->name}} {{$link->updated_at->diffForHumans()}}</small>
            </li>
            @endforeach
    </div>
        <div class="col-md-4">
            @include('partials/add-link')

            <div class="my-2"></div>

            @include('flash-message')
        </div>
    </div>
    {{$links->links()}}

</div>


@stop