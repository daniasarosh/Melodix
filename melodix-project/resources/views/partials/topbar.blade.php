<header class="topbar app-topbar">

    <div class="topbar-heading">
        <span class="topbar-eyebrow">WELCOME TO</span>
        <strong>MELODIX</strong>
    </div>

    <form class="topbar-search" role="search" action="{{ route('search') }}" method="GET">
        <button type="submit" class="search-submit-btn" aria-label="Submit search" style="background: none; border: none; padding: 0; display: flex; align-items: center; color: inherit; cursor: pointer;">
            <i class="bi bi-search" aria-hidden="true"></i>
        </button>
        <input
            type="search"
            name="q"
            value="{{ request('q') }}"
            placeholder="Search songs, artists, albums..."
            aria-label="Search music"
            required
        >
    </form>

    <div class="topbar-actions">
        @auth
            {{-- Logged In: Show Avatar Dropdown --}}
            <div class="dropdown">
                <a class="topbar-avatar dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;">
                    <i class="bi bi-person"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow" style="background: #24110F; border: 1px solid #4A2A2E;">
                    <li>
                        <div class="dropdown-header text-white">
                            <strong>{{ auth()->user()->name }}</strong><br>
                            <small class="text-muted">@ {{ auth()->user()->username }}</small>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider border-secondary"></li>
                    <li>
                        <a class="dropdown-item text-white" href="{{ route('profile') }}">
                            <i class="bi bi-person-circle me-2"></i> My Profile
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            {{-- Guest: Show Login/Register Buttons --}}
            <div class="d-flex gap-2">
                <a href="{{ route('login') }}" class="btn btn-outline-light rounded-pill btn-sm px-3">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary rounded-pill btn-sm px-3" style="background: var(--burgundy); border: none;">Sign Up</a>
            </div>
        @endauth
    </div>

</header>