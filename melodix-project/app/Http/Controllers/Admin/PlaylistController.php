<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\PlaylistItem;
use App\Models\Song;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaylistController extends Controller
{
    // admin ki playlists ki list
    public function index()
    {
        $playlists = Playlist::curated()->orderBy('name')->get();
        return view('admin.playlists.index', compact('playlists'));
    }

    // nayi playlist ka form
    public function create()
    {
        return view('admin.playlists.create');
    }

    // nayi playlist save karta hai
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:80',
            'description' => 'nullable|max:255',
            'cover_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['cover_image'] = $request->file('cover_image')->store('playlists', 'public');
        $data['user_id'] = null;
        $data['is_curated'] = true;

        Playlist::create($data);

        return redirect()->route('admin.playlists.index')->with('success', 'Playlist added.');
    }

    // edit page: details ke saath playlist ke songs aur videos bhi
    public function edit(Playlist $playlist)
    {
        abort_unless($playlist->is_curated, 404);

        $songIds = $playlist->items()->whereNotNull('song_id')->pluck('song_id');
        $videoIds = $playlist->items()->whereNotNull('video_id')->pluck('video_id');

        return view('admin.playlists.edit', [
            'playlist' => $playlist,
            'songs' => Song::with('artist')->whereIn('id', $songIds)->get(),
            'videos' => Video::with('artist')->whereIn('id', $videoIds)->get(),
            'otherSongs' => Song::whereNotIn('id', $songIds)->orderBy('title')->get(),
            'otherVideos' => Video::whereNotIn('id', $videoIds)->orderBy('title')->get(),
        ]);
    }

    // playlist ki details update karta hai
    public function update(Request $request, Playlist $playlist)
    {
        abort_unless($playlist->is_curated, 404);

        $data = $request->validate([
            'name' => 'required|max:80',
            'description' => 'nullable|max:255',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($playlist->cover_image) {
                Storage::disk('public')->delete($playlist->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('playlists', 'public');
        }

        $playlist->update($data);

        return redirect()->route('admin.playlists.index')->with('success', 'Playlist updated.');
    }

    // playlist delete karta hai (uske items database khud hata deta hai)
    public function destroy(Playlist $playlist)
    {
        abort_unless($playlist->is_curated, 404);

        if ($playlist->cover_image) {
            Storage::disk('public')->delete($playlist->cover_image);
        }

        $playlist->delete();

        return redirect()->route('admin.playlists.index')->with('success', 'Playlist deleted.');
    }

    // playlist mein song ya video add karta hai
    public function addItem(Request $request, Playlist $playlist)
    {
        abort_unless($playlist->is_curated, 404);

        $request->validate([
            'song_id' => 'nullable|exists:songs,id',
            'video_id' => 'nullable|exists:videos,id',
        ]);

        if ($request->filled('song_id')) {
            $column = 'song_id';
            $id = $request->song_id;
        } elseif ($request->filled('video_id')) {
            $column = 'video_id';
            $id = $request->video_id;
        } else {
            return back()->with('error', 'Please choose a song or a video.');
        }

        if ($playlist->items()->where($column, $id)->exists()) {
            return back()->with('error', 'It is already in this playlist.');
        }

        $item = new PlaylistItem();
        $item->playlist_id = $playlist->id;
        $item->$column = $id;
        $item->save();

        return back()->with('success', 'Added to the playlist.');
    }

    // playlist se song ya video hataata hai
    public function removeItem(Request $request, Playlist $playlist)
    {
        abort_unless($playlist->is_curated, 404);

        if ($request->filled('song_id')) {
            $playlist->items()->where('song_id', $request->song_id)->delete();
        } elseif ($request->filled('video_id')) {
            $playlist->items()->where('video_id', $request->video_id)->delete();
        }

        return back()->with('success', 'Removed from the playlist.');
    }
}