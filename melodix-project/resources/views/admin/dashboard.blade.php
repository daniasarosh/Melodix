@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<h1>Dashboard</h1>
<p>Welcome, {{ auth()->user()->name }}</p>

<div class="grid" style="margin-bottom: 2rem;">
    @foreach ($counts as $label => $count)
        <div class="card">
            <div class="sub">{{ $label }}</div>
            <div class="title" style="font-size: 1.6rem;">{{ $count }}</div>
        </div>
    @endforeach
</div>

<div class="section">
    <div class="section-head">
        <h2>Latest Songs</h2>
        <a href="{{ route('admin.songs.index') }}">View all</a>
    </div>

    <table class="data">
        <thead>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Added</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($latestSongs as $song)
            <tr>
                <td>{{ $song->title }}</td>
                <td>{{ $song->artist->name ?? '-' }}</td>
                <td>{{ $song->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3">No songs yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection