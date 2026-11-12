<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Melodix Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="app">
    <aside class="sidebar">
        <a href="/admin" class="logo">
            <img src="{{ asset('images/Melodix%20logo%20Branding.svg') }}" alt="Melodix">
        </a>

        <nav class="nav">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>

<div class="nav-title">Manage</div>
<a href="{{ route('admin.artists.index') }}" class="{{ request()->routeIs('admin.artists.*') ? 'active' : '' }}">Artists</a>
<a href="{{ route('admin.albums.index') }}" class="{{ request()->routeIs('admin.albums.*')? 'active' : '' }}">Albums</a>
<a href="{{ route('admin.songs.index') }}" class="{{ request()->routeIs('admin.songs.*')? 'active' : '' }}">Songs</a>

 <a href="{{ route('admin.genres.index') }}" class="{{ request()->routeIs('admin.genres.*')? 'active' : '' }}">Genres</a>
 <a href="{{ route('admin.languages.index') }}" class="{{ request()->routeIs('admin.languages.*')? 'active' : '' }}">languages</a>
 <a href="{{ route('admin.countries.index') }}" class="{{ request()->routeIs('admin.countries.*')? 'active' : '' }}">Countries</a>
 <a href="{{ route('admin.videos.index') }}" class="{{ request()->routeIs('admin.videos.*')? 'active' : '' }}">Videos</a>
<a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">Users</a>
<a href="{{ route('admin.playlists.index') }}" class="{{ request()->routeIs('admin.playlists.*') ? 'active' : '' }}">Playlists</a>
            <div class="nav-title">Account</div>
            <a href="/">View Website</a>
        </nav>

        <form method="POST" action="/logout" style="padding: 1rem .75rem;">
            @csrf
            <button type="submit" class="btn btn-outline">Logout</button>
        </form>
    </aside>

    <main class="main">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

         @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>
</div>
</body>
</html>