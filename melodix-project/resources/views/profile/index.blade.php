@extends('layouts.app')

@section('title', 'My Profile')

@push('styles')
    <style>
        /* Force the profile container above the wavy background */
        .profile-container {
            position: relative;
            z-index: 2;
            max-width: 1000px;
            margin: 0 auto;
        }

        /* Custom Header Box */
        .profile-header-box {
            background: rgba(36, 17, 15, 0.95); /* --surface */
            border: 1px solid #4A2A2E; /* --border */
            border-radius: 1rem;
            padding: 2.5rem;
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
        }

        .profile-avatar-circle {
            width: 100px;
            height: 100px;
            background: #722F37; /* --burgundy */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #E8DCC6; /* --cream */
            border: 4px solid #341A1D;
            flex-shrink: 0;
            overflow: hidden; /* Ensures the image stays perfectly inside the circle */
        }

        .profile-header-info {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .profile-name {
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            margin: 0 0 0.25rem 0;
            white-space: normal !important;
        }

        .profile-meta {
            color: #B7A89A; /* --latte */
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        .profile-stats-row {
            display: flex;
            gap: 2rem;
        }

        .stat-box {
            display: flex;
            flex-direction: column;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            line-height: 1;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #B7A89A;
        }

        /* Grid Layout for Playlists & Reviews */
        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        @media (max-width: 768px) {
            .profile-grid { grid-template-columns: 1fr; }
            .profile-header-box { flex-direction: column; text-align: center; }
            .profile-stats-row { justify-content: center; }
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #fff;
            margin: 0;
            white-space: normal !important;
        }

        .btn-view-all {
            background: #722F37;
            color: #fff;
            padding: 0.4rem 1rem;
            border-radius: 2rem;
            text-decoration: none;
            font-size: 0.85rem;
            transition: background 0.2s;
            white-space: nowrap;
        }
        .btn-view-all:hover { background: #9B4452; color: #fff; }

        /* List Item Cards */
        .profile-list-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: rgba(36, 17, 15, 0.95);
            border: 1px solid #4A2A2E;
            border-radius: 0.75rem;
            padding: 1rem;
            margin-bottom: 0.75rem;
            text-decoration: none;
            transition: transform 0.2s, background 0.2s;
        }
        .profile-list-card:hover {
            background: rgba(52, 26, 29, 0.95);
            transform: translateY(-2px);
        }

        .list-card-img {
            width: 60px;
            height: 60px;
            border-radius: 0.5rem;
            object-fit: cover;
            flex-shrink: 0;
        }

        .list-card-content {
            display: flex;
            flex-direction: column;
            width: 100%;
            min-width: 0; /* Prevents text overflow */
        }

        .list-card-title {
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            margin: 0 0 0.25rem 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .list-card-subtitle {
            font-size: 0.85rem;
            color: #B7A89A;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .empty-state {
            background: rgba(36, 17, 15, 0.95);
            border: 1px dashed #4A2A2E;
            border-radius: 0.75rem;
            padding: 2rem;
            text-align: center;
            color: #B7A89A;
        }
    </style>
@endpush

@section('content')

@php
    // Generate Gravatar URL based on user's email
    $hash = md5(strtolower(trim($user->email)));
    $avatarUrl = "https://www.gravatar.com/avatar/{$hash}?d=mp&s=200";
@endphp

<div class="profile-container">
    
    {{-- Profile Header --}}
    <div class="profile-header-box">
        <div class="profile-avatar-circle">
            {{-- Gravatar Image --}}
            <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <div class="profile-header-info">
            <h1 class="profile-name">{{ $user->name }}</h1>
            <div class="profile-meta">@ {{ $user->username }} &bull; {{ $user->email }}</div>
            
            <div class="profile-stats-row">
                <div class="stat-box">
                    <span class="stat-number">{{ $playlists->count() }}</span>
                    <span class="stat-label">Playlists</span>
                </div>
                <div class="stat-box">
                    <span class="stat-number">{{ $reviews->count() }}</span>
                    <span class="stat-label">Reviews</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Grid Section --}}
    <div class="profile-grid">
        
        {{-- My Playlists --}}
        <div>
            <div class="section-header">
                <h2 class="section-title">My Playlists</h2>
                <a href="{{ route('playlists.index') }}" class="btn-view-all">View All</a>
            </div>
            
            @if($playlists->isEmpty())
                <div class="empty-state">You haven't created any playlists yet.</div>
            @else
                @foreach($playlists as $playlist)
                    <a href="{{ route('playlists.show', $playlist) }}" class="profile-list-card">
                        <img src="{{ $playlist->cover_url }}" alt="cover" class="list-card-img">
                        <div class="list-card-content">
                            <h5 class="list-card-title">{{ $playlist->name }}</h5>
                            <p class="list-card-subtitle">{{ $playlist->items_count }} songs</p>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>

        {{-- Recent Reviews --}}
        <div>
            <div class="section-header">
                <h2 class="section-title">Recent Reviews</h2>
            </div>
            
            @if($reviews->isEmpty())
                <div class="empty-state">You haven't written any reviews yet.</div>
            @else
                @foreach($reviews as $review)
                    @if($review->song)
                        <a href="{{ route('songs.show', $review->song) }}" class="profile-list-card">
                            <img src="{{ $review->song->cover_url }}" alt="cover" class="list-card-img">
                            <div class="list-card-content">
                                <h5 class="list-card-title">{{ $review->song->title }}</h5>
                                <p class="list-card-subtitle">Reviewed on {{ $review->created_at->format('M d, Y') }}</p>
                            </div>
                        </a>
                    @endif
                @endforeach
            @endif
        </div>

    </div>

</div>

@endsection