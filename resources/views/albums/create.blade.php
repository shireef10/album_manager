@extends('layouts.app')

@section('content')
<h1>Create Album</h1>
<form action="{{ route('albums.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Album Name:</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Create Album</button>
</form>
@endsection
