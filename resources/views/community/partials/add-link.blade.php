<div class="card">
    <div class="card-header">
        <h3>Contribute a link</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="/community">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="What is the title of your article?" value="{{old('title')}}">
            </div>
            @error('title')
            <div class="text-danger mt-2">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="link">Link:</label>
                <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" placeholder="What is the URL?" value="{{old('link')}}">
            </div>
            @error('link')
            <div class="text-danger mt-2">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="Channel">Channel:</label>
                <select class="form-control @error('channel_id') is-invalid @enderror" name="channel_id">
                    <option selected disabled>Pick a Channel...</option>
                    @foreach ($channels as $channel)
                    <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>  
                        <!-- La línea anterior verifica si el id escogido anterior es igual al id del canal que se 
                        esta añadiendo al html, si es así se pone como seleccionado -->
                        {{ $channel->title }}
                    </option>
                    @endforeach
                </select>
                @error('channel_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group card-footer">
                <button class="btn btn-primary">Contribute Link</button>
            </div>
        </form>
    </div>
</div>