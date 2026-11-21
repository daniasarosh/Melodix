@extends('layouts.app')

@section('title', 'Music Videos')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/videos.css') }}">
@endpush

@section('content')
<div class="melodix-home">

    {{-- HEADER --}}
    <header class="artists-directory-header" data-reveal>
        <span class="section-eyebrow">WATCH THE SOUND</span>
        <h1>Music Videos</h1>
        <p>Official visuals, live sessions, and cinematic performances.</p>
    </header>

    {{-- VIDEO GRID --}}
    <section class="home-section">
        @if ($videos->isNotEmpty())
            <div class="videos-page-grid" data-reveal-stagger>
                @foreach ($videos as $video)
                    <x-video-card :video="$video" />
                @endforeach
            </div>
            
            <div class="pagination-wrapper" data-reveal>
                {{ $videos->links() }}
            </div>
        @else
            <p class="home-empty">No videos available yet.</p>
        @endif
    </section>

</div>
@endsection