<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\VideoController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/browse', [BrowseController::class, 'index'])->name('browse');

// Artists
Route::get('/artists', [ArtistController::class, 'index'])->name('artists.index');
Route::get('/artists/{artist}', [ArtistController::class, 'show'])->name('artists.show');

// Albums
Route::get('/albums', [AlbumController::class, 'index'])->name('albums.index');
Route::get('/albums/{album}', [AlbumController::class, 'show'])->name('albums.show');

// Videos
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');