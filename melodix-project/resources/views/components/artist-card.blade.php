
@props(['artist'])

<a href="{{ url('/artists/' . $artist->id) }}" class="artist artist-card">

    <img
        src="{{ $artist->photo_url }}"
        alt="{{ $artist->name }}"
        loading="lazy"
    >

    <div class="name">
        {{ $artist->name }}
    </div>

    <div class="role">
        Artist
    </div>

</a>
