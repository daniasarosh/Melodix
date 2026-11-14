<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Playlist;
use App\Models\Review;
use App\Models\Song;
use App\Models\User;
use App\Models\Video;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            'Songs' => Song::count(),
            'Videos' => Video::count(),
            'Artists' => Artist::count(),
            'Albums' => Album::count(),
            'Users' => User::where('role', 'user')->count(),
            'Playlists' => Playlist::count(),
            'Reviews' => Review::count(),
        ];

        $latestSongs = Song::with('artist')->latest()->take(5)->get();

        return view('admin.dashboard', compact('counts', 'latestSongs'));
    }
}