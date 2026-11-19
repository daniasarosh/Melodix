<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\SongController;

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

// Songs
Route::get('/songs/{song}', [SongController::class, 'show'])->name('songs.show');

// Search
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');

Route::post('/songs/{song}/reviews', [App\Http\Controllers\ReviewController::class, 'store'])
    ->name('reviews.store')
    ->middleware('auth');

    // Playlists
Route::get('/playlists', [App\Http\Controllers\PlaylistController::class, 'index'])->name('playlists.index');

Route::get('/playlists/{playlist}', [App\Http\Controllers\PlaylistController::class, 'show'])->name('playlists.show');

Route::middleware('auth')->group(function () {
    Route::post('/playlists', [App\Http\Controllers\PlaylistController::class, 'store'])->name('playlists.store');
    Route::post('/playlists/{playlist}/songs', [App\Http\Controllers\PlaylistController::class, 'addSong'])->name('playlists.addSong');
    Route::delete('/playlists/{playlist}/songs/{item}', [App\Http\Controllers\PlaylistController::class, 'removeSong'])->name('playlists.removeSong');
});

require __DIR__ . '/auth.php';

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile')->middleware('auth');
    Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');

    // Legal & Support Pages
Route::get('/contact', [App\Http\Controllers\PageController::class, 'contact'])->name('contact');
Route::post('/contact', [App\Http\Controllers\PageController::class, 'submitContact'])->name('contact.submit');
Route::get('/help', [App\Http\Controllers\PageController::class, 'helpCenter'])->name('help');
Route::get('/privacy', [App\Http\Controllers\PageController::class, 'privacyPolicy'])->name('privacy');
Route::get('/terms', [App\Http\Controllers\PageController::class, 'termsOfUse'])->name('terms');