@extends('admin.layout')

@section('title', 'Edit Album')

@section('content')
<h1>Edit Album</h1>

<form class="form" method="POST" action="{{ route('admin.albums.update', $album) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="field {{ $errors->has('title') ? 'has-error' : '' }}">
        <label>Title</label>
        <input type="text" name="title" value="{{ old('title', $album->title) }}">
        @error('title') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('artist_id') ? 'has-error' : '' }}">
        <label>Artist</label>
        <select name="artist_id">
            <option value="">Select artist</option>
            @foreach ($artists as $artist)
                <option value="{{ $artist->id }}" {{ old('artist_id', $album->artist_id) == $artist->id ? 'selected' : '' }}>{{ $artist->name }}</option>
            @endforeach
        </select>
        @error('artist_id') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('release_year') ? 'has-error' : '' }}">
        <label>Release Year</label>
        <input type="number" name="release_year" value="{{ old('release_year', $album->release_year) }}">
        @error('release_year') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('cover_image') ? 'has-error' : '' }}">
        <label>Cover Image</label>
        <img src="{{ $album->cover_url }}" alt="{{ $album->title }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; margin-bottom: .5rem;">
        <input type="file" name="cover_image">
        <p class="muted" style="margin-top: .3rem; font-size: .8rem;">Leave empty to keep the current cover.</p>
        @error('cover_image') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn">Update</button>
    <a href="{{ route('admin.albums.index') }}" class="btn btn-outline">Cancel</a>
</form>
@endsection