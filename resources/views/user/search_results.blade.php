@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Search Results for "{{ $query }}"</h1>

    @if ($books->isEmpty())
        <p>No books found matching your query.</p>
    @else
        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img src="{{ asset('storage/' . $book->cover_image_path) }}" class="card-img-top" alt="{{ $book->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">{{ $book->author }}</p>
                            <a href="{{ route('user.show', $book->id) }}" class="btn btn-primary">View Book</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection