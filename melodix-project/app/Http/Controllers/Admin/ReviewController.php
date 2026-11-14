<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    // saare reviews ki list
    public function index()
    {
        $reviews = Review::with(['user', 'song', 'video'])->latest()->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    // review delete karta hai
    public function destroy(Review $review)
    {
        $review->delete();

        return back()->with('success', 'Review deleted.');
    }
}
