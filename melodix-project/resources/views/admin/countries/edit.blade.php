@extends('admin.layout')

@section('title', 'Edit Country')

@section('content')
<h1>Edit Country</h1>

<form class="form" method="POST" action="{{ route('admin.countries.update', $country) }}">
    @csrf
    @method('PUT')

    <div class="field {{ $errors->has('name') ? 'has-error' : '' }}">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $country->name) }}">
        @error('name') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn">Update</button>
    <a href="{{ route('admin.countries.index') }}" class="btn btn-outline">Cancel</a>
</form>
@endsection