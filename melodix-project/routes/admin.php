<?php

use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Middleware\AdminOnly;
use Illuminate\Support\Facades\Route;

Route::middleware(AdminOnly::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('artists', ArtistController::class)->except(['show']);
    Route::resource('albums', AlbumController::class)->except(['show']);
    Route::resource('genres', GenreController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
    Route::resource('languages', LanguageController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
    Route::resource('countries', CountryController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
});