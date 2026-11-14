@extends('admin.layout')

@section('title', 'Genres')

@section('content')
<h1>Genres</h1>

<form class="form" method="POST" action="{{ route('admin.genres.store') }}" style="margin-bottom: 1.5rem;">
    @csrf
    <div class="field {{ $errors->has('name') ? 'has-error' : '' }}">
        <label>New Genre</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name') <div class="error-text">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn">Add Genre</button>
</form>

<table class="data">
    <thead>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($genres as $genre)
        <tr>
            <td>{{ $genre->name }}</td>
            <td>
                <a href="{{ route('admin.genres.edit', $genre) }}" class="btn btn-outline">Edit</a>
                <form method="POST" action="{{ route('admin.genres.destroy', $genre) }}" style="display: inline;" onsubmit="return confirm('Delete this genre?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="2">No genres yet.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection