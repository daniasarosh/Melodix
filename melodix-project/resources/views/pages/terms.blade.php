@extends('layouts.app')
@section('title', 'Terms of Use')

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
        <h1 class="page-title">Terms of Use</h1>
        <p>Last updated: November 2026</p>

        <h4>1. Acceptance of Terms</h4>
        <p>By creating an account or using Melodix, you agree to these terms. If you do not agree, please do not use the platform.</p>

        <h4>2. User Conduct</h4>
        <p>You are responsible for maintaining the confidentiality of your account. You agree not to use Melodix to distribute harmful content, spam, or violate any copyright laws.</p>

        <h4>3. Content Ownership</h4>
        <p>All songs, videos, and artwork on Melodix remain the property of their respective copyright holders. You may not download, redistribute, or commercially exploit any content without permission.</p>

        <h4>4. Account Suspension</h4>
        <p>We reserve the right to suspend accounts that violate these terms or engage in abusive behavior toward other users or artists.</p>
    </div>
</div>
@endsection