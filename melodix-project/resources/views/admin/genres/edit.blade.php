@extends('admin.layout')

@section('title', 'Edit Genre')

@section('content')
<h1>Edit Genre</h1>

<form class="form" method="POST" action="{{ route('admin.genres.update', $genre) }}">
    @csrf
    @method('PUT')

    <div class="field {{ $errors->has('name') ? 'has-error' : '' }}">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $genre->name) }}">
        @error('name') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn">Update</button>
    <a href="{{ route('admin.genres.index') }}" class="btn btn-outline">Cancel</a>
</form>
@endsection