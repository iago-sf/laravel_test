@if(count($links) == 0)
<div class="fs-5">No contributions yet</div>
@endif
@foreach ($links as $link)
<li class="lista-item">
    <span class="child channel label label-default" style="background: {{ $link->channel->color }};">
        <a class="a-link" style="@if($link->channel->color == 'blue') color: white; @endif" href="/community/{{ $link->channel->slug }}"> {{ $link->channel->title }} </a>
    </span>
    <h6 class="child channel-topic">
        {{ $link->channel->slug }}
    </h6>
    <a class="child link" href="{{$link->link}}" target="_blank">
        {{ $link->title  }}
    </a>
    <small class="child creator">Contributed by {{ $link->creator->name }} {{ $link->updated_at->diffForHumans() }}</small>
</li>
@endforeach