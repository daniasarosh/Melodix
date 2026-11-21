<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Artist;
use App\Models\Album;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $songs = collect();
        $artists = collect();
        $albums = collect();

        if ($query) {
            // Make it case-insensitive by converting to lowercase
            $searchTerm = strtolower($query);

            $songs = Song::with(['artist'])
                ->whereRaw('LOWER(title) LIKE ?', ["%{$searchTerm}%"])
                ->latest()
                ->limit(20)
                ->get();

            $artists = Artist::whereRaw('LOWER(name) LIKE ?', ["%{$searchTerm}%"])
                ->limit(10)
                ->get();

            $albums = Album::whereRaw('LOWER(title) LIKE ?', ["%{$searchTerm}%"])
                ->limit(10)
                ->get();
        }

        return view('search.index', compact('query', 'songs', 'artists', 'albums'));
    }
}