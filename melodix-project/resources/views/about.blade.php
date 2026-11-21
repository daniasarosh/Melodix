@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
<div class="melodix-home">
    <section class="home-section">
        <div class="section-heading">
            <div>
                <span class="section-eyebrow">ABOUT US</span>
                <h2>{{ $siteName }}</h2>
                @if ($tagline)
                    <p>{{ $tagline }}</p>
                @endif
            </div>
        </div>

        <p style="max-width: 720px; white-space: pre-line;">{{ $aboutText }}</p>

        @if ($contactEmail)
            <p>Contact: <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a></p>
        @endif
    </section>
</div>
@endsection