
@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/playlists.css') }}">
@endpush

@section('content')

@php
    $featuredSong = $latestSongs->first();
@endphp

<div class="melodix-home">

    {{-- HERO --}}
    <section class="home-hero">

        <div class="hero-copy">
            <span class="section-eyebrow">YOUR WORLD. YOUR MUSIC.</span>

            <h1>
                Hear the music<br>
                your city forgot<br>
                to tell you about<span>.</span>
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

        @if ($featuredSong)
            <div class="hero-feature">

                <div class="hero-art">
                    <img
                        src="{{ $featuredSong->cover_url }}"
                        alt="{{ $featuredSong->title }}"
                    >

                    <div class="hero-art-overlay"></div>

                    <span class="hero-art-label">
                        FEATURED TRACK
                    </span>
                </div>

                <div class="hero-track-info">
                    <div>
                        <span>NOW DISCOVERING</span>
                        <h3>{{ $featuredSong->title }}</h3>
                        <p>{{ $featuredSong->artist?->name ?? 'Unknown artist' }}</p>
                    </div>

                    <i class="bi bi-soundwave"></i>
                </div>

            </div>
        @endif

        <div class="hero-decoration">M</div>

    </section>


    {{-- LATEST SONGS --}}
    <section class="home-section" id="latest-songs">

        <div class="section-heading">
            <div>
                <span class="section-eyebrow">FRESH SOUNDS</span>
                <h2>Latest music</h2>
                <p>New tracks waiting to be discovered.</p>
            </div>

            <span class="section-index">01 / MUSIC</span>
        </div>

        @if ($latestSongs->isNotEmpty())
            <div class="music-grid">
                @foreach ($latestSongs as $song)
                    <x-song-card :song="$song" />
                @endforeach
            </div>
        @else
            <p class="home-empty">No songs available yet.</p>
        @endif

    </section>


    {{-- MUSIC VIDEOS --}}
    <section class="home-section">

        <div class="section-heading">
            <div>
                <span class="section-eyebrow">WATCH THE SOUND</span>
                <h2>Latest music videos</h2>
                <p>Music, visuals and performances.</p>
            </div>

            <span class="section-index">02 / VIDEOS</span>
        </div>

        @if ($latestVideos->isNotEmpty())
            <div class="video-grid">
                @foreach ($latestVideos as $video)
                    <x-video-card :video="$video" />
                @endforeach
            </div>
        @else
            <p class="home-empty">No music videos available yet.</p>
        @endif

    </section>


    {{-- POPULAR ARTISTS --}}
    <section class="home-section">

        <div class="section-heading">
            <div>
                <span class="section-eyebrow">THE VOICES BEHIND THE MUSIC</span>
                <h2>Popular artists</h2>
                <p>Get to know the artists creating the sound.</p>
            </div>

            <span class="section-index">03 / ARTISTS</span>
        </div>

        @if ($popularArtists->isNotEmpty())
            <div class="artist-grid">
                @foreach ($popularArtists as $artist)
                    <x-artist-card :artist="$artist" />
                @endforeach
            </div>
        @else
            <p class="home-empty">No artists available yet.</p>
        @endif

    </section>


    {{-- FEATURED ALBUMS --}}
    <section class="home-section">

        <div class="section-heading">
            <div>
                <span class="section-eyebrow">COMPLETE EXPERIENCES</span>
                <h2>Featured albums</h2>
                <p>Explore music, one album at a time.</p>
            </div>

            <span class="section-index">04 / ALBUMS</span>
        </div>

        @if ($latestAlbums->isNotEmpty())
            <div class="album-grid">

                @foreach ($latestAlbums as $album)
                    <article class="album-card">

                        <div class="album-art">
                            <img
                                src="{{ $album->cover_url }}"
                                alt="{{ $album->title }}"
                                loading="lazy"
                            >
                        </div>

                        <h3>{{ $album->title }}</h3>

                        <p>
                            {{ $album->artist?->name ?? 'Unknown artist' }}
                        </p>

                        @if ($album->release_year)
                            <span>{{ $album->release_year }}</span>
                        @endif

                    </article>
                @endforeach

            </div>
        @else
            <p class="home-empty">No albums available yet.</p>
        @endif

    </section>


    {{-- PLAYLISTS --}}
    <section class="home-section">

        <div class="section-heading">
            <div>
                <span class="section-eyebrow">MADE FOR YOUR MOMENTS</span>
                <h2>Curated playlists</h2>
                <p>Collections selected by Melodix.</p>
            </div>

            <span class="section-index">05 / PLAYLISTS</span>
        </div>

        @if ($featuredPlaylists->isNotEmpty())
            <div class="playlist-grid">
                @foreach ($featuredPlaylists as $playlist)
                    <x-playlist-card :playlist="$playlist" />
                @endforeach
            </div>
        @else
            <p class="home-empty">No curated playlists available yet.</p>
        @endif

    </section>


    {{-- GENRES --}}
    <section class="home-section">

        <div class="section-heading">
            <div>
                <span class="section-eyebrow">FIND YOUR FREQUENCY</span>
                <h2>Browse by genre</h2>
                <p>Explore different styles and sounds.</p>
            </div>

            <span class="section-index">06 / GENRES</span>
        </div>

        @if ($genres->isNotEmpty())
            <div class="genre-grid">
                @foreach ($genres as $genre)
                    <div class="genre-tile">
                        <span>{{ $genre->name }}</span>
                        <small>{{ $genre->songs_count }} tracks</small>
                    </div>
                @endforeach
            </div>
        @else
            <p class="home-empty">No genres available yet.</p>
        @endif

    </section>


    {{-- REGIONAL DISCOVERY INTRO --}}
    <section class="regional-banner">
        <span class="section-eyebrow">MUSIC HAS NO BORDERS</span>
        <h2>Different roots.<br>One universal language.</h2>
        <p>
            Discover the sounds and musical cultures that connect us.
        </p>
    </section>

</div>

@endsection
