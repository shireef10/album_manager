@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-between align-items-center">
        <div class="col">
            <h1 class="mb-4">Albums</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('albums.create') }}" class="btn btn-primary">Create Album +</a>
        </div>
    </div>
    
    @if($albums->isEmpty())
        <div class="alert alert-info w-100" role="alert">
            There are no albums yet. <a href="{{ route('albums.create') }}" class="alert-link">Create one</a>.
        </div>
    @else
        <div id="row" class="row row-cols-1 row-cols-md-3">
            @foreach($albums as $album)
                <div class="col mb-4">
                    <div class="card h-100">
                        <a href="{{ route('albums.show', $album->id) }}" class="card-link">
                            <div class="card-body">
                                <div class="gallery">
                                    @php
                                        $pictures = $album->pictures->reverse();
                                        $count = $pictures->count();
                                    @endphp

                                    @if ($count > 0)
                                        @foreach($pictures->take(4) as $picture)
                                            <img src="{{ asset($picture->file_path) }}" alt="{{ $picture->name }}" class="img-thumbnail">
                                        @endforeach
                                    @else
                                        <i class="far fa-image img-thumbnail d-block mx-auto" style="font-size: 309px"></i>
                                    @endif
                                </div>

                                <h5 class="card-title mt-3">{{ $album->name }}</h5>
                                <p class="card-text">Total Pictures: {{ $count }}</p>
                            </div>
                        </a>
                        <div class="btn-group d-flex justify-content-between" role="group">
                            <a href="{{ route('albums.edit', $album->id) }}" class="btn btn-secondary">Edit Album</a>
                            <button class="btn btn-danger" onclick="showDeleteModal({{ $album->id }}, '{{ $album->name }}', {{ $count }})">Delete Album</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Album</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>What do you want to do with the pictures in the album <span id="albumName"></span>?</p>
                <div id="deleteOptions" style="display: none;">
                    <form id="deleteAlbumForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" id="deleteallbtn" onclick="submitDeleteForm()">Delete All Pictures</button>
                    </form>
                    <form id="movePicturesForm" method="POST" action="">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="new_album_id">Move pictures to:</label>
                            <select name="new_album_id" id="new_album_id" class="form-control">
                                @foreach($albums as $album)
                                    <option value="{{ $album->id }}">{{ $album->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary" id="movebtn" onclick="submitMoveForm()">Move Pictures</button>
                    </form>
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Album</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p>What do you want to do with the pictures in the album <span id="albumName"></span>?</p>
          <div id="deleteOptions" style="display: none;">
              <form id="deleteAlbumForm" method="POST" action="">
                  @csrf
                  @method('DELETE')
                  <button type="button" class="btn btn-danger" id="deleteallbtn" onclick="submitDeleteForm()">Delete All Pictures</button>
              </form>
              <form id="movePicturesForm" method="POST" action="">
                  @csrf
                  @method('PATCH')
                  <div class="form-group">
                      <label for="new_album_id">Move pictures to:</label>
                      <select name="new_album_id" id="new_album_id" class="form-control">
                          @foreach($albums as $album)
                              <option value="{{ $album->id }}">{{ $album->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <button type="button" class="btn btn-primary" id="movebtn" onclick="submitMoveForm()">Move Pictures</button>
              </form>
          </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

@endsection
