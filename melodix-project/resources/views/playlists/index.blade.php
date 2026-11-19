@extends('layouts.app')

@section('title', 'Playlists')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/song-show.css') }}">
    <style>
        /* Added padding to push content away from the sidebar */
        .playlist-container {
            position: relative;
            z-index: 2;
            padding: 2rem 3rem; /* Top/Bottom 2rem, Left/Right 3rem */
            min-height: 60vh;
        }

        /* Flex grid for the cards */
        .playlist-grid {
            display: flex !important;
            flex-wrap: wrap !important;
            gap: 1.5rem !important;
            margin-top: 1rem;
        }

        /* Transparent card matching the Browse page */
        .playlist-card {
            display: block !important;
            width: 180px !important;
            background: transparent !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-radius: 0.75rem !important;
            padding: 1rem !important;
            text-align: center !important;
            transition: all 0.3s ease;
            text-decoration: none !important;
        }

        .playlist-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.05) !important;
            border-color: #722F37 !important;
        }

        .playlist-card img {
            width: 100% !important;
            height: 148px !important;
            object-fit: cover !important;
            border-radius: 0.5rem !important;
            margin-bottom: 1rem !important;
        }

        .playlist-card h5 {
            color: #ffffff !important;
            font-size: 1rem !important;
            margin-bottom: 0.25rem !important;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .playlist-card p {
            color: #a0a0a0 !important;
            font-size: 0.85rem !important;
            margin: 0 !important;
        }
    </style>
@endpush

@section('content')

<div class="playlist-container">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="section-heading mb-0">Playlists</h1>
        
        @auth
            <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#createPlaylistModal">
                <i class="bi bi-plus-lg"></i> Create Playlist
            </button>
        @endauth
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- YOUR PLAYLISTS --}}
    @if($userPlaylists->isNotEmpty())
        <h2 class="h4 mb-3 text-white mt-4">Your Playlists</h2>
        <div class="playlist-grid mb-5">
            @foreach($userPlaylists as $playlist)
                <a href="{{ route('playlists.show', $playlist) }}" class="playlist-card">
                    <img src="{{ $playlist->cover_url }}" alt="{{ $playlist->name }}">
                    <h5>{{ $playlist->name }}</h5>
                    <p>{{ $playlist->items()->count() }} songs</p>
                </a>
            @endforeach
        </div>
    @endif

    {{-- CURATED PLAYLISTS --}}
    <h2 class="h4 mb-3 text-white mt-4">Curated Playlists</h2>
    <div class="playlist-grid">
        @foreach($curatedPlaylists as $playlist)
            <a href="{{ route('playlists.show', $playlist) }}" class="playlist-card">
                <img src="{{ $playlist->cover_url }}" alt="{{ $playlist->name }}">
                <h5>{{ $playlist->name }}</h5>
                <p>{{ $playlist->items()->count() }} songs</p>
            </a>
        @endforeach
    </div>
</div>

{{-- CREATE PLAYLIST MODAL --}}
@auth
<div class="modal fade" id="createPlaylistModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #1a151a; border: 1px solid rgba(255,255,255,0.1);">
            <div class="modal-header border-secondary">
                <h5 class="modal-title text-white">Create New Playlist</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('playlists.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-white small fw-bold">Playlist Name</label>
                        <input type="text" name="name" class="form-control bg-dark text-white border-secondary" required placeholder="e.g. Late Night Drives">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-white small fw-bold">Description (Optional)</label>
                        <textarea name="description" class="form-control bg-dark text-white border-secondary" rows="2" placeholder="What is this playlist about?"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-outline-light rounded-pill" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endauth
 
@endsection