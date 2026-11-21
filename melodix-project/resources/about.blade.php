@extends('layouts.app')

@section('title', 'About Us')
@section('meta_description', 'Learn more about Melodix, the music platform built for discovery.')

@push('styles')
    <style>
        .about-container {
            position: relative;
            z-index: 2;
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem;
        }

        .about-hero {
            background: rgba(20, 5, 10, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 50, 50, 0.3);
            border-radius: 2rem;
            padding: 4rem 2rem;
            text-align: center;
            margin-bottom: 3rem;
            box-shadow: 0 0 30px rgba(255, 0, 0, 0.1);
        }

        .about-hero h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 1rem;
        }

        .about-hero p {
            font-size: 1.2rem;
            color: #B7A89A;
            max-width: 600px;
            margin: 0 auto;
        }

        .about-content {
            background: rgba(36, 17, 15, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 1rem;
            padding: 3rem;
            color: #E8DCC6;
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .about-content p {
            margin-bottom: 1.5rem;
        }

        .contact-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: rgba(114, 47, 55, 0.3);
            border: 1px solid #722F37;
            padding: 1.5rem;
            border-radius: 1rem;
            margin-top: 2rem;
        }

        .contact-card i {
            font-size: 2rem;
            color: #C8FF00;
        }

        .contact-card h4 {
            margin: 0;
            color: #fff;
            font-size: 1.1rem;
        }

        .contact-card a {
            color: #B7A89A;
            text-decoration: none;
        }
    </style>
@endpush

@section('content')

<div class="about-container">
    
    {{-- Hero Section --}}
    <div class="about-hero">
        <h1>About {{ $siteName }}</h1>
        <p>{{ $tagline }}</p>
    </div>

    {{-- Main Content --}}
    <div class="about-content">
        <p>{{ $aboutText }}</p>
        
        <p>
            Melodix was designed to be more than just a streaming platform. We believe that music is a personal journey. 
            Whether you are discovering regional artists, building the perfect late-night playlist, or diving into the 
            latest music videos, our platform is built to help you connect with the sounds you love.
        </p>

        <p>
            Built with passion by a dedicated team, Melodix focuses on seamless discovery, high-quality audio, and a 
            community-driven experience where your reviews and ratings help shape the musical landscape.
        </p>

        {{-- Contact Info --}}
        <div class="contact-card">
            <i class="bi bi-envelope-paper-fill"></i>
            <div>
                <h4>Get in touch</h4>
                <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
            </div>
        </div>
    </div>

</div>

@endsection