<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/svg+xml" href="{{ asset('images/melodix-icon.svg') }}">
    <link rel="alternate icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <title>@yield('title', 'Melodix') | Melodix</title>

    <meta name="description" content="@yield('meta_description', 'Discover music, artists, albums and videos on Melodix.')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/motion.css') }}">

    @stack('styles')

<style>
    /* FORCE THE GLOBAL LAYOUT */
    body { margin: 0; padding: 0; overflow-x: hidden; background: #0a0304; }
    
    .app {
        display: block !important;
        width: 100vw;
        min-height: 100vh;
        align-items: start;
    }

    .app-content {
        margin-left: 320px !important;
        width: calc(100% - 320px) !important;
        min-width: 0;
        position: relative;
        z-index: 1;
    }

    /* THE GLASS SIDEBAR */
    .melodix-sidebar {
        width: 300px;
        height: calc(100vh - 2rem);
        position: fixed;
        left: 1rem;
        top: 1rem;
        z-index: 1000;
        background: rgba(20, 5, 10, 0.85);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 50, 50, 0.3);
        border-radius: 2rem;
        box-shadow: 0 0 30px rgba(255, 0, 0, 0.15), inset 0 0 10px rgba(255, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        overflow-x: hidden;
        padding-bottom: 1rem;
    }

    .melodix-sidebar::-webkit-scrollbar { width: 0; }

    /* Logo Header */
    .sidebar-header { padding: 2rem 1.5rem 1rem; position: relative; z-index: 10; }
    .logo-wrapper {
        position: relative;
        display: flex; align-items: center;
        text-decoration: none;
    }
    .logo-img { 
        height: 45px; /* Increased size */
        width: auto; 
        object-fit: contain;
        filter: drop-shadow(0 2px 8px rgba(0,0,0,0.5));
    }
    .status-dot {
        position: absolute; top: 0px; right: 0px; /* Adjusted for wider logo */
        width: 10px; height: 10px;
        background: #C8FF00; border-radius: 50%;
        border: 2px solid #110508;
    }

    /* Hero Section */
    .sidebar-hero {
        position: relative;
        height: 120px; /* Shorter height to make room for menu */
        margin-top: -1rem;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }
      .hero-bg {
        position: absolute; inset: 0;
        /* Replaced the placeholder image with a clean dark red glow */
        background: radial-gradient(circle at top, rgba(155, 68, 82, 0.4) 0%, transparent 70%);
        mask-image: linear-gradient(to bottom, black 40%, transparent 100%);
        -webkit-mask-image: linear-gradient(to bottom, black 40%, transparent 100%);
    }
    
    .hero-content { position: relative; z-index: 2; text-align: center; width: 100%; }
    .hero-content p { color: #B7A89A; font-size: 0.75rem; letter-spacing: 3px; margin: 0; text-transform: uppercase; }

    /* Navigation */
    .sidebar-nav { padding: 1rem; display: flex; flex-direction: column; gap: 0.25rem; }
    .nav-link {
        display: flex; align-items: center; gap: 1rem;
        padding: 0.8rem 1.2rem;
        border-radius: 2rem;
        color: #B7A89A;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s;
        position: relative;
    }
    .nav-link i { font-size: 1.2rem; }
    .nav-link:hover { color: #fff; }
    
    .nav-link.active {
        background: linear-gradient(90deg, #722F37, #9B4452);
        color: #fff;
        box-shadow: 0 0 15px rgba(255, 0, 0, 0.2), inset 0 0 10px rgba(255,255,255,0.1);
        border-left: 3px solid #C8FF00;
    }
    
    .active-wave {
        position: absolute; right: 1rem;
        width: 30px; height: 15px;
        background: repeating-linear-gradient(90deg, #fff 0, #fff 2px, transparent 2px, transparent 4px);
        opacity: 0.3;
    }

    .nav-divider { height: 1px; background: rgba(255,255,255,0.05); margin: 0.5rem 1rem; }

    /* Mini Player */
    .mini-player {
        margin-top: auto;
        margin-inline: 1rem;
        background: rgba(10, 2, 4, 0.9);
        border: 1px solid rgba(255, 50, 50, 0.2);
        border-radius: 1.5rem;
        padding: 1rem;
        box-shadow: 0 10px 20px rgba(0,0,0,0.5);
    }

    .player-top { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem; }
    .player-cover { width: 40px; height: 40px; border-radius: 0.5rem; object-fit: cover; }
    .player-info { flex: 1; }
    .player-info h6 { margin: 0; color: #fff; font-size: 0.85rem; font-weight: 600; }
    .player-info p { margin: 0; color: #B7A89A; font-size: 0.7rem; }
    
    .player-controls {
        display: flex; align-items: center; justify-content: space-between;
        color: #fff; font-size: 1rem; margin-bottom: 1rem;
    }
    .play-btn {
        width: 35px; height: 35px; background: #E8DCC6; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: #000; font-size: 1.2rem;
    }

    .player-waveform { display: flex; align-items: flex-end; gap: 2px; height: 15px; }
    .player-waveform span { flex: 1; background: #C8FF00; border-radius: 1px; height: 30%; }
    .player-waveform span:nth-child(even) { height: 60%; }
    .player-waveform span:nth-child(3n) { height: 90%; }
    .player-waveform span:nth-child(5n) { height: 100%; background: #E8DCC6; }

    @media (max-width: 992px) {
        .app-content { margin-left: 0 !important; width: 100% !important; }
        .melodix-sidebar { display: none !important; }
    }
</style>

</head>

<body>

    <canvas id="ambient-canvas"></canvas>

    <div class="app">

        @include('partials.sidebar')

        <div class="app-content">

            @include('partials.topbar')

            <main class="main page-main" style="padding: 2rem;">
                @yield('content')
            </main>

            @include('partials.footer')

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/ambient.js') }}"></script>
    <script src="{{ asset('js/waveforms.js') }}"></script>

    @stack('scripts')

</body>
</html>