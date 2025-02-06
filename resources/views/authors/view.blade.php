
@extends('layouts.app')

@section('title', 'Author')

@section('content')
<h1>{{ $author['first_name'] .' '.$author['last_name'] }}</h1>
<h2>Books:</h2>
<ul>
    @forelse ($author['books'] as $book)
    <li>{{ $book['title'] }}
        <form method="POST" action="{{ route('books.destroy', $book['id']) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </li>
@empty
    <p>This author has no books.</p>
@endforelse

</ul>
@endsection


