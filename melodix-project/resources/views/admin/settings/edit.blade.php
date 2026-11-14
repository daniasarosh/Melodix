@extends('admin.layout')

@section('title', 'Site Information')

@section('content')
<h1>Site Information</h1>

<form class="form" method="POST" action="{{ route('admin.settings.update') }}" style="max-width: 560px;">
    @csrf
    @method('PUT')

    <div class="field {{ $errors->has('site_name') ? 'has-error' : '' }}">
        <label>Site Name</label>
        <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name']) }}">
        @error('site_name') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('tagline') ? 'has-error' : '' }}">
        <label>Tagline (optional)</label>
        <input type="text" name="tagline" value="{{ old('tagline', $settings['tagline']) }}">
        @error('tagline') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('about_text') ? 'has-error' : '' }}">
        <label>About Text</label>
        <textarea name="about_text" rows="8">{{ old('about_text', $settings['about_text']) }}</textarea>
        @error('about_text') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('contact_email') ? 'has-error' : '' }}">
        <label>Contact Email (optional)</label>
        <input type="text" name="contact_email" value="{{ old('contact_email', $settings['contact_email']) }}">
        @error('contact_email') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn">Save</button>
</form>
@endsection