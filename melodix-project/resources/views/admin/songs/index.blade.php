@extends('admin.layout')

@section('title', 'Songs')

@section('content')
<div class="section-head">
    <h1>Songs</h1>
    <a href="{{ route('admin.songs.create') }}" class="btn">Add Song</a>
</div>

<table class="data">
    <thead>
        <tr>
            <th>Cover</th>
            <th>Title</th>
            <th>Artist</th>
            <th>Album</th>
            <th>Genre</th>
            <th>Year</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($songs as $song)
        <tr>
            <td>
                <img src="{{ $song->cover_url }}" alt="{{ $song->title }}" style="width: 48px; height: 48px; object-fit: cover; border-radius: 8px;">
            </td>
            <td>{{ $song->title }}</td>
            <td>{{ $song->artist->name ?? '-' }}</td>
            <td>{{ $song->album->title ?? '-' }}</td>
            <td>{{ $song->genre->name ?? '-' }}</td>
            <td>{{ $song->release_year }}</td>
            <td>
                <a href="{{ route('admin.songs.edit', $song) }}" class="btn btn-outline">Edit</a>
                <form method="POST" action="{{ route('admin.songs.destroy', $song) }}" style="display: inline;" onsubmit="return confirm('Delete this song?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7">No songs yet.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection