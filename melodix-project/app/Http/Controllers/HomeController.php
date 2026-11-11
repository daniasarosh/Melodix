<?php
namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Video;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Playlist;
use App\Models\Genre;

class HomeController extends Controller
{
    public function index()
    {
        $latestSongs = Song::with(['artist', 'genre'])
            ->latest()
            ->take(5)
            ->get();

        $latestVideos = Video::with(['artist', 'song'])
            ->latest()
            ->take(5)
            ->get();

        $popularArtists = Artist::withCount('songs')
            ->orderByDesc('songs_count')
            ->take(8)
            ->get();

        $latestAlbums = Album::with('artist')
            ->latest()
            ->take(6)
            ->get();

        $featuredPlaylists = Playlist::curated()
            ->take(6)
            ->get();

        $genres = Genre::withCount('songs')
            ->orderBy('name')
            ->get();

        return view('home', compact(
            'latestSongs',
            'latestVideos',
            'popularArtists',
            'latestAlbums',
            'featuredPlaylists',
            'genres'
        ));
    }
}
