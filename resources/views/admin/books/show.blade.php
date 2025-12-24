@extends('master')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">Book Details</h4>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    @if($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" class="img-fluid rounded" style="max-height:400px;">
                    @else
                        <div class="bg-secondary rounded" style="height:400px;width:100%;"></div>
                    @endif
                </div>
                <h3 class="text-primary">{{ $book->title }}</h3>
                <p><strong>Author:</strong> {{ $book->author }}</p>
                <p><strong>Price:</strong> ৳{{ number_format($book->price) }}</p>
                <p><strong>Category:</strong> {{ $book->category }}</p>
                <p><strong>Stock:</strong>
                    <span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }}">{{ $book->stock }}</span>
                </p>
                <p><strong>Description:</strong><br>{{ $book->description ?? 'No description available' }}</p>

                <div class="mt-4">
                    <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
