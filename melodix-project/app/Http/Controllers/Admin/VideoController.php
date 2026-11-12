<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Song;
use App\Models\Video;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    // saari videos ki list
    public function index()
    {
        $videos = Video::with('artist')->orderBy('title')->get();
        return view('admin.videos.index', compact('videos'));
    }

    // nayi video add karne ka form
    public function create()
    {
        return view('admin.videos.create', $this->dropdowns());
    }

    // form submit hone par video save karta hai
    public function store(Request $request)
    {
        $data = $request->validate($this->rules(true), $this->messages());

        $data['thumbnail'] = $request->file('thumbnail')->store('videos/thumbnails', 'public');

        if ($request->hasFile('video_file')) {
            $data['video_source'] = $request->file('video_file')->store('videos/files', 'public');
        } else {
            $data['video_source'] = $request->video_link;
        }

        unset($data['video_file'], $data['video_link']);

        Video::create($data);

        return redirect()->route('admin.videos.index')->with('success', 'Video added.');
    }

    // video edit karne ka form
    public function edit(Video $video)
    {
        return view('admin.videos.edit', array_merge($this->dropdowns(), ['video' => $video]));
    }

    // edit form submit hone par update karta hai
    public function update(Request $request, Video $video)
    {
        $data = $request->validate($this->rules(false), $this->messages());

        if ($request->hasFile('thumbnail')) {
            if ($video->thumbnail) {
                Storage::disk('public')->delete($video->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('videos/thumbnails', 'public');
        }

        if ($request->hasFile('video_file')) {
            $this->deleteOldFile($video->video_source);
            $data['video_source'] = $request->file('video_file')->store('videos/files', 'public');
        } elseif ($request->filled('video_link')) {
            $this->deleteOldFile($video->video_source);
            $data['video_source'] = $request->video_link;
        }

        unset($data['video_file'], $data['video_link']);

        $video->update($data);

        return redirect()->route('admin.videos.index')->with('success', 'Video updated.');
    }

    // video delete karta hai
    public function destroy(Video $video)
    {
        try {
            DB::transaction(function () use ($video) {
                $video->reviews()->delete();
                $video->ratings()->delete();
                $video->playlistItems()->delete();
                $video->delete();
            });
        } catch (QueryException $e) {
            return back()->with('error', 'This video could not be deleted.');
        }

        if ($video->thumbnail) {
            Storage::disk('public')->delete($video->thumbnail);
        }
        $this->deleteOldFile($video->video_source);

        return redirect()->route('admin.videos.index')->with('success', 'Video deleted.');
    }

    // agar source upload ki hui file hai (link nahi) to usay storage se hata deta hai
    private function deleteOldFile($source)
    {
        if ($source && !str_starts_with($source, 'http')) {
            Storage::disk('public')->delete($source);
        }
    }

    // validation ke rules (add aur edit dono ke liye)
    private function rules($isNew)
    {
        return [
            'title' => 'required|max:150',
            'video_type' => 'required|in:music_video,choreography,movie_song,live_session',
            'artist_id' => 'required|exists:artists,id',
            'song_id' => 'nullable|exists:songs,id',
            'genre_id' => 'required|exists:genres,id',
            'language_id' => 'required|exists:languages,id',
            'country_id' => 'nullable|exists:countries,id',
            'release_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'description' => 'nullable|max:2000',
            'thumbnail' => ($isNew ? 'required' : 'nullable') . '|image|mimes:jpg,jpeg,png,webp|max:2048',
            'video_file' => ($isNew ? 'required_without:video_link|' : '') . 'nullable|file|mimes:mp4,webm,ogg|max:30720',
            'video_link' => 'nullable|url|max:255',
        ];
    }

    // custom error messages
    private function messages()
    {
        return [
            'video_file.required_without' => 'Upload a video file or paste a video link.',
        ];
    }

    // form ke dropdowns ki lists
    private function dropdowns()
    {
        return [
            'types' => [
                'music_video' => 'Music Video',
                'choreography' => 'Choreography',
                'movie_song' => 'Movie Song',
                'live_session' => 'Live Session',
            ],
            'artists' => Artist::orderBy('name')->get(),
            'songs' => Song::orderBy('title')->get(),
            'genres' => Genre::orderBy('name')->get(),
            'languages' => Language::orderBy('name')->get(),
            'countries' => Country::orderBy('name')->get(),
        ];
    }
}
