@extends('admin.layout')

@section('title', 'Reviews')

@section('content')
<h1>Reviews</h1>

<table class="data">
    <thead>
        <tr>
            <th>User</th>
            <th>On</th>
            <th>Review</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($reviews as $review)
        <tr>
            <td>{{ $review->user->name ?? '-' }}</td>
            <td>
                @if ($review->song)
                    Song: {{ $review->song->title }}
                @elseif ($review->video)
                    Video: {{ $review->video->title }}
                @else
                    -
                @endif
            </td>
            <td>{{ \Illuminate\Support\Str::limit($review->review_text, 80) }}</td>
            <td>{{ $review->created_at?->format('d M Y') }}</td>
            <td>
                <form method="POST" action="{{ route('admin.reviews.destroy', $review) }}" style="display: inline;" onsubmit="return confirm('Delete this review?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No reviews yet.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection