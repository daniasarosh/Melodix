@extends('admin.layout')

@section('title', 'Users')

@section('content')
<h1>Users</h1>

<table class="data">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
        <tr>
            <td>{{ $user->username }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>
                @if ($user->is_active)
                    <span style="color: var(--success);">Active</span>
                @else
                    <span style="color: var(--error);">Blocked</span>
                @endif
            </td>
            <td>
                <form method="POST" action="{{ route('admin.users.toggle', $user) }}" style="display: inline;">
                    @csrf
                    @if ($user->is_active)
                        <button type="submit" class="btn btn-danger">Block</button>
                    @else
                        <button type="submit" class="btn btn-outline">Unblock</button>
                    @endif
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">No users yet.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection