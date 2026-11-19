@extends('layouts.app')
@section('title', 'Help Center')

@push('styles')
    <style>
        .page-container { max-width: 800px; margin: 3rem auto; padding: 2rem; position: relative; z-index: 2; }
        .glass-card { background: rgba(20, 5, 10, 0.85); backdrop-filter: blur(20px); border: 1px solid rgba(255, 50, 50, 0.3); border-radius: 1.5rem; padding: 3rem; box-shadow: 0 0 30px rgba(255, 0, 0, 0.1); }
        .page-title { color: #fff; font-weight: 700; margin-bottom: 1.5rem; }
        .faq-item { margin-bottom: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 1.5rem; }
        .faq-item h5 { color: #E8DCC6; font-weight: 600; }
        .faq-item p { color: #B7A89A; font-size: 0.95rem; margin-bottom: 0; }
    </style>
@endpush

@section('content')
<div class="page-container">
    <div class="glass-card">
        <h1 class="page-title">Help Center</h1>
        <p class="text-muted mb-4">How can we help you today?</p>

        <div class="faq-item">
            <h5>How do I create a playlist?</h5>
            <p>Log in to your account, navigate to the "Playlists" page using the sidebar, and click the "Create Playlist" button.</p>
        </div>
        <div class="faq-item">
            <h5>Can I download songs for offline listening?</h5>
            <p>Currently, Melodix is a streaming-only platform. Offline mode is a feature we are exploring for future updates.</p>
        </div>
        <div class="faq-item">
            <h5>How do I reset my password?</h5>
            <p>Please contact our support team via the Contact Us page, and we will assist you with resetting your account credentials.</p>
        </div>
        <div class="faq-item">
            <h5>I found a bug. Where do I report it?</h5>
            <p>We appreciate your help! Please use the Contact Us form and select "Bug Report" in your message so our developers can look into it immediately.</p>
        </div>
    </div>
</div>
@endsection