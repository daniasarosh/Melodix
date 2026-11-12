@extends('admin.layout')

@section('title', 'Add Video')

@section('content')
<h1>Add Video</h1>

<form class="form" method="POST" action="{{ route('admin.videos.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="field {{ $errors->has('title') ? 'has-error' : '' }}">
        <label>Title</label>
        <input type="text" name="title" value="{{ old('title') }}">
        @error('title') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('video_type') ? 'has-error' : '' }}">
        <label>Video Type</label>
        <select name="video_type">
            @foreach ($types as $value => $label)
                <option value="{{ $value }}" {{ old('video_type') == $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @error('video_type') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('artist_id') ? 'has-error' : '' }}">
        <label>Artist</label>
        <select name="artist_id">
            <option value="">Select artist</option>
            @foreach ($artists as $artist)
                <option value="{{ $artist->id }}" {{ old('artist_id') == $artist->id ? 'selected' : '' }}>{{ $artist->name }}</option>
            @endforeach
        </select>
        @error('artist_id') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('song_id') ? 'has-error' : '' }}">
        <label>Related Song (optional)</label>
        <select name="song_id">
            <option value="">No song</option>
            @foreach ($songs as $song)
                <option value="{{ $song->id }}" {{ old('song_id') == $song->id ? 'selected' : '' }}>{{ $song->title }}</option>
            @endforeach
        </select>
        @error('song_id') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('genre_id') ? 'has-error' : '' }}">
        <label>Genre</label>
        <select name="genre_id">
            <option value="">Select genre</option>
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
            @endforeach
        </select>
        @error('genre_id') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('language_id') ? 'has-error' : '' }}">
        <label>Language</label>
        <select name="language_id">
            <option value="">Select language</option>
            @foreach ($languages as $language)
                <option value="{{ $language->id }}" {{ old('language_id') == $language->id ? 'selected' : '' }}>{{ $language->name }}</option>
            @endforeach
        </select>
        @error('language_id') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('country_id') ? 'has-error' : '' }}">
        <label>Country (optional)</label>
        <select name="country_id">
            <option value="">No country</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
            @endforeach
        </select>
        @error('country_id') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('release_year') ? 'has-error' : '' }}">
        <label>Release Year</label>
        <input type="number" name="release_year" value="{{ old('release_year') }}">
        @error('release_year') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('description') ? 'has-error' : '' }}">
        <label>Description (optional)</label>
        <textarea name="description" rows="4">{{ old('description') }}</textarea>
        @error('description') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('thumbnail') ? 'has-error' : '' }}">
        <label>Thumbnail</label>
        <input type="file" name="thumbnail">
        @error('thumbnail') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('video_file') ? 'has-error' : '' }}">
        <label>Video File (mp4, webm, ogg, up to 30 MB)</label>
        <input type="file" name="video_file">
        @error('video_file') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('video_link') ? 'has-error' : '' }}">
        <label>Or Video Link (for example a YouTube link)</label>
        <input type="text" name="video_link" value="{{ old('video_link') }}">
        @error('video_link') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn">Save</button>
    <a href="{{ route('admin.videos.index') }}" class="btn btn-outline">Cancel</a>
</form>
@endsection