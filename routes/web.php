<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PictureController;

Route::get('/', [AlbumController::class, 'index'])->name('albums.index');
Route::resource('albums', AlbumController::class);
Route::resource('pictures', PictureController::class)->only(['store', 'destroy']);
Route::patch('/albums/{album}/move', [AlbumController::class, 'movePictures'])->name('albums.move');
Route::get('/pictures/{filename}', [PictureController::class, 'show'])->name('pictures.show');
Route::get('/albums/{album}/photos', [AlbumController::class, 'show'])->name('albums.show');
