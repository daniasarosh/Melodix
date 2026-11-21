<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::withCount(['songs', 'albums'])
            ->orderBy('name')
            ->get();

        return view('artists.index', compact('artists'));
    }

    public function show(Artist $artist)
    {
        // Load the artist's relationships
        $artist->loadCount(['songs', 'albums']);

        // Fetch their albums
        $albums = $artist->albums()->latest()->get();

        // Fetch their latest songs
        $songs = $artist->songs()->with('album')->latest()->take(10)->get();

        return view('artists.show', compact('artist', 'albums', 'songs'));
    }
}