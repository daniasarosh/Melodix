@extends('layouts.app')

@section('title', 'Artists')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/artists.css') }}">
@endpush

@section('content')
<div class="melodix-home">

    {{-- HEADER --}}
    <header class="artists-directory-header" data-reveal>
        <span class="section-eyebrow">THE VOICES BEHIND THE MUSIC</span>
        <h1>Explore Artists</h1>
        <p>Discover the creators, singers, and musicians shaping the sound of Melodix.</p>
    </header>

    {{-- ARTIST GRID --}}
    <section class="home-section">
        @if ($artists->isNotEmpty())
            <div class="artists-page-grid" data-reveal-stagger>
                @foreach ($artists as $artist)
                    <x-artist-card :artist="$artist" />
                @endforeach
            </div>
        @else
            <p class="home-empty">No artists found in the database.</p>
        @endif
    </section>

</div>
@endsection