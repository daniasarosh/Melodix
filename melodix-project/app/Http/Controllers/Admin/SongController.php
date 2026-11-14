<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Song;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    // saare songs ki list
    public function index()
    {
        $songs = Song::with(['artist', 'album', 'genre'])->orderBy('title')->get();
        return view('admin.songs.index', compact('songs'));
    }

    // naya song add karne ka form
    public function create()
    {
        return view('admin.songs.create', $this->dropdowns());
    }

    // form submit hone par song save karta hai
    public function store(Request $request)
    {
        $data = $request->validate($this->rules(true));

        $data['cover_image'] = $request->file('cover_image')->store('songs/covers', 'public');
        $data['audio_file'] = $request->file('audio_file')->store('songs/audio', 'public');

        Song::create($data);

        return redirect()->route('admin.songs.index')->with('success', 'Song added.');
    }

    // song edit karne ka form
    public function edit(Song $song)
    {
        return view('admin.songs.edit', array_merge($this->dropdowns(), ['song' => $song]));
    }

    // edit form submit hone par update karta hai
    public function update(Request $request, Song $song)
    {
        $data = $request->validate($this->rules(false));

        if ($request->hasFile('cover_image')) {
            if ($song->cover_image) {
                Storage::disk('public')->delete($song->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('songs/covers', 'public');
        }

        if ($request->hasFile('audio_file')) {
            if ($song->audio_file) {
                Storage::disk('public')->delete($song->audio_file);
            }
            $data['audio_file'] = $request->file('audio_file')->store('songs/audio', 'public');
        }

        $song->update($data);

        return redirect()->route('admin.songs.index')->with('success', 'Song updated.');
    }

    // song delete karta hai
    public function destroy(Song $song)
    {
        if ($song->videos()->count() > 0) {
            return back()->with('error', 'This song is linked to a video. Change or remove the video first.');
        }

        try {
            DB::transaction(function () use ($song) {
                $song->reviews()->delete();
                $song->ratings()->delete();
                $song->playlistItems()->delete();
                $song->delete();
            });
        } catch (QueryException $e) {
            return back()->with('error', 'This song could not be deleted.');
        }

        Storage::disk('public')->delete(array_filter([$song->cover_image, $song->audio_file]));

        return redirect()->route('admin.songs.index')->with('success', 'Song deleted.');
    }

    // validation ke rules (add aur edit dono ke liye)
    private function rules($isNew)
    {
        return [
            'title' => 'required|max:150',
            'artist_id' => 'required|exists:artists,id',
            'album_id' => 'nullable|exists:albums,id',
            'genre_id' => 'required|exists:genres,id',
            'language_id' => 'required|exists:languages,id',
            'country_id' => 'nullable|exists:countries,id',
            'release_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'description' => 'nullable|max:2000',
            'cover_image' => ($isNew ? 'required' : 'nullable') . '|image|mimes:jpg,jpeg,png,webp|max:2048',
            'audio_file' => ($isNew ? 'required' : 'nullable') . '|file|mimes:mp3,wav,ogg|max:20480',
        ];
    }

    // form ke dropdowns ki lists
    private function dropdowns()
    {
        return [
            'artists' => Artist::orderBy('name')->get(),
            'albums' => Album::orderBy('title')->get(),
            'genres' => Genre::orderBy('name')->get(),
            'languages' => Language::orderBy('name')->get(),
            'countries' => Country::orderBy('name')->get(),
        ];
    }
}
