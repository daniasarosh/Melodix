<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function store(Request $request, Song $song)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string|max:1000',
        ]);

        $userId = auth()->id();

        // Use a transaction to ensure both tables save or both fail
        DB::transaction(function () use ($song, $userId, $validated) {
            
            // 1. Save or update the text review
            $song->reviews()->updateOrCreate(
                ['user_id' => $userId],
                ['review_text' => $validated['review_text']]
            );

            // 2. Save or update the numeric rating
            $song->ratings()->updateOrCreate(
                ['user_id' => $userId],
                ['rating' => $validated['rating']]
            );
        });

        return back()->with('success', 'Your review and rating have been saved!');
    }
}