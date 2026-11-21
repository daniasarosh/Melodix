@props(['song'])

<article class="card song-card h-100 card-hover-effect position-relative" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08);">
    <div class="song-card-cover-wrap position-relative">
        @if ($song->is_new)
            <x-new-badge />
        @endif

        {{-- Added Link around the image --}}
        <a href="{{ route('songs.show', $song->id) }}" class="d-block">
            <img
                class="cover"
                src="{{ $song->cover_url ?? asset('images/placeholder-cover.png') }}"
                onerror="this.src='{{ asset('images/placeholder-cover.png') }}'"
                alt="{{ $song->title }} cover"
                loading="lazy"
                style="width: 100%; height: 100%; object-fit: cover;"
            >
        </a>

        <span class="song-card-play position-absolute top-50 start-50 translate-middle" aria-hidden="true" style="background: rgba(0,0,0,0.6); border-radius: 50%; padding: 10px 16px; color: white; pointer-events: none;">
            <i class="bi bi-play-fill fs-4"></i>
        </span>
    </div>

    <div class="song-card-info p-3">
        {{-- Added Link around the title with stretched-link --}}
        <h3 class="title text-white mb-1" style="font-size: 1rem;" title="{{ $song->title }}">
            <a href="{{ route('songs.show', $song->id) }}" class="text-decoration-none text-reset stretched-link">
                {{ $song->title }}
            </a>
        </h3>

        <p class="sub text-muted mb-2" style="font-size: 0.85rem;">
            {{ $song->artist?->name ?? 'Unknown artist' }}
        </p>

        <x-star-rating :rating="$song->average_rating" />
    </div>
</article>