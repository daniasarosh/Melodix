@extends('auth.layout')

@section('title', 'Login')

@section('content')
<form class="form" method="POST" action="/login">
    @csrf
    <h2>Login</h2>

    <div class="field">
        <label>User ID</label>
        <input type="text" name="username" value="{{ old('username') }}">
        @error('username') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label>Password</label>
        <input type="password" name="password">
        @error('password') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn">Login</button>
    <p style="margin-top: 1rem;">No account? <a href="/register">Register</a></p>
</form>
@endsection