
@extends('layouts.app')

@section('title', 'Books')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Add New Book</h2>
    <form method="POST" action="{{ route('books.store') }}">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter book title" required>
        </div>

        
        <div class="mb-3">
            <label for="author_id" class="form-label">Author:</label>
            <select class="form-select" id="author_id" name="author_id" required>
                <option value="" disabled selected>Select an author</option>
                @foreach ($authors['items'] as $author)
                    <option value="{{ $author['id'] }}">{{ $author['first_name'] . ' ' . $author['last_name'] }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add Book</button>
    </form>
</div>
@endsection



