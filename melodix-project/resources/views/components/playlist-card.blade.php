
@props(['playlist'])

<a href="{{ url('/playlists/' . $playlist->id) }}" class="playlist-card curated-playlist-card">

    <div class="curated-playlist-art">
        <span class="curated-playlist-letter">M</span>
        <span class="curated-playlist-indicator">
            <span></span>
        </span>
    </div>

    <div class="playlist-card-copy">
        <span class="playlist-kicker">
            {{ $playlist->is_curated ? 'MELODIX PICKS' : 'PLAYLIST' }}
        </span>

        <strong>{{ $playlist->name }}</strong>

        @if ($playlist->description)
            <small>
                {{ \Illuminate\Support\Str::limit($playlist->description, 58) }}
            </small>
        @endif
    </div>

</a>
