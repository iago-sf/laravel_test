@if(count($links) == 0)
<div class="fs-5">No contributions yet</div>
@else
<div class="row align-content-start mb-3">
    <a class="col col-md-2 btn btn-light {{request()->exists('popular') ? '' : 'disabled' }}" href="{{request()->url()}}">Latest</a>
    <a class="col col-md-2 btn btn-light {{request()->exists('popular') ? 'disabled' : '' }}" href="?popular">Most popular</a>
</div>
@endif

@foreach ($links as $link)
<li class="lista-item">
    <span class="child channel label label-default" style="background: {{ $link->channel->color }};">
        <a  class="a-link" 
            style="@if($link->channel->color == 'blue' || $link->channel->color == 'purple') color: white; @endif" 
            href="/community/{{ $link->channel->slug }}"> 
            {{ $link->channel->title }} 
        </a>
    </span>
    <form method="POST" action="/votes/{{ $link->id }}" class="child votes">
        {{ csrf_field() }}
        <button class=" btn text-center {{ Auth::check() && Auth::user()->votedFor($link) ? 'btn-dark' : 'btn-outline-dark' }}" {{ Auth::guest() ? 'disabled' : '' }}>
            {{ $link->users()->count() }}
        </button>
    </form>
    <h6 class="child channel-topic">
        {{ $link->channel->slug }}
    </h6>
    <a class="child link" href="{{$link->link}}" target="_blank">
        {{ $link->title  }}
    </a>
    <small class="child creator">Contributed by {{ $link->creator->name }} {{ $link->updated_at->diffForHumans() }}</small>
</li>
@endforeach

<div class="mt-3">
{{ $links->appends($_GET)->links() }}
</div>