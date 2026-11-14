@extends('admin.layout')

@section('title', 'Add Artist')

@section('content')
<h1>Add Artist</h1>

<form class="form" method="POST" action="{{ route('admin.artists.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="field {{ $errors->has('name') ? 'has-error' : '' }}">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('bio') ? 'has-error' : '' }}">
        <label>Bio</label>
        <textarea name="bio" rows="4">{{ old('bio') }}</textarea>
        @error('bio') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('photo') ? 'has-error' : '' }}">
        <label>Photo</label>
        <input type="file" name="photo">
        @error('photo') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn">Save</button>
    <a href="{{ route('admin.artists.index') }}" class="btn btn-outline">Cancel</a>
</form>
@endsection