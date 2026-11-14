@extends('admin.layout')

@section('title', 'Add Playlist')

@section('content')
<h1>Add Playlist</h1>

<form class="form" method="POST" action="{{ route('admin.playlists.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="field {{ $errors->has('name') ? 'has-error' : '' }}">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('description') ? 'has-error' : '' }}">
        <label>Description (optional)</label>
        <input type="text" name="description" value="{{ old('description') }}">
        @error('description') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('cover_image') ? 'has-error' : '' }}">
        <label>Cover Image</label>
        <input type="file" name="cover_image">
        @error('cover_image') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn">Save</button>
    <a href="{{ route('admin.playlists.index') }}" class="btn btn-outline">Cancel</a>
</form>
@endsection