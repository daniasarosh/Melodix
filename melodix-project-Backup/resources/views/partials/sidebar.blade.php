<aside class="sidebar app-sidebar">
    <a href="{{ url('/') }}" class="logo sidebar-logo" aria-label="Melodix home">
        <img src="{{ asset('images/melodix-icon.svg') }}" alt="Melodix">
    </a>

    <div class="sidebar-group">
        <p class="nav-title">Discover</p>
        <nav class="nav sidebar-nav" aria-label="Main navigation">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i><span>Home</span>
            </a>
            <a href="{{ url('/browse') }}" class="{{ request()->is('browse*') ? 'active' : '' }}">
                <i class="bi bi-compass"></i><span>Browse</span>
            </a>
            <a href="{{ url('/artists') }}" class="{{ request()->is('artists*') ? 'active' : '' }}">
                <i class="bi bi-mic"></i><span>Artists</span>
            </a>
            <a href="{{ url('/albums') }}" class="{{ request()->is('albums*') ? 'active' : '' }}">
                <i class="bi bi-disc"></i><span>Albums</span>
            </a>
            <a href="{{ url('/videos') }}" class="{{ request()->is('videos*') ? 'active' : '' }}">
                <i class="bi bi-play-btn"></i><span>Music Videos</span>
            </a>
        </nav>
    </div>

    <div class="sidebar-group">
        <p class="nav-title">Your music</p>
        <nav class="nav sidebar-nav" aria-label="Your music navigation">
            <a href="{{ url('/playlists') }}" class="{{ request()->is('playlists*') ? 'active' : '' }}">
                <i class="bi bi-music-note-list"></i><span>Playlists</span>
            </a>
            <a href="{{ url('/my-playlists') }}" class="{{ request()->is('my-playlists*') ? 'active' : '' }}">
                <i class="bi bi-collection-play"></i><span>My Library</span>
            </a>
        </nav>
    </div>

    <div class="sidebar-bottom">
        <span class="sidebar-note"><i class="bi bi-soundwave"></i> Your sound. Your space.</span>
    </div>
</aside>
