<footer class="app-footer">
    <div class="footer-container">
        <div class="footer-row">
            
            {{-- Brand Column --}}
            <div class="footer-col footer-brand">
                <div class="footer-logo mb-3">
                    <img src="{{ asset('images/melodix-logo-light.svg') }}" alt="Melodix" style="height: 40px; width: auto;">
                </div>
                <p class="footer-tagline">The sound of discovery</p>
                <h3 class="footer-slogan">Every sound<br>has a story.</h3>
            </div>

            {{-- Explore Column --}}
            <div class="footer-col">
                <h5 class="footer-heading">Explore</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('browse') }}">Browse music</a></li>
                    <li><a href="{{ route('artists.index') }}">Artists</a></li>
                    <li><a href="{{ route('albums.index') }}">Albums</a></li>
                    <li><a href="{{ route('videos.index') }}">Music Videos</a></li>
                </ul>
            </div>

            {{-- Company / Support Column --}}
            <div class="footer-col">
                <h5 class="footer-heading">Support</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    <li><a href="{{ route('help') }}">Help Center</a></li>
                    <li>
                        @auth
                            <a href="{{ route('profile') }}">My Library</a>
                        @else
                            <a href="{{ route('login') }}">My Library</a>
                        @endauth
                    </li>
                </ul>
            </div>

            {{-- Legal Column --}}
            <div class="footer-col">
                <h5 class="footer-heading">Legal</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}">Terms of Use</a></li>
                </ul>
            </div>

        </div>

        {{-- Bottom Copyright Area --}}
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Melodix by SOUND Group. All rights reserved.</p>
            <div class="footer-socials">
                <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
            </div>
        </div>
    </div>
</footer>

<style>
    /* Inline styles to guarantee the footer looks good even if your global CSS is messy */
    .app-footer {
        background: transparent;
        margin-top: 5rem;
        padding-bottom: 2rem;
        position: relative;
        z-index: 2;
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .footer-row {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 2rem;
        padding-bottom: 3rem;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    .footer-col {
        display: flex;
        flex-direction: column;
    }

    .footer-brand .footer-logo {
        display: flex;
        align-items: center;
    }

    .footer-tagline {
        color: #C8FF00; /* Brand Lime */
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .footer-slogan {
        color: #fff;
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1.1;
        margin: 0;
    }

    .footer-heading {
        color: #fff;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
    }

    .footer-links a {
        color: #B7A89A;
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.2s;
    }

    .footer-links a:hover {
        color: #fff;
    }

    .footer-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .footer-bottom p {
        color: #B7A89A;
        font-size: 0.85rem;
        margin: 0;
    }

    .footer-socials {
        display: flex;
        gap: 1rem;
    }

    .footer-socials a {
        color: #B7A89A;
        font-size: 1.2rem;
        transition: color 0.2s;
    }

    .footer-socials a:hover {
        color: #fff;
    }

    @media (max-width: 768px) {
        .footer-row {
            grid-template-columns: 1fr 1fr;
        }
        .footer-slogan {
            font-size: 2rem;
        }
    }
</style>