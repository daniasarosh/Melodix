<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Melodix</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <style>
        :root {
            --burgundy: #722F37;
            --burgundy-light: #9B4452;
            --cream: #E8DCC6;
            --latte: #B7A89A;
            --lime: #C8FF00;
            --bg-main: #160A0C;
            --surface: #24110F;
            --surface-secondary: #341A1D;
            --border: #4A2A2E;
            --error: #E5666F;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-main);
            color: var(--cream);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
        }

        .auth-wrapper {
            display: flex;
            width: 100%;
            max-width: 1100px;
            min-height: 700px;
            margin: 2rem;
            border-radius: 1.5rem;
            background: var(--bg-main);
            border: 1px solid var(--border);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
            overflow: hidden;
        }

        /* LEFT SIDE: Visuals */
        .auth-visual {
            flex: 1;
            background: linear-gradient(135deg, var(--surface) 0%, var(--bg-main) 100%);
            position: relative;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-right: 1px solid var(--border);
            overflow: hidden;
        }

        /* Abstract shapes mimicking your mockup */
        .visual-shape {
            position: absolute;
            border-radius: 1rem;
            background: var(--burgundy);
            opacity: 0.8;
        }
        .shape-1 { width: 120px; height: 120px; top: 10%; left: 10%; transform: rotate(-15deg); }
        .shape-2 { width: 180px; height: 80px; top: 30%; right: 10%; background: var(--burgundy-light); transform: rotate(25deg); }
        .shape-3 { width: 150px; height: 150px; bottom: 20%; right: 5%; border-radius: 50%; background: var(--surface-secondary); border: 2px solid var(--border); }
        
        .visual-disc {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 350px; height: 350px;
            border-radius: 50%;
            background: repeating-radial-gradient(circle, var(--surface) 0, var(--surface) 4px, var(--bg-main) 5px, var(--bg-main) 10px);
            border: 4px solid var(--burgundy);
            box-shadow: 0 0 50px rgba(0,0,0,0.8);
            animation: spin 20s linear infinite;
        }
        .visual-disc::after {
            content: '';
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 60px; height: 60px;
            background: var(--burgundy);
            border-radius: 50%;
            border: 4px solid var(--bg-main);
        }

        @keyframes spin { 100% { transform: translate(-50%, -50%) rotate(360deg); } }

        .visual-text {
            position: relative;
            z-index: 10;
            margin-top: auto;
        }
        .visual-text h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--cream);
            line-height: 1.2;
            margin-bottom: 1rem;
        }
        .visual-text p {
            color: var(--latte);
            font-size: 1rem;
            max-width: 300px;
        }

        .visual-branding {
            position: relative;
            z-index: 10;
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--cream);
        }
        
        /* Updated Brand Icon Image Style */
            .brand-icon-img {
            width: 160px;
            height: auto; 
            object-fit: contain;
            filter: drop-shadow(0 2px 8px rgba(0,0,0,0.6)); /* Slightly stronger shadow */
        }

        /* RIGHT SIDE: Form */
        .auth-form-container {
            flex: 1;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: var(--bg-main);
        }

        .auth-form-container h1 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--cream);
            margin-bottom: 0.5rem;
        }
        .auth-form-container p.subtitle {
            color: var(--latte);
            font-size: 0.95rem;
            margin-bottom: 2rem;
        }

        .form-group { margin-bottom: 1.25rem; }
        .form-group label {
            display: block;
            color: var(--cream);
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }
        .input-wrapper i {
            position: absolute;
            left: 1rem;
            color: var(--latte);
            font-size: 1.2rem;
        }
        .input-wrapper input {
            width: 100%;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            padding: 0.85rem 1rem 0.85rem 3rem;
            color: var(--cream);
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }
        .input-wrapper input:focus {
            outline: none;
            border-color: var(--burgundy-light);
            box-shadow: 0 0 0 3px rgba(114, 47, 55, 0.3);
        }
        .input-wrapper input::placeholder { color: var(--latte); opacity: 0.7; }

        .error-text {
            color: var(--error);
            font-size: 0.8rem;
            margin-top: 0.4rem;
        }

        .btn-auth {
            width: 100%;
            background: var(--burgundy);
            color: var(--cream);
            border: none;
            border-radius: 0.75rem;
            padding: 1rem;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }
        .btn-auth:hover {
            background: var(--burgundy-light);
            transform: translateY(-2px);
        }

        .auth-footer {
            text-align: center;
            margin-top: 2rem;
            color: var(--latte);
            font-size: 0.9rem;
        }
        .auth-footer a {
            color: var(--cream);
            font-weight: 600;
            text-decoration: underline;
            transition: color 0.3s;
        }
        .auth-footer a:hover { color: var(--burgundy-light); }

        /* Responsive */
        @media (max-width: 992px) {
            .auth-wrapper { flex-direction: column; margin: 1rem; min-height: auto; }
            .auth-visual { display: none; } /* Hide graphics on mobile */
            .auth-form-container { padding: 2rem; }
        }
    </style>
</head>
<body>

    <div class="auth-wrapper">
        
        {{-- LEFT VISUAL PANEL --}}
        <div class="auth-visual">
            <div class="visual-shape shape-1"></div>
            <div class="visual-shape shape-2"></div>
            <div class="visual-shape shape-3"></div>
            <div class="visual-disc"></div>

            <div class="visual-branding">
                <img src="{{ asset('images/melodix-logo-light-darkbg.svg') }}" alt="Melodix Logo" class="brand-icon-img">
            </div>

            <div class="visual-text">
                @yield('visual-text')
            </div>
        </div>

        {{-- RIGHT FORM PANEL --}}
        <div class="auth-form-container">
            @yield('content')
        </div>

    </div>

</body>
</html>