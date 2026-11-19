@extends('layouts.app')

@section('title', 'Discover Music')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/browse.css') }}">
@endpush
@section('content')
<div class="melodix-home">

    {{-- 1. BROWSE HERO --}}
    <section class="browse-hero">
        <div class="hero-copy" data-reveal>
            <span class="section-eyebrow">YOUR WORLD. YOUR MUSIC.</span>
            
            {{-- Fixed: Replaced lime with cream for the final dot --}}
            <h1>
                <span class="reveal-text-wrap"><span class="reveal-text">Hear the music</span></span><br>
                <span class="reveal-text-wrap"><span class="reveal-text delay-1">your city forgot</span></span><br>
                <span class="reveal-text-wrap"><span class="reveal-text delay-2">to tell you about<span style="color:var(--cream)">.</span></span></span>
            </h1>
            
            <p>
                Discover new sounds, explore artists and find music
                that speaks to you.
            </p>
            <a href="#latest-songs" class="hero-button">
                Explore music
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="hero-decoration"></div>
    </section>

    {{-- 2. GENRES --}}
    <section class="home-section">
        <div class="section-heading" data-reveal>
            <div>
                <span class="section-eyebrow">FIND YOUR FREQUENCY</span>
                <h2>Browse by genre</h2>
                <p>Explore different styles and sounds.</p>
            </div>
            <span class="section-index">01 / GENRES</span>
        </div>

        @if($genres->isNotEmpty())
            <div class="genre-grid" data-reveal-stagger>
                @foreach($genres as $genre)
                    <a href="#" class="genre-tile">
                        <span>{{ $genre->name }}</span>
                        <small>{{ $genre->songs_count }} tracks</small>
                    </a>
                @endforeach
            </div>
        @else
            <p class="home-empty">No genres available yet.</p>
        @endif
    </section>

    {{-- 3. NEW RELEASES (LATEST MUSIC) --}}
    <section class="home-section" id="latest-songs">
        <div class="section-heading" data-reveal>
            <div>
                <span class="section-eyebrow">FRESH SOUNDS</span>
                <h2>Latest music</h2>
                <p>New tracks waiting to be discovered.</p>
            </div>
            <span class="section-index">02 / MUSIC</span>
        </div>

        @if ($latestSongs->isNotEmpty())
            <div class="music-grid" data-reveal-stagger>
                @foreach ($latestSongs as $song)
                    <x-song-card :song="$song" />
                @endforeach
            </div>
        @else
            <p class="home-empty">No songs available yet.</p>
        @endif
    </section>

    {{-- 4. POPULAR ARTISTS --}}
    <section class="home-section">
        <div class="section-heading" data-reveal>
            <div>
                <span class="section-eyebrow">THE VOICES BEHIND THE MUSIC</span>
                <h2>Popular artists</h2>
                <p>Get to know the artists creating the sound.</p>
            </div>
            <span class="section-index">03 / ARTISTS</span>
        </div>

        @if ($popularArtists->isNotEmpty())
            <div class="artist-grid" data-reveal-stagger>
                @foreach ($popularArtists as $artist)
                    <x-artist-card :artist="$artist" />
                @endforeach
            </div>
        @else
            <p class="home-empty">No artists available yet.</p>
        @endif
    </section>

</div>
@endsection