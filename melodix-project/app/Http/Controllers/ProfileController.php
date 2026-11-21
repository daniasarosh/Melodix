<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        // Safety: if somehow not logged in, redirect to login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Load the user's playlists with the count of items in them
        $playlists = $user->playlists()->withCount('items')->latest()->get();
        
        // Load the user's reviews
        $reviews = $user->reviews()->with('song')->latest()->take(5)->get();

        return view('profile.index', compact('user', 'playlists', 'reviews'));
    }
}