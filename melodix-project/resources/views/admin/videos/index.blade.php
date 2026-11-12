@extends('admin.layout')

@section('title', 'Videos')

@section('content')
<div class="section-head">
    <h1>Videos</h1>
    <a href="{{ route('admin.videos.create') }}" class="btn">Add Video</a>
</div>

<table class="data">
    <thead>
        <tr>
            <th>Thumbnail</th>
            <th>Title</th>
            <th>Type</th>
            <th>Artist</th>
            <th>Year</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($videos as $video)
        <tr>
            <td>
                <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" style="width: 80px; height: 45px; object-fit: cover; border-radius: 8px;">
            </td>
            <td>{{ $video->title }}</td>
            <td>{{ ucwords(str_replace('_', ' ', $video->video_type)) }}</td>
            <td>{{ $video->artist->name ?? '-' }}</td>
            <td>{{ $video->release_year }}</td>
            <td>
                <a href="{{ route('admin.videos.edit', $video) }}" class="btn btn-outline">Edit</a>
                <form method="POST" action="{{ route('admin.videos.destroy', $video) }}" style="display: inline;" onsubmit="return confirm('Delete this video?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">No videos yet.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection