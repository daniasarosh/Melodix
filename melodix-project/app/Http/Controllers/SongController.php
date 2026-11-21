<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function show(Song $song)
    {
        // Eager load the relationships needed for the view.
        // We load 'ratings' here so the Blade file can match ratings to reviews efficiently.
        $song->load(['artist', 'album', 'genre', 'ratings']);

        // Related songs: same genre, exclude current
        $relatedSongs = Song::with(['artist'])
            ->where('id', '!=', $song->id)
            ->where('genre_id', $song->genre_id)
            ->latest('created_at')
            ->limit(6)
            ->get();

        // Load reviews with the associated users
        $reviews = $song->reviews()->with('user')->latest()->limit(10)->get();

        // The Song model accessor calculates the average from the ratings table
        $averageRating = $song->average_rating;

        return view('songs.show', compact('song', 'relatedSongs', 'reviews', 'averageRating'));
    }
}