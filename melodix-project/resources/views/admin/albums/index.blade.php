@extends('admin.layout')

@section('title', 'Albums')

@section('content')
<div class="section-head">
    <h1>Albums</h1>
    <a href="{{ route('admin.albums.create') }}" class="btn">Add Album</a>
</div>

<table class="data">
    <thead>
        <tr>
            <th>Cover</th>
            <th>Title</th>
            <th>Artist</th>
            <th>Year</th>
            <th>Songs</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($albums as $album)
        <tr>
            <td>
                <img src="{{ $album->cover_url }}" alt="{{ $album->title }}" style="width: 48px; height: 48px; object-fit: cover; border-radius: 8px;">
            </td>
            <td>{{ $album->title }}</td>
            <td>{{ $album->artist->name ?? '-' }}</td>
            <td>{{ $album->release_year ?? '-' }}</td>
            <td>{{ $album->songs()->count() }}</td>
            <td>
                <a href="{{ route('admin.albums.edit', $album) }}" class="btn btn-outline">Edit</a>
                <form method="POST" action="{{ route('admin.albums.destroy', $album) }}" style="display: inline;" onsubmit="return confirm('Delete this album?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">No albums yet.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection