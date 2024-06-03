<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048',
            'album_id' => 'required|exists:albums,id'
        ]);

        $filePath = $request->file('file')->store('pictures', 'public');

        Picture::create([
            'name' => $request->file('file')->getClientOriginalName(),
            'file_path' => $filePath,
            'album_id' => $request->input('album_id')
        ]);

        return redirect()->route('albums.show', $request->album_id)->with('success', 'Photo uploaded successfully!');
    }

    public function destroy(Picture $picture)
    {
        $picture->delete();
        return redirect()->back();
    }

    public function show($filename)
    {
        $filePath = storage_path('app/public/pictures/' . $filename);

        if (!Storage::disk('public')->exists('pictures/' . $filename)) {
            abort(404);
        }

        return response()->file($filePath);
    }
}
