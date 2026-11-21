<aside class="melodix-sidebar">
    
    {{-- Top Logo --}}
    <div class="sidebar-header">
        <a href="{{ route('home') }}" class="logo-wrapper">
            {{-- Using the actual full logo image --}}
            <img src="{{ asset('images/melodix-logo-light.svg') }}" alt="Melodix" class="logo-img">
            <span class="status-dot"></span>
        </a>
    </div>

    {{-- Hero Banner Section --}}
    <div class="sidebar-hero">
        <div class="hero-bg"></div>
        <div class="hero-content">
            {{-- Removed the duplicate MELODIX text, kept the subtitle --}}
            <p>Feel the Music</p>
        </div>
    </div>

    {{-- Navigation Menu --}}
    <nav class="sidebar-nav">
        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="bi bi-house-door-fill"></i>
            <span>Home</span>
            <div class="active-wave"></div>
        </a>
        <a href="{{ route('browse') }}" class="nav-link {{ request()->routeIs('browse') ? 'active' : '' }}">
            <i class="bi bi-compass-fill"></i>
            <span>Browse</span>
        </a>
        <a href="{{ route('artists.index') }}" class="nav-link {{ request()->routeIs('artists.*') ? 'active' : '' }}">
            <i class="bi bi-mic-fill"></i>
            <span>Artists</span>
        </a>
        <a href="{{ route('albums.index') }}" class="nav-link {{ request()->routeIs('albums.*') ? 'active' : '' }}">
            <i class="bi bi-disc-fill"></i>
            <span>Albums</span>
        </a>
        <a href="{{ route('videos.index') }}" class="nav-link {{ request()->routeIs('videos.*') ? 'active' : '' }}">
            <i class="bi bi-play-btn-fill"></i>
            <span>Music Videos</span>
        </a>
        
        <div class="nav-divider"></div>

        <a href="{{ route('playlists.index') }}" class="nav-link {{ request()->routeIs('playlists.*') ? 'active' : '' }}">
            <i class="bi bi-music-note-list"></i>
            <span>Playlists</span>
        </a>
        @auth
            <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                <i class="bi bi-collection-play-fill"></i>
                <span>My Library</span>
            </a>
        @else
            <a href="{{ route('login') }}" class="nav-link">
                <i class="bi bi-collection-play-fill"></i>
                <span>My Library</span>
            </a>
        @endauth

        <div class="nav-divider"></div>

        <a href="#" class="nav-link">
            <i class="bi bi-gear-fill"></i>
            <span>Settings</span>
        </a>
        
        @auth
            <form method="POST" action="{{ route('logout') }}" class="m-0 p-0 w-100">
                @csrf
                <button type="submit" class="nav-link w-100" style="background:none; border:none; text-align:left;">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>
        @endauth
    </nav>

    {{-- Floating Mini Player --}}
    <div class="mini-player">
        <div class="player-top">
            <img src="{{ asset('images/placeholder-cover.png') }}" alt="Cover" class="player-cover">
            <div class="player-info">
                <h6>Blinding Lights</h6>
                <p>The Weeknd</p>
            </div>
            <div class="player-icon">
                <i class="bi bi-bar-chart-fill" style="color: #C8FF00;"></i>
            </div>
        </div>
        <div class="player-controls">
            <i class="bi bi-shuffle"></i>
            <i class="bi bi-skip-start-fill"></i>
            <div class="play-btn"><i class="bi bi-play-fill"></i></div>
            <i class="bi bi-skip-end-fill"></i>
            <i class="bi bi-arrow-repeat"></i>
        </div>
        <div class="player-waveform">
            <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
        </div>
    </div>
</aside>