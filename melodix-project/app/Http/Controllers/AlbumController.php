<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        // Fetch albums with their artists, ordered by newest first
        $albums = Album::with('artist')
            ->latest()
            ->paginate(18); // Paginating so the page doesn't load hundreds of albums at once

        return view('albums.index', compact('albums'));
    }

    public function show(Album $album)
    {
        // Load the artist and the songs belonging to this album
        $album->load(['artist', 'songs' => function($query) {
            $query->orderBy('created_at', 'desc');
        }]);

        return view('albums.show', compact('album'));
    }
}