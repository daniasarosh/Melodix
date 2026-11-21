<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\PlaylistItem;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    public function index()
    {
        $curatedPlaylists = Playlist::where('is_curated', true)->withCount('items')->latest()->get();
        
        $userPlaylists = collect();
        if (Auth::check()) {
            $userPlaylists = Playlist::where('user_id', Auth::id())->withCount('items')->latest()->get();
        }

        return view('playlists.index', compact('curatedPlaylists', 'userPlaylists'));
    }

    public function show(Playlist $playlist)
    {
        $playlist->load(['items.song.artist']);
        $songs = $playlist->items->pluck('song')->filter();

        return view('playlists.show', compact('playlist', 'songs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:80',
            'description' => 'nullable|string|max:255',
        ]);

        Auth::user()->playlists()->create([
            'name' => $request->name,
            'description' => $request->description,
            'is_curated' => false,
        ]);

        return back()->with('success', 'Playlist created successfully!');
    }

    public function addSong(Request $request, Playlist $playlist)
    {
        if ($playlist->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'song_id' => 'required|exists:songs,id',
        ]);

        // Check if song already exists in playlist to prevent duplicates
        $exists = $playlist->items()->where('song_id', $request->song_id)->exists();

        if ($exists) {
            return back()->with('error', 'This song is already in the playlist.');
        }

        $playlist->items()->create([
            'song_id' => $request->song_id,
        ]);

        return back()->with('success', 'Song added to playlist!');
    }

    public function removeSong(Playlist $playlist, PlaylistItem $item)
    {
        if ($playlist->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $item->delete();
        return back()->with('success', 'Song removed from playlist.');
    }
}