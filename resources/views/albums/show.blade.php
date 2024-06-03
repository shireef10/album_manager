@extends('layouts.app')

@section('content')
<div class="container">
    <div class="">
        <h1>{{ $album->name }}</h1>

        <div class="card-body">
            <button id="addphoto" type="button" class="btn btn-primary" onclick="document.getElementById('photo').click()">Add Photo <i class="fas fa-plus"></i></button>
            <form action="{{ route('pictures.store') }}" method="POST" enctype="multipart/form-data" style="display: none;" id="photoForm">
                @csrf
                <input type="hidden" name="album_id" value="{{ $album->id }}">
                <div class="form-group mt-3">
                    <input type="file" id="photo" name="file" onchange="document.getElementById('photoForm').submit()">
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div style="display: flex; flex-wrap: wrap;">
            @if($pictures->isEmpty())
                <div class="alert alert-info" style=" width: 1170px;" role="alert">
                    There are no photos yet. <a href="#" id="addPhotoLink" class="alert-link" onclick="document.getElementById('photo').click()">Add one now!</a>.
                </div>
            @else
                @foreach($album->pictures as $picture)
                    <div style="margin-right: 15px; margin-bottom: 15px;">
                        <div class="card position-relative">
                            <img src="{{ asset($picture->file_path) }}" class="card-img-top" alt="{{ $picture->name }}">
                            <div class="overlay">
                                <div class="btn-group" role="group">
                                    <form action="{{ route('pictures.destroy', $picture->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" id="deletePics">Delete</button>
                                    </form>
                                    <button class="btn btn-primary" onclick="openImage('{{ asset($picture->file_path) }}')">View</button>
                                </div>
                                <div class="image-name">
                                    <p>{{ $picture->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <img src="" id="fullScreenImage" class="img-fluid mx-auto d-block" alt="Full Screen Image">
            </div>
        </div>
    </div>
</div>

@endsection
