@extends('admin.layout')

@section('title', 'Languages')

@section('content')
<h1>Languages</h1>

<form class="form" method="POST" action="{{ route('admin.languages.store') }}" style="margin-bottom: 1.5rem;">
    @csrf
    <div class="field {{ $errors->has('name') ? 'has-error' : '' }}">
        <label>New Language</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name') <div class="error-text">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn">Add Language</button>
</form>

<table class="data">
    <thead>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($languages as $language)
        <tr>
            <td>{{ $language->name }}</td>
            <td>
                <a href="{{ route('admin.languages.edit', $language) }}" class="btn btn-outline">Edit</a>
                <form method="POST" action="{{ route('admin.languages.destroy', $language) }}" style="display: inline;" onsubmit="return confirm('Delete this language?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="2">No languages yet.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection