@extends('master')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Add New Book</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Book Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Author Name</label>
                        <input type="text" name="author" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" name="price" step="0.01" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number" name="stock" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description (Optional)</label>
                        <textarea name="description" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Book Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">Add Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
