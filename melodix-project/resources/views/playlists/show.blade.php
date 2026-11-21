@extends('layouts.app')

@section('title', $playlist->name)

@push('styles')
    <style>
        .playlist-header {
            background: linear-gradient(135deg, #722F37 0%, #160A0C 100%);
            border-radius: 1rem;
            padding: 3rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: flex-end;
            gap: 2rem;
            position: relative;
            z-index: 2;
            border: 1px solid #4A2A2E;
        }
        .playlist-cover {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 0.75rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            flex-shrink: 0;
        }
        .playlist-info h1 {
            font-size: 3rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 0.5rem;
        }
        .playlist-info p {
            color: #B7A89A;
            margin-bottom: 0.5rem;
        }
        .song-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            background: rgba(36, 17, 15, 0.95);
            border: 1px solid #4A2A2E;
            border-radius: 0.75rem;
            margin-bottom: 0.5rem;
            transition: background 0.2s;
            position: relative;
            z-index: 2;
        }
        .song-row:hover { background: rgba(52, 26, 29, 0.95); }
        .song-info { display: flex; align-items: center; gap: 1rem; }
        .song-index { color: #B7A89A; font-weight: 600; width: 20px; }
        .song-thumb { width: 50px; height: 50px; border-radius: 0.5rem; object-fit: cover; }
        .song-title { color: #fff; font-weight: 600; text-decoration: none; display: block; }
        .song-artist { color: #B7A89A; font-size: 0.85rem; }
        .song-title:hover { color: #722F37; }
    </style>
@endpush

@section('content')

<div class="playlist-header">
    <img src="{{ $playlist->cover_url }}" alt="{{ $playlist->name }}" class="playlist-cover">
    <div class="playlist-info">
        <span class="badge bg-secondary mb-2">{{ $playlist->is_curated ? 'Curated Playlist' : 'User Playlist' }}</span>
        <h1>{{ $playlist->name }}</h1>
        @if($playlist->description)
            <p>{{ $playlist->description }}</p>
        @endif
        <p class="mb-0"><strong>{{ $songs->count() }}</strong> songs</p>
    </div>
</div>

<div class="container px-0">
    @if($songs->isEmpty())
        <div class="empty-state text-center p-5 rounded" style="background: rgba(36, 17, 15, 0.95); border: 1px dashed #4A2A2E; position: relative; z-index: 2;">
            <i class="bi bi-music-note fs-1 text-muted mb-3 d-block"></i>
            <h4 class="text-white">This playlist is empty</h4>
            <p class="text-muted">Go browse some songs and add them here!</p>
        </div>
    @else
        @foreach($songs as $song)
            <div class="song-row">
                <div class="song-info">
                    <span class="song-index">{{ $loop->iteration }}</span>
                    <img src="{{ $song->cover_url }}" alt="cover" class="song-thumb">
                    <div>
                        <a href="{{ route('songs.show', $song) }}" class="song-title">{{ $song->title }}</a>
                        <span class="song-artist">{{ $song->artist?->name ?? 'Unknown' }}</span>
                    </div>
                </div>
                
                @auth
                    @if($playlist->user_id === auth()->id())
                        <form action="{{ route('playlists.removeSong', [$playlist, $playlist->items->where('song_id', $song->id)->first()->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Remove from playlist">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        @endforeach
    @endif
</div>

@endsection