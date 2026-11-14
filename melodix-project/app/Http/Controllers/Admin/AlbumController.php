<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    // saare albums ki list
    public function index()
    {
        $albums = Album::with('artist')->orderBy('title')->get();
        return view('admin.albums.index', compact('albums'));
    }

    // naya album add karne ka form
    public function create()
    {
        $artists = Artist::orderBy('name')->get();
        return view('admin.albums.create', compact('artists'));
    }

    // form submit hone par album save karta hai
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:150',
            'artist_id' => 'required|exists:artists,id',
            'release_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'cover_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['cover_image'] = $request->file('cover_image')->store('albums', 'public');

        Album::create($data);

        return redirect()->route('admin.albums.index')->with('success', 'Album added.');
    }

    // album edit karne ka form
    public function edit(Album $album)
    {
        $artists = Artist::orderBy('name')->get();
        return view('admin.albums.edit', compact('album', 'artists'));
    }

    // edit form submit hone par update karta hai
    public function update(Request $request, Album $album)
    {
        $data = $request->validate([
            'title' => 'required|max:150',
            'artist_id' => 'required|exists:artists,id',
            'release_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($album->cover_image) {
                Storage::disk('public')->delete($album->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('albums', 'public');
        }

        $album->update($data);

        return redirect()->route('admin.albums.index')->with('success', 'Album updated.');
    }

    // album delete karta hai
    public function destroy(Album $album)
    {
        if ($album->songs()->count() > 0) {
            return back()->with('error', 'This album still has songs. Remove them first.');
        }

        if ($album->cover_image) {
            Storage::disk('public')->delete($album->cover_image);
        }

        $album->delete();

        return redirect()->route('admin.albums.index')->with('success', 'Album deleted.');
    }
}
