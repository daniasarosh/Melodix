<?php

use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\PlaylistController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SongController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Middleware\AdminOnly;
use Illuminate\Support\Facades\Route;

Route::middleware(AdminOnly::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('artists', ArtistController::class)->except(['show']);
    Route::resource('albums', AlbumController::class)->except(['show']);
    Route::resource('genres', GenreController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
    Route::resource('languages', LanguageController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
    Route::resource('countries', CountryController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
    Route::resource('songs', SongController::class)->except(['show']);
    Route::resource('videos', VideoController::class)->except(['show']);

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::post('users/{user}/toggle', [UserController::class, 'toggle'])->name('users.toggle');

    Route::resource('playlists', PlaylistController::class)->except(['show']);
    Route::post('playlists/{playlist}/items', [PlaylistController::class, 'addItem'])->name('playlists.items.add');
    Route::delete('playlists/{playlist}/items', [PlaylistController::class, 'removeItem'])->name('playlists.items.remove');

    Route::resource('reviews', ReviewController::class)->only(['index', 'destroy']);

    Route::get('site-settings', [SiteSettingController::class, 'edit'])->name('settings.edit');
    Route::put('site-settings', [SiteSettingController::class, 'update'])->name('settings.update');
});