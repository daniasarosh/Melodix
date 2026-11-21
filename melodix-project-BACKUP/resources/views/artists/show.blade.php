@extends('layouts.app')

@section('title', $artist->name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/artists.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
<div class="melodix-home">

    {{-- HERO --}}
    <header class="artist-hero">
        <img src="{{ $artist->photo_url }}" alt="{{ $artist->name }}" class="artist-hero-img">
        <div class="artist-hero-info">
            <span class="section-eyebrow">ARTIST PROFILE</span>
            <h1>{{ $artist->name }}</h1>
            <div class="artist-stats">
                <span><i class="bi bi-music-note"></i> {{ $artist->songs_count }} Songs</span>
                <span><i class="bi bi-disc"></i> {{ $artist->albums_count }} Albums</span>
            </div>
        </div>
    </header>

    {{-- BIO --}}
    @if($artist->bio)
        <p class="artist-bio">{{ $artist->bio }}</p>
    @endif

    {{-- LATEST SONGS --}}
    @if($songs->isNotEmpty())
        <section class="home-section">
            <div class="section-heading" data-reveal>
                <div>
                    <span class="section-eyebrow">LATEST RELEASES</span>
                    <h2>Popular Songs</h2>
                </div>
                <span class="section-index">01 / MUSIC</span>
            </div>
            <div class="music-grid" data-reveal-stagger>
                @foreach ($songs as $song)
                    <x-song-card :song="$song" />
                @endforeach
            </div>
        </section>
    @endif

    {{-- ALBUMS --}}
    @if($albums->isNotEmpty())
        <section class="home-section">
            <div class="section-heading" data-reveal>
                <div>
                    <span class="section-eyebrow">DISCOGRAPHY</span>
                    <h2>Albums</h2>
                </div>
                <span class="section-index">02 / ALBUMS</span>
            </div>
            <div class="album-grid" data-reveal-stagger>
                @foreach ($albums as $album)
                    <article class="album-card card-hover-effect">
                        <div class="album-art">
                            <img src="{{ $album->cover_url }}" alt="{{ $album->title }}" loading="lazy">
                        </div>
                        <h3>{{ $album->title }}</h3>
                        <span>{{ $album->release_year ?? 'Unknown Year' }}</span>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

</div>
@endsection
