@extends('admin.layout')

@section('title', 'Edit Artist')

@section('content')
<h1>Edit Artist</h1>

<form class="form" method="POST" action="{{ route('admin.artists.update', $artist) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="field {{ $errors->has('name') ? 'has-error' : '' }}">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $artist->name) }}">
        @error('name') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('bio') ? 'has-error' : '' }}">
        <label>Bio</label>
        <textarea name="bio" rows="4">{{ old('bio', $artist->bio) }}</textarea>
        @error('bio') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('photo') ? 'has-error' : '' }}">
        <label>Photo</label>
        <img src="{{ $artist->photo_url }}" alt="{{ $artist->name }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; margin-bottom: .5rem;">
        <input type="file" name="photo">
        <p class="muted" style="margin-top: .3rem; font-size: .8rem;">Leave empty to keep the current photo.</p>
        @error('photo') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn">Update</button>
    <a href="{{ route('admin.artists.index') }}" class="btn btn-outline">Cancel</a>
</form>
@endsection