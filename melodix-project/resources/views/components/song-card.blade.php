
@props(['song'])

<article class="card song-card h-100">
    <div class="song-card-cover-wrap">

        @if ($song->is_new)
            <x-new-badge />
        @endif

        <img
            class="cover"
            src="{{ $song->cover_url }}"
            alt="{{ $song->title }} cover"
            loading="lazy"
        >

        <span class="song-card-play" aria-hidden="true">
            <i class="bi bi-play-fill"></i>
        </span>

    </div>

    <div class="song-card-info">
        <h3 class="title" title="{{ $song->title }}">
            {{ $song->title }}
        </h3>

        <p class="sub">
            {{ $song->artist?->name ?? 'Unknown artist' }}
        </p>

        <x-star-rating :rating="$song->average_rating" />
    </div>
</article>
