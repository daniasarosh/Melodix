@extends('auth.layout')

@section('title', 'Register')

@section('visual-text')
    <h2>Start listening in under a minute.</h2>
    <p>Join Melodix and build a library that sounds like you.</p>
@endsection

@section('content')
    
    <h1>Create your account</h1>
    <p class="subtitle">Join Melodix and build a library that sounds like you.</p>

    <form method="POST" action="/register">
        @csrf

        <div class="form-group">
            <label>Full Name</label>
            <div class="input-wrapper">
                <i class="bi bi-person"></i>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Aria Nolan" required>
            </div>
            @error('name') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>User ID</label>
            <div class="input-wrapper">
                <i class="bi bi-at"></i>
                <input type="text" name="username" value="{{ old('username') }}" placeholder="e.g. aria.nolan" required>
            </div>
            @error('username') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <div class="input-wrapper">
                <i class="bi bi-envelope"></i>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="e.g. aria@email.com" required>
            </div>
            @error('email') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        {{-- Added Address & Phone (required by Member 1's backend) --}}
        <div class="form-group">
            <label>Address</label>
            <div class="input-wrapper">
                <i class="bi bi-geo-alt"></i>
                <input type="text" name="address" value="{{ old('address') }}" placeholder="Your city/address" required>
            </div>
            @error('address') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Phone Number</label>
            <div class="input-wrapper">
                <i class="bi bi-telephone"></i>
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="e.g. 03001234567" required>
            </div>
            @error('phone') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <div class="input-wrapper">
                <i class="bi bi-lock"></i>
                <input type="password" name="password" placeholder="Create a strong password" required>
            </div>
            @error('password') <div class="error-text">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <div class="input-wrapper">
                <i class="bi bi-shield-lock"></i>
                <input type="password" name="password_confirmation" placeholder="Confirm password" required>
            </div>
        </div>

        <button type="submit" class="btn-auth">Create account</button>

        <div class="auth-footer">
            Already have an account? <a href="/login">Sign in</a>
        </div>
    </form>

@endsection