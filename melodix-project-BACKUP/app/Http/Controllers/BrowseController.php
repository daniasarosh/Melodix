<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Artist;
use App\Models\Genre;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    public function index()
    {
        // 1. Fetch Genres for the discovery grid
        $genres = Genre::withCount('songs')->orderBy('name')->get();

        // 2. Fetch Latest Songs (for "New Releases")
        $latestSongs = Song::with(['artist', 'genre'])
            ->latest()
            ->take(10)
            ->get();

        // 3. Fetch Popular Artists
        $popularArtists = Artist::withCount('songs')
            ->orderByDesc('songs_count')
            ->take(8)
            ->get();

        return view('browse.index', compact('genres', 'latestSongs', 'popularArtists'));
    }
}