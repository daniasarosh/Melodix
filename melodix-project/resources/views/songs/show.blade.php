@extends('layouts.app')

@section('title', $song->title)
@section('meta_description', Str::limit($song->description ?? 'Listen to ' . $song->title . ' on Melodix.', 155))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/song-show.css') }}">
    <style>
        /* Force form inputs to be visible and clickable */
        .review-form-input {
            background-color: #1a151a !important;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            padding: 0.75rem 1rem !important;
            font-size: 1rem !important;
            border-radius: 0.5rem !important;
        }
        .review-form-input:focus {
            background-color: #1a151a !important;
            color: #ffffff !important;
            border-color: #d63384 !important;
            box-shadow: 0 0 0 0.25rem rgba(214, 51, 132, 0.25) !important;
        }
        .review-form-input::placeholder {
            color: #888 !important;
        }

        /* CUSTOM REVIEW BOX - Bypasses global theme flexbox issues */
        .review-box {
            background: rgba(20, 15, 20, 0.95);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
            display: block !important;
            width: 100% !important;
        }
        .review-box-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 0.75rem;
        }
        .review-author {
            font-weight: 700;
            font-size: 1.1rem;
            color: #ffffff;
            margin: 0;
        }
        .review-body {
            display: block !important;
            width: 100% !important;
            white-space: normal !important;
            word-wrap: break-word !important;
            color: #d1d1d1;
            line-height: 1.6;
            font-size: 1rem;
            margin: 0;
        }

        /* Fix for the dropdown to ensure it appears above the waves */
        .dropdown-menu {
            z-index: 1050;
            background-color: #1a151a !important;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .dropdown-item:hover {
            background-color: rgba(214, 51, 132, 0.2) !important;
            color: #fff !important;
        }
    </style>
@endpush

@section('content')

<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('browse') }}">Browse</a></li>
        @if ($song->artist)
            <li class="breadcrumb-item"><a href="{{ route('artists.show', $song->artist) }}">{{ $song->artist->name }}</a></li>
        @endif
        <li class="breadcrumb-item active" aria-current="page">{{ $song->title }}</li>
    </ol>
</nav>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<section class="song-hero card mb-5">
    <div class="song-hero-layout">
        
        {{-- Cover Image --}}
        <div class="song-hero-image-col">
            <div class="song-cover-wrapper">
                <img src="{{ $song->cover_url ?? asset('images/placeholder-cover.png') }}" 
                     onerror="this.src='https://via.placeholder.com/300x300?text=No+Cover'"
                     alt="{{ $song->title }} cover" 
                     class="song-hero-cover">
            </div>
        </div>

        {{-- Song Details --}}
        <div class="song-hero-details-col">
            <h1 class="song-title">{{ $song->title }}</h1>

            <div class="song-meta mb-3">
                @if ($song->artist)
                    <a href="{{ route('artists.show', $song->artist) }}" class="artist-link">
                        {{ $song->artist->name }}
                    </a>
                @endif
                @if ($song->album)
                    <span class="meta-dot">•</span> <a href="{{ route('albums.show', $song->album) }}">{{ $song->album->title }}</a>
                @endif
                @if ($song->release_year)
                    <span class="meta-dot">•</span> <span>{{ $song->release_year }}</span>
                @endif
            </div>

            <div class="d-flex gap-2 align-items-center flex-wrap mb-4">
                @if ($song->genre)
                    <span class="badge badge-genre">{{ $song->genre->name }}</span>
                @endif
                <x-star-rating :rating="$averageRating" />
                <span class="text-muted small">{{ number_format($averageRating, 1) }} / 5</span>
            </div>

            <div class="d-flex gap-3 flex-wrap align-items-center">
                @if ($song->audio_file)
                    <button type="button" class="btn btn-primary btn-lg rounded-pill px-4 js-play-song"
                        data-song-id="{{ $song->id }}"
                        data-audio-url="{{ $song->audio_url ?? asset('storage/' . $song->audio_file) }}"
                        data-title="{{ $song->title }}"
                        data-artist="{{ $song->artist?->name ?? 'Unknown' }}"
                        data-cover="{{ $song->cover_url }}">
                        <i class="bi bi-play-fill"></i> Play Now
                    </button>
                @else
                    <button class="btn btn-secondary btn-lg rounded-pill px-4" disabled>
                        <i class="bi bi-slash-circle"></i> Audio Unavailable
                    </button>
                @endif

                <a href="#reviews" class="btn btn-outline-light btn-lg rounded-pill px-4">
                    <i class="bi bi-chat-square-text"></i> Reviews
                </a>

                {{-- ADD TO PLAYLIST BUTTON --}}
                @auth
                    <div class="dropdown">
                        <button class="btn btn-outline-info btn-lg rounded-pill px-4 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-plus-circle"></i> Add to Playlist
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark shadow">
                            @foreach(auth()->user()->playlists as $userPlaylist)
                                <li>
                                    <form action="{{ route('playlists.addSong', $userPlaylist) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="song_id" value="{{ $song->id }}">
                                        <button type="submit" class="dropdown-item">{{ $userPlaylist->name }}</button>
                                    </form>
                                </li>
                            @endforeach
                            @if(auth()->user()->playlists->isEmpty())
                                <li><span class="dropdown-item text-muted">No playlists yet</span></li>
                            @endif
                            <li><hr class="dropdown-divider border-secondary"></li>
                            <li><a class="dropdown-item text-info fw-bold" href="{{ route('playlists.index') }}">+ Create New Playlist</a></li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</section>

<div class="row g-5">
    {{-- Left Column: About & Reviews --}}
    <div class="col-lg-8">
        @if ($song->description)
            <section class="mb-5 position-relative" style="z-index: 2;">
                <h2 class="section-heading">About this song</h2>
                <p class="text-muted fs-5">{{ $song->description }}</p>
            </section>
        @endif

        <section id="reviews" class="position-relative" style="z-index: 2;">
            <h2 class="section-heading mb-3">Reviews & Ratings</h2>

            {{-- REVIEW SUBMISSION FORM --}}
            <div class="card p-4 mb-4" style="background: rgba(20, 15, 20, 0.95); border: 1px solid rgba(255,255,255,0.1); backdrop-filter: blur(10px); box-shadow: 0 8px 32px rgba(0,0,0,0.5);">
                <h3 class="h5 mb-3 text-white">Leave a Review</h3>
                
                @auth
                    <form action="{{ route('reviews.store', $song) }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label text-white small fw-bold mb-2">Rating</label>
                            <select name="rating" class="form-select review-form-input @error('rating') is-invalid @enderror" required style="cursor: pointer;">
                                <option value="" disabled selected>Select a rating...</option>
                                <option value="5">5 Stars - Masterpiece</option>
                                <option value="4">4 Stars - Great</option>
                                <option value="3">3 Stars - Good</option>
                                <option value="2">2 Stars - Fair</option>
                                <option value="1">1 Star - Poor</option>
                            </select>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-white small fw-bold mb-2">Your Review</label>
                            <textarea name="review_text" class="form-control review-form-input @error('review_text') is-invalid @enderror" rows="4" placeholder="What do you think about this song?" required style="resize: vertical;"></textarea>
                            @error('review_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold" style="font-size: 1rem;">
                            Submit Review
                        </button>
                    </form>
                @else
                    <div class="text-center py-4">
                        <p class="text-white mb-3 fs-5">You must be logged in to leave a review.</p>
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-5 py-2 fw-bold">Log In to Review</a>
                        @endif
                    </div>
                @endauth
            </div>

            {{-- REVIEWS LIST (REBUILT FOR PERFECT LAYOUT) --}}
            @if ($reviews->isEmpty())
                <div class="empty-state-card py-4 text-center" style="background: rgba(20, 15, 20, 0.95); border: 1px dashed rgba(255,255,255,0.2);">
                    <p class="text-white mb-0">No reviews yet. Be the first to share your thoughts.</p>
                </div>
            @else
                <div class="d-flex flex-column gap-3">
                    @foreach ($reviews as $review)
                        <div class="review-box">
                            <div class="review-box-header">
                                <h4 class="review-author">{{ $review->user?->name ?? 'Anonymous' }}</h4>
                                
                                @php
                                    $userRating = $song->ratings->where('user_id', $review->user_id)->first();
                                    $ratingValue = $userRating ? $userRating->rating : 0;
                                @endphp
                                <div class="d-flex align-items-center gap-2">
                                    <x-star-rating :rating="$ratingValue" />
                                    <span class="text-muted small">{{ number_format($ratingValue, 1) }}</span>
                                </div>
                            </div>
                            
                            <p class="review-body">
                                {{ $review->review_text }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>

    {{-- Right Column: Related Songs --}}
    <div class="col-lg-4 position-relative" style="z-index: 2;">
        @if ($relatedSongs->isNotEmpty())
            <section>
                <h2 class="section-heading mb-3">More in {{ $song->genre?->name ?? 'this genre' }}</h2>
                <div class="d-flex flex-column gap-3">
                    @foreach ($relatedSongs as $related)
                        <a href="{{ route('songs.show', $related) }}" class="text-decoration-none">
                            <div class="related-song-card d-flex align-items-center gap-3 p-2 rounded" style="background: rgba(20, 15, 20, 0.95); border: 1px solid rgba(255,255,255,0.08); transition: transform 0.2s;">
                                <img src="{{ $related->cover_url }}" alt="cover" class="related-cover rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                <div>
                                    <h5 class="mb-0 text-truncate text-white" style="max-width: 180px; font-size: 1rem;">{{ $related->title }}</h5>
                                    <small class="text-muted">{{ $related->artist?->name ?? 'Unknown' }}</small>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>

@endsection