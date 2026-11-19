@extends('auth.layout')

@section('title', 'Login')

@section('visual-text')
    <h2>Your music, exactly where you left it.</h2>
    <p>Sign in to continue to your library, playlists and recommendations.</p>
@endsection

@section('content')
    
    <h1>Welcome back</h1>
    <p class="subtitle">Sign in to continue to your library.</p>

    <form method="POST" action="/login">
        @csrf

        <div class="form-group">
            <label>User ID</label>
            <div class="input-wrapper">
                <i class="bi bi-person"></i>
                <input type="text" name="username" value="{{ old('username') }}" placeholder="Enter your User ID" required autofocus>
            </div>
            @error('username') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <div class="input-wrapper">
                <i class="bi bi-lock"></i>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            @error('password') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn-auth">Log in</button>

        <div class="auth-footer">
            Don't have an account? <a href="/register">Sign up</a>
        </div>
    </form>

@endsection