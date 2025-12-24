@extends('master')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Edit Book</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.books.edit', $book) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Book Title</label>
                        <input type="text" name="title" value="{{ $book->title }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Author Name</label>
                        <input type="text" name="author" value="{{ $book->author }}" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" name="price" value="{{ $book->price }}" step="0.01" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number" name="stock" value="{{ $book->stock }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" value="{{ $book->category }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="4" class="form-control">{{ $book->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Current Image</label><br>
                        @if($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" width="200" class="rounded mb-2">
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning btn-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
