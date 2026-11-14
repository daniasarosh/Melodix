@extends('admin.layout')

@section('title', 'Playlists')

@section('content')
<div class="section-head">
    <h1>Playlists</h1>
    <a href="{{ route('admin.playlists.create') }}" class="btn">Add Playlist</a>
</div>

<table class="data">
    <thead>
        <tr>
            <th>Cover</th>
            <th>Name</th>
            <th>Items</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($playlists as $playlist)
        <tr>
            <td>
                <img src="{{ $playlist->cover_url }}" alt="{{ $playlist->name }}" style="width: 48px; height: 48px; object-fit: cover; border-radius: 8px;">
            </td>
            <td>{{ $playlist->name }}</td>
            <td>{{ $playlist->items()->count() }}</td>
            <td>
                <a href="{{ route('admin.playlists.edit', $playlist) }}" class="btn btn-outline">Edit</a>
                <form method="POST" action="{{ route('admin.playlists.destroy', $playlist) }}" style="display: inline;" onsubmit="return confirm('Delete this playlist?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">No playlists yet.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection