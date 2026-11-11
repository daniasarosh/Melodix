@extends('admin.layout')

@section('title', 'Artists')

@section('content')
<div class="section-head">
    <h1>Artists</h1>
    <a href="{{ route('admin.artists.create') }}" class="btn">Add Artist</a>
</div>

<table class="data">
    <thead>
        <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Albums</th>
            <th>Songs</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($artists as $artist)
        <tr>
            <td>
                <img src="{{ $artist->photo_url }}" alt="{{ $artist->name }}" style="width: 48px; height: 48px; object-fit: cover; border-radius: 50%;">
            </td>
            <td>{{ $artist->name }}</td>
            <td>{{ $artist->albums()->count() }}</td>
            <td>{{ $artist->songs()->count() }}</td>
            <td>
                <a href="{{ route('admin.artists.edit', $artist) }}" class="btn btn-outline">Edit</a>
                <form method="POST" action="{{ route('admin.artists.destroy', $artist) }}" style="display: inline;" onsubmit="return confirm('Delete this artist?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No artists yet.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection