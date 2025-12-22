@extends('admin.layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">বই এডিট করুন</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <!-- একই ফিল্ড create এর মতো, কিন্তু value দিয়ে -->
                    <div class="mb-3">
                        <label class="form-label">বইয়ের শিরোনাম</label>
                        <input type="text" name="title" value="{{ $book->title }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">লেখকের নাম</label>
                        <input type="text" name="author" value="{{ $book->author }}" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">দাম</label>
                            <input type="number" name="price" value="{{ $book->price }}" step="0.01" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">স্টক</label>
                            <input type="number" name="stock" value="{{ $book->stock }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ক্যাটাগরি</label>
                        <input type="text" name="category" value="{{ $book->category }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">বিবরণ</label>
                        <textarea name="description" rows="4" class="form-control">{{ $book->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">বর্তমান ছবি</label><br>
                        @if($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" width="200" class="rounded mb-2">
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning btn-lg">আপডেট করুন</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
