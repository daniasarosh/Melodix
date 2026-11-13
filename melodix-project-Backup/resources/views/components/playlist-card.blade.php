@props(['playlist'])

<a href="{{ url('/playlists/' . $playlist->id) }}" class="playlist-tile playlist-card">
    <div class="playlist-card-art">
        <img src="{{ $playlist->cover_url }}" alt="" aria-hidden="true" loading="lazy">
        <i class="bi bi-play-circle-fill" aria-hidden="true"></i>
    </div>
    <div class="playlist-card-copy">
        <span class="playlist-kicker">{{ $playlist->is_curated ? 'MELODIX PICKS' : 'PLAYLIST' }}</span>
        <strong>{{ $playlist->name }}</strong>
        @if ($playlist->description)
            <small>{{ \Illuminate\Support\Str::limit($playlist->description, 58) }}</small>
        @endif
    </div>
</a>
