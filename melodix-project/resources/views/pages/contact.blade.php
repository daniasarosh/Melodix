@extends('layouts.app')
@section('title', 'Contact Us')

@push('styles')
    <style>
        .page-container { max-width: 800px; margin: 3rem auto; padding: 2rem; position: relative; z-index: 2; }
        .glass-card { background: rgba(20, 5, 10, 0.85); backdrop-filter: blur(20px); border: 1px solid rgba(255, 50, 50, 0.3); border-radius: 1.5rem; padding: 3rem; box-shadow: 0 0 30px rgba(255, 0, 0, 0.1); }
        .page-title { color: #fff; font-weight: 700; margin-bottom: 1.5rem; }
        .form-control { background: rgba(36, 17, 15, 0.8); border: 1px solid rgba(255,255,255,0.1); color: #fff; padding: 1rem; }
        .form-control:focus { background: rgba(36, 17, 15, 1); color: #fff; border-color: #9B4452; box-shadow: none; }
        .form-label { color: #B7A89A; font-size: 0.9rem; }
    </style>
@endpush

@section('content')
<div class="page-container">
    <div class="glass-card">
        <h1 class="page-title">Contact Us</h1>
        <p class="text-muted mb-4">Have a question or feedback? Drop us a message and we'll get back to you.</p>

        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Your Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-4">
                <label class="form-label">Message</label>
                <textarea name="message" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2" style="background: #722F37; border: none;">Send Message</button>
        </form>
    </div>
</div>
@endsection