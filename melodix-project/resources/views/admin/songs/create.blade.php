@extends('admin.layout')

@section('title', 'Add Song')

@section('content')
<h1>Add Song</h1>

<form class="form" method="POST" action="{{ route('admin.songs.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="field {{ $errors->has('title') ? 'has-error' : '' }}">
        <label>Title</label>
        <input type="text" name="title" value="{{ old('title') }}">
        @error('title') <div class="error-text">{{ $message }}</div> @enderror
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

    <div class="field {{ $errors->has('album_id') ? 'has-error' : '' }}">
        <label>Album (optional)</label>
        <select name="album_id">
            <option value="">No album</option>
            @foreach ($albums as $album)
                <option value="{{ $album->id }}" {{ old('album_id') == $album->id ? 'selected' : '' }}>{{ $album->title }}</option>
            @endforeach
        </select>
        @error('album_id') <div class="error-text">{{ $message }}</div> @enderror
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

    <div class="field {{ $errors->has('cover_image') ? 'has-error' : '' }}">
        <label>Cover Image</label>
        <input type="file" name="cover_image">
        @error('cover_image') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('audio_file') ? 'has-error' : '' }}">
        <label>Audio File (mp3, wav, ogg, up to 20 MB)</label>
        <input type="file" name="audio_file">
        @error('audio_file') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn">Save</button>
    <a href="{{ route('admin.songs.index') }}" class="btn btn-outline">Cancel</a>
</form>
@endsection