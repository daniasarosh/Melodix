@extends('admin.layout')

@section('title', 'Countries')

@section('content')
<h1>Countries</h1>

<form class="form" method="POST" action="{{ route('admin.countries.store') }}" style="margin-bottom: 1.5rem;">
    @csrf
    <div class="field {{ $errors->has('name') ? 'has-error' : '' }}">
        <label>New Country</label>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name') <div class="error-text">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn">Add Country</button>
</form>

<table class="data">
    <thead>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($countries as $country)
        <tr>
            <td>{{ $country->name }}</td>
            <td>
                <a href="{{ route('admin.countries.edit', $country) }}" class="btn btn-outline">Edit</a>
                <form method="POST" action="{{ route('admin.countries.destroy', $country) }}" style="display: inline;" onsubmit="return confirm('Delete this country?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="2">No countries yet.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection