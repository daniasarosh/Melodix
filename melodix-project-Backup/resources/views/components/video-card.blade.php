@props(['video'])

<article class="video-card h-100">
    <div class="video-card-media">
        @if ($video->is_new)
            <x-new-badge />
        @endif

        <img
            class="thumb"
            src="{{ $video->thumbnail_url }}"
            alt="{{ $video->title }} thumbnail"
            loading="lazy"
        >

        <span class="play" aria-hidden="true">
            <i class="bi bi-play-fill"></i>
        </span>
        @if ($video->video_type)
            <span class="video-type">{{ str_replace('_', ' ', $video->video_type) }}</span>
        @endif
    </div>

    <div class="video-card-info">
        <h3 class="title" title="{{ $video->title }}">{{ $video->title }}</h3>
        <p class="sub">{{ $video->artist?->name ?? 'Unknown artist' }}</p>
        <x-star-rating :rating="$video->average_rating" />
    </div>
</article>
