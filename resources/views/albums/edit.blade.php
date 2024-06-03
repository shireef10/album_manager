@extends('layouts.app')

@section('content')
<h1>Edit Album</h1>
<form action="{{ route('albums.update', $album->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Album Name:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $album->name }}">
    </div>
    <button type="submit" class="btn btn-primary">Update Album</button>
</form>
@endsection
