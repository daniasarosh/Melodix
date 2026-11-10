@extends('auth.layout')

@section('title', 'Register')

@section('content')
<form class="form" method="POST" action="/register">
    @csrf
    <h2>Register</h2>

    <div class="field">
        <label>User ID</label>
        <input type="text" name="username" value="{{ old('username') }}">
        @error('username') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label>Full Name</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label>Address</label>
        <input type="text" name="address" value="{{ old('address') }}">
        @error('address') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label>Phone</label>
        <input type="text" name="phone" value="{{ old('phone') }}">
        @error('phone') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label>Password</label>
        <input type="password" name="password">
        @error('password') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation">
    </div>

    <button type="submit" class="btn">Register</button>
    <p style="margin-top: 1rem;">Already registered? <a href="/login">Login</a></p>
</form>
@endsection