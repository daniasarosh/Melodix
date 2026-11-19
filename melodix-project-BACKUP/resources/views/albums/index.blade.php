@extends('layouts.app')

@section('title', 'Albums')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/albums.css') }}">
@endpush

@section('content')
<div class="melodix-home">

    {{-- HEADER --}}
    <header class="artists-directory-header" data-reveal>
        <span class="section-eyebrow">COMPLETE EXPERIENCES</span>
        <h1>Explore Albums</h1>
        <p>Dive deep into complete bodies of work from the artists you love.</p>
    </header>

    {{-- ALBUM GRID --}}
    <section class="home-section">
        @if ($albums->isNotEmpty())
            <div class="albums-page-grid" data-reveal-stagger>
                @foreach ($albums as $album)
                    <a href="{{ route('albums.show', $album->id) }}" class="album-card card-hover-effect" style="text-decoration: none;">
                        <div class="album-art">
                            <img src="{{ $album->cover_url }}" alt="{{ $album->title }}" loading="lazy">
                        </div>
                        <h3>{{ $album->title }}</h3>
                        <p>{{ $album->artist?->name ?? 'Unknown artist' }}</p>
                        @if ($album->release_year)
                            <span>{{ $album->release_year }}</span>
                        @endif
                    </a>
                @endforeach
            </div>
            
            {{-- PAGINATION --}}
            <div class="pagination-wrapper" data-reveal>
                {{ $albums->links() }}
            </div>
        @else
            <p class="home-empty">No albums found.</p>
        @endif
    </section>

</div>
@endsection