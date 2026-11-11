@extends('admin.layout')

@section('title', 'Edit Language')

@section('content')
<h1>Edit Language</h1>

<form class="form" method="POST" action="{{ route('admin.languages.update', $language) }}">
    @csrf
    @method('PUT')

    <div class="field {{ $errors->has('name') ? 'has-error' : '' }}">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $language->name) }}">
        @error('name') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn">Update</button>
    <a href="{{ route('admin.languages.index') }}" class="btn btn-outline">Cancel</a>
</form>
@endsection