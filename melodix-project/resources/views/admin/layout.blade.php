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
            <a href="/admin" class="active">Dashboard</a>

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

        @yield('content')
    </main>
</div>
</body>
</html>