@extends('admin.layout')

@section('title', 'Add Album')

@section('content')
<h1>Add Album</h1>

<form class="form" method="POST" action="{{ route('admin.albums.store') }}" enctype="multipart/form-data">
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

    <div class="field {{ $errors->has('release_year') ? 'has-error' : '' }}">
        <label>Release Year</label>
        <input type="number" name="release_year" value="{{ old('release_year') }}">
        @error('release_year') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('cover_image') ? 'has-error' : '' }}">
        <label>Cover Image</label>
        <input type="file" name="cover_image">
        @error('cover_image') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn">Save</button>
    <a href="{{ route('admin.albums.index') }}" class="btn btn-outline">Cancel</a>
</form>
@endsection