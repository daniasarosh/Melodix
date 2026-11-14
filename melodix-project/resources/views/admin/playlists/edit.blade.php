@extends('admin.layout')

@section('title', 'Edit Playlist')

@section('content')
<h1>Edit Playlist</h1>

<form class="form" method="POST" action="{{ route('admin.playlists.update', $playlist) }}" enctype="multipart/form-data" style="margin-bottom: 2rem;">
    @csrf
    @method('PUT')

    <div class="field {{ $errors->has('name') ? 'has-error' : '' }}">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $playlist->name) }}">
        @error('name') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('description') ? 'has-error' : '' }}">
        <label>Description (optional)</label>
        <input type="text" name="description" value="{{ old('description', $playlist->description) }}">
        @error('description') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <div class="field {{ $errors->has('cover_image') ? 'has-error' : '' }}">
        <label>Cover Image</label>
        <img src="{{ $playlist->cover_url }}" alt="{{ $playlist->name }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; margin-bottom: .5rem;">
        <input type="file" name="cover_image">
        <p class="muted" style="margin-top: .3rem; font-size: .8rem;">Leave empty to keep the current cover.</p>
        @error('cover_image') <div class="error-text">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn">Update</button>
    <a href="{{ route('admin.playlists.index') }}" class="btn btn-outline">Cancel</a>
</form>

<div class="section">
    <h2>Songs in this playlist</h2>

    <form method="POST" action="{{ route('admin.playlists.items.add', $playlist) }}" style="display: flex; gap: .5rem; margin-bottom: 1rem;">
        @csrf
        <div class="field" style="margin: 0; flex: 1; max-width: 360px;">
            <select name="song_id">
                <option value="">Choose a song</option>
                @foreach ($otherSongs as $song)
                    <option value="{{ $song->id }}">{{ $song->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn">Add Song</button>
    </form>

    <table class="data">
        <thead>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($songs as $song)
            <tr>
                <td>{{ $song->title }}</td>
                <td>{{ $song->artist->name ?? '-' }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.playlists.items.remove', $playlist) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="song_id" value="{{ $song->id }}">
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3">No songs yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="section" style="margin-top: 2rem;">
    <h2>Videos in this playlist</h2>

    <form method="POST" action="{{ route('admin.playlists.items.add', $playlist) }}" style="display: flex; gap: .5rem; margin-bottom: 1rem;">
        @csrf
        <div class="field" style="margin: 0; flex: 1; max-width: 360px;">
            <select name="video_id">
                <option value="">Choose a video</option>
                @foreach ($otherVideos as $video)
                    <option value="{{ $video->id }}">{{ $video->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn">Add Video</button>
    </form>

    <table class="data">
        <thead>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($videos as $video)
            <tr>
                <td>{{ $video->title }}</td>
                <td>{{ $video->artist->name ?? '-' }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.playlists.items.remove', $playlist) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="video_id" value="{{ $video->id }}">
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3">No videos yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection