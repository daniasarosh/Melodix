@extends('layouts.app')

@section('title', 'Search Results')
@section('meta_description', 'Search for your favorite songs, artists, and albums on Melodix.')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/song-show.css') }}">
    <style>
        /* Forces the search container to block the ambient background */
        .search-container {
            position: relative;
            z-index: 2;
            background: rgba(15, 10, 15, 0.85);
            padding: 2rem;
            border-radius: 1rem;
            min-height: 60vh;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Forces the grid to wrap properly and not collapse */
        .search-grid {
            display: flex !important;
            flex-wrap: wrap !important;
            margin-right: -12px !important;
            margin-left: -12px !important;
        }

        .search-grid-item {
            padding-right: 12px !important;
            padding-left: 12px !important;
            margin-bottom: 24px !important;
            flex: 0 0 auto !important;
            width: 50% !important; /* 2 columns on mobile */
        }

        @media (min-width: 768px) {
            .search-grid-item { width: 33.333333% !important; } /* 3 columns on tablet */
        }
        @media (min-width: 992px) {
            .search-grid-item { width: 25% !important; } /* 4 columns on desktop */
        }

        /* Ensure the song card has a minimum height so it doesn't collapse */
        .search-grid-item .song-card {
            min-height: 280px;
            width: 100%;
        }
        
        .search-grid-item .song-card img {
            height: 180px;
            width: 100%;
            object-fit: cover;
        }
    </style>
@endpush

@section('content')

<div class="search-container">
    <div class="mb-5">
        <h1 class="section-heading mb-3">Search Results</h1>
        
        @if($query)
            <p class="text-muted fs-5">Showing results for "<strong class="text-white">{{ $query }}</strong>"</p>
        @else
            <p class="text-muted fs-5">Type something in the search bar above to discover music.</p>
        @endif
    </div>

    @if($query)

        {{-- 1. SONGS RESULTS --}}
        @if($songs->isNotEmpty())
            <section class="mb-5">
                <h2 class="h4 mb-3 text-white">Songs</h2>
                <div class="search-grid">
                    @foreach($songs as $song)
                        <div class="search-grid-item">
                            <x-song-card :song="$song" />
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- 2. ARTISTS RESULTS --}}
        @if($artists->isNotEmpty())
            <section class="mb-5">
                <h2 class="h4 mb-3 text-white">Artists</h2>
                <div class="search-grid">
                    @foreach($artists as $artist)
                        <div class="search-grid-item">
                            <a href="{{ route('artists.show', $artist) }}" class="text-decoration-none text-reset d-block h-100">
                                <div class="card p-3 h-100 text-center card-hover-effect">
                                    <img src="{{ $artist->image_url ?? asset('images/placeholder-cover.png') }}" 
                                         class="rounded-circle mx-auto mb-3" 
                                         style="width: 120px; height: 120px; object-fit: cover;" 
                                         alt="{{ $artist->name }}">
                                    <h5 class="mb-0 text-white text-truncate">{{ $artist->name }}</h5>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- 3. ALBUMS RESULTS --}}
        @if($albums->isNotEmpty())
            <section class="mb-5">
                <h2 class="h4 mb-3 text-white">Albums</h2>
                <div class="search-grid">
                    @foreach($albums as $album)
                        <div class="search-grid-item">
                            <a href="{{ route('albums.show', $album) }}" class="text-decoration-none text-reset d-block h-100">
                                <div class="card p-3 h-100 text-center card-hover-effect">
                                    <img src="{{ $album->cover_url ?? asset('images/placeholder-cover.png') }}" 
                                         class="rounded mx-auto mb-3" 
                                         style="width: 140px; height: 140px; object-fit: cover;" 
                                         alt="{{ $album->title }}">
                                    <h5 class="mb-0 text-white text-truncate">{{ $album->title }}</h5>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- 4. NO RESULTS STATE --}}
        @if($songs->isEmpty() && $artists->isEmpty() && $albums->isEmpty())
            <div class="empty-state-card py-5 text-center">
                <i class="bi bi-search fs-1 text-muted mb-3 d-block"></i>
                <h3 class="text-white">No results found</h3>
                <p class="text-muted">We couldn't find any songs, artists, or albums matching "{{ $query }}".<br>Try checking your spelling or using different keywords.</p>
            </div>
        @endif

    @endif
</div>

@endsection