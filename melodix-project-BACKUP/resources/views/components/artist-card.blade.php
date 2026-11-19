@props(['artist'])

<a href="{{ url('/artists/' . $artist->id) }}" class="artist artist-card card-hover-effect">
    <img
        src="{{ $artist->photo_url }}"
        alt="{{ $artist->name }}"
        loading="lazy"
    >
    <div class="name">
        {{ $artist->name }}
    </div>
    <div class="role">
        {{ $artist->songs_count ?? 0 }} Songs
    </div>
</a>