@extends('layouts.app')

@section('content')
<form action="{{request()->url()}}/upload" method="POST" enctype='multipart/form-data' class="d-flex flex-row w-50 m-auto justify-content-center">
    @csrf
    <div class="d-inline-flex flex-column">
        <div class="form-group d-flex flex-row flex-wrap mb-3">
            <label for="image" class="w-100">Select your profile picture</label>
            <input type="file" class="form-control-file w-100" id="image" name="image">
        </div>
        <div class="form-group d-flex flex-row">
            <input type="submit" class="btn btn-outline-primary" value="Upload">
        </div>
    </div>
</form>
@stop