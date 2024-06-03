<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('pictures')->get();
        return view('home', compact('albums'));
    }

    public function create()
    {
        return view('albums.create');
    }

    public function store(Request $request)
    {
        $album = Album::create($request->all());
        return redirect()->route('albums.index');
    }

    public function edit(Album $album)
    {
        return view('albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $album->update($request->all());
        return redirect()->route('albums.index');
    }

    public function destroy(Request $request, Album $album)
    {
        $album->pictures()->delete();
        $album->delete();
        return redirect()->route('albums.index');
    }

    public function movePictures(Request $request, Album $album)
    {
        $newAlbumId = $request->input('new_album_id');
        $album->pictures()->update(['album_id' => $newAlbumId]);
        return redirect()->route('albums.index');
    }

    public function show($id)
    {
        $album = Album::findOrFail($id);
        $pictures = $album->pictures;

        return view('albums.show', compact('album', 'pictures'));
    }
}
