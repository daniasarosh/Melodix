@extends('layouts.app')

@section('title', $album->title)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/albums.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
<div class="melodix-home">

    {{-- HEADER --}}
    <header class="album-header">
        <img src="{{ $album->cover_url }}" alt="{{ $album->title }}" class="album-cover-large">
        <div class="album-info">
            <span class="section-eyebrow">ALBUM</span>
            <h1>{{ $album->title }}</h1>
            <div class="album-meta">
                @if($album->artist)
                    <img src="{{ $album->artist->photo_url }}" alt="{{ $album->artist->name }}">
                    <strong>{{ $album->artist->name }}</strong>
                    <span>•</span>
                @endif
                <span>{{ $album->release_year ?? 'Unknown Year' }}</span>
                <span>•</span>
                <span>{{ $album->songs->count() }} tracks</span>
            </div>
        </div>
    </header>

    {{-- TRACKLIST --}}
    <section class="home-section">
        <div class="section-heading" data-reveal>
            <div>
                <span class="section-eyebrow">TRACKLIST</span>
                <h2>Songs</h2>
            </div>
        </div>

        @if ($album->songs->isNotEmpty())
            {{-- We reuse the music grid and the song card component --}}
            <div class="music-grid" data-reveal-stagger>
                @foreach ($album->songs as $song)
                    <x-song-card :song="$song" />
                @endforeach
            </div>
        @else
            <p class="home-empty">No songs have been added to this album yet.</p>
        @endif
    </section>

</div>
@endsection