@extends('layouts.app')
@section('title', 'Privacy Policy')

@push('styles')
    <style>
        .page-container { max-width: 900px; margin: 3rem auto; padding: 2rem; position: relative; z-index: 2; }
        .glass-card { background: rgba(20, 5, 10, 0.85); backdrop-filter: blur(20px); border: 1px solid rgba(255, 50, 50, 0.3); border-radius: 1.5rem; padding: 4rem; box-shadow: 0 0 30px rgba(255, 0, 0, 0.1); }
        .page-title { color: #fff; font-weight: 700; margin-bottom: 1.5rem; }
        .legal-text h4 { color: #E8DCC6; margin-top: 2rem; font-size: 1.2rem; }
        .legal-text p { color: #B7A89A; font-size: 0.95rem; line-height: 1.7; }
    </style>
@endpush

@section('content')
<div class="page-container">
    <div class="glass-card legal-text">
        <h1 class="page-title">Privacy Policy</h1>
        <p>Last updated: November 2026</p>

        <h4>1. Information We Collect</h4>
        <p>When you register on Melodix, we collect your username, name, email address, phone number, and physical address. We also track your listening history, playlists, and interactions to improve your experience.</p>

        <h4>2. How We Use Your Data</h4>
        <p>We use your data to provide personalized recommendations, maintain your library across devices, and ensure the security of your account. We do not sell your personal information to third parties.</p>

        <h4>3. Cookies and Tracking</h4>
        <p>Melodix uses session cookies to keep you logged in. We may also use analytics tools to understand which features are most popular, helping us improve the platform.</p>

        <h4>4. Data Security</h4>
        <p>We implement industry-standard security measures to protect your data. Passwords are hashed and encrypted, and we regularly review our systems for vulnerabilities.</p>
    </div>
</div>
@endsection