<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        // Fetch latest videos, eager load artist and genre
        $videos = Video::with(['artist', 'genre'])
            ->latest()
            ->paginate(12);

        return view('videos.index', compact('videos'));
    }

    public function show(Video $video)
    {
        // Load relationships for the detail page
        $video->load(['artist', 'genre', 'language', 'song']);

        // Fetch related videos by the same artist (excluding this one)
        $relatedVideos = Video::where('artist_id', $video->artist_id)
            ->where('id', '!=', $video->id)
            ->take(3)
            ->get();

        return view('videos.show', compact('video', 'relatedVideos'));
    }
}