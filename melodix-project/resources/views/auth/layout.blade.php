<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Melodix</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div style="max-width: 420px; margin: 0 auto; padding: 2rem 1rem;">
        <a href="/"><img src="{{ asset('images/Melodix%20logo%20Branding.svg') }}" alt="Melodix" style="height: 40px; margin: 0 auto 1.5rem;"></a>
        @yield('content')
    </div>
</body>
</html>