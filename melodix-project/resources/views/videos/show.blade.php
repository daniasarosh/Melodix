@extends('layouts.app')

@section('title', $video->title)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/videos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
<div class="melodix-home">

<div class="video-player-container" data-reveal>
    @if($video->video_source)
        <video controls style="width: 100%; height: 100%; object-fit: cover;">
            <source src="{{ asset('storage/' . $video->video_source) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    @else
        <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}">
        <div class="video-player-overlay">
            <button class="video-play-btn" aria-label="Play video">
                <i class="bi bi-play-fill"></i>
            </button>
        </div>
    @endif
</div>

    {{-- VIDEO INFO --}}
    <header class="video-detail-header" data-reveal>
        <span class="section-eyebrow">{{ str_replace('_', ' ', $video->video_type) }}</span>
        <h1>{{ $video->title }}</h1>
        
        <div class="video-detail-meta">
            @if($video->artist)
                <span><i class="bi bi-person"></i> {{ $video->artist->name }}</span>
            @endif
            @if($video->genre)
                <span><i class="bi bi-music-note-list"></i> {{ $video->genre->name }}</span>
            @endif
            <span><i class="bi bi-calendar"></i> {{ $video->release_year ?? 'Unknown Year' }}</span>
            <span><i class="bi bi-star-fill" style="color: var(--gold);"></i> {{ $video->average_rating }} / 5</span>
        </div>

        @if($video->description)
            <p class="video-description" style="margin-top: 1.5rem;">{{ $video->description }}</p>
        @endif
    </header>

    {{-- RELATED VIDEOS --}}
    @if($relatedVideos->isNotEmpty())
        <section class="home-section">
            <div class="section-heading" data-reveal>
                <div>
                    <span class="section-eyebrow">MORE FROM THIS ARTIST</span>
                    <h2>Related Videos</h2>
                </div>
            </div>
            
            <div class="videos-page-grid" data-reveal-stagger>
                @foreach ($relatedVideos as $related)
                    <x-video-card :video="$related" />
                @endforeach
            </div>
        </section>
    @endif

</div>
@endsection