@extends('layouts.app')

@section('content')

<div class="container py-5">

    <h1>Welcome to Melodix</h1>

    <p>Your music database is connected!</p>

    <h3>Latest Songs</h3>

    @forelse($latestSongs as $song)
        <p>
            {{ $song->title }}
            — {{ $song->artist->name ?? 'Unknown Artist' }}
        </p>
    @empty
        <p>No songs available yet.</p>
    @endforelse

    <h3>Latest Videos</h3>

    @forelse($latestVideos as $video)
        <p>{{ $video->title }}</p>
    @empty
        <p>No videos available yet.</p>
    @endforelse

</div>

@endsection
