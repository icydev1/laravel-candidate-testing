

@extends('layouts.app')

@section('title', 'Author')

@section('content')
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Actions</th>
    </tr>
    
    @foreach ($authors['items'] as $author)
        <tr>
            <td>{{ $author['id'] }}</td>
            <td>{{ $author['first_name'] .' '.$author['last_name'] }}</td>
            <td>
                <a href="{{ route('authors.show', $author['id']) }}">View</a>
                <form method="POST" action="{{ route('authors.destroy', $author['id']) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
@endsection
