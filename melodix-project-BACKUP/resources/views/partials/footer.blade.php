@php
    $footerColumns = [
        [
            'title' => 'Explore',
            'links' => [
                ['label' => 'Browse music', 'route' => 'browse'],
                ['label' => 'Artists', 'route' => 'artists.index'],
                ['label' => 'Albums', 'route' => 'albums.index'],
                ['label' => 'Music videos', 'route' => 'videos.index'],
                ['label' => 'Playlists', 'route' => 'playlists.index'],
            ],
        ],
        [
            'title' => 'Melodix',
            'links' => [
                ['label' => 'About us', 'route' => 'about'],
                ['label' => 'Contact', 'route' => 'contact'],
                ['label' => 'Help center', 'route' => 'help'],
            ],
        ],
        [
            'title' => 'Legal',
            'links' => [
                ['label' => 'Privacy policy', 'route' => 'privacy'],
                ['label' => 'Terms of use', 'route' => 'terms'],
            ],
        ],
    ];

    $waveBars = [];

    for ($i = 0; $i < 64; $i++) {
        $height = 6 + abs(sin($i * 0.45) * cos($i * 0.13)) * 50;

        $waveBars[] = [
            'x' => $i * 8,
            'y' => round(30 - $height / 2, 2),
            'height' => round($height, 2),
            'accent' => $i === 41,
        ];
    }
@endphp

<footer class="app-footer">
    <div class="footer-inner">

        <div class="footer-top">

            <div class="footer-brand-area">

                <a href="{{ route('home') }}" class="footer-logo" aria-label="Melodix home">
                    <img
                        src="{{ asset('images/melodix-icon-burgundy.svg') }}"
                        alt=""
                        aria-hidden="true"
                    >
                    <span>MELODIX</span>
                </a>

                <span class="footer-eyebrow">THE SOUND OF DISCOVERY</span>

                <h2 class="footer-statement">
                    Every sound<br>
                    has a <span>story.</span>
                </h2>

                <p class="footer-tagline">
                    Discover the music, artists and moments
                    that make every listening experience yours.
                </p>

            </div>

            <nav class="footer-navigation" aria-label="Footer navigation">

                @foreach ($footerColumns as $column)
                    <div class="footer-column">

                        <h3>{{ $column['title'] }}</h3>

                        <ul>
                            @foreach ($column['links'] as $link)
                                <li>
                                    @if (Route::has($link['route']))
                                        <a href="{{ route($link['route']) }}">
                                            {{ $link['label'] }}
                                        </a>
                                    @else
                                        <span class="footer-pending">
                                            {{ $link['label'] }}
                                        </span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                    </div>
                @endforeach

            </nav>

        </div>

        <div class="footer-wave" aria-hidden="true">
            <svg viewBox="0 0 512 60" preserveAspectRatio="none">
                @foreach ($waveBars as $bar)
                    <rect
                        x="{{ $bar['x'] }}"
                        y="{{ $bar['y'] }}"
                        width="3"
                        height="{{ $bar['height'] }}"
                        rx="1.5"
                        @class(['is-accent' => $bar['accent']])
                    />
                @endforeach
            </svg>
        </div>

        <div class="footer-wordmark-wrap">
            <div class="footer-wordmark" aria-hidden="true">
                Mel<span class="footer-vinyl"></span>dix
            </div>
        </div>

        <div class="footer-bottom">

            <p class="footer-copyright">
                &copy; {{ date('Y') }} Melodix. All rights reserved.
            </p>

            <div class="footer-bottom-right">

                <div class="footer-socials" aria-label="Social media">

                    <span class="footer-social-icon" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="3" y="3" width="18" height="18" rx="5"/>
                            <circle cx="12" cy="12" r="4"/>
                            <circle cx="17.5" cy="6.5" r=".7" fill="currentColor" stroke="none"/>
                        </svg>
                    </span>

                    <span class="footer-social-icon" aria-label="YouTube">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <rect x="2.5" y="5" width="19" height="14" rx="4"/>
                            <path d="m10 9 5 3-5 3z" fill="currentColor" stroke="none"/>
                        </svg>
                    </span>

                    <span class="footer-social-icon" aria-label="X">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M5 4 19 20M19 4 5 20"/>
                            <path d="M5 4h4l10 16h-4z" />
                        </svg>
                    </span>

                </div>

                <span class="footer-credit">
                    Made for the love of music.
                </span>

            </div>

        </div>

    </div>
</footer>