@extends('admin.layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">নতুন বই যোগ করুন</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">বইয়ের শিরোনাম</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">লেখকের নাম</label>
                        <input type="text" name="author" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">দাম (টাকায়)</label>
                            <input type="number" name="price" step="0.01" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">স্টকে আছে</label>
                            <input type="number" name="stock" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ক্যাটাগরি</label>
                        <input type="text" name="category" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">বিবরণ (অপশনাল)</label>
                        <textarea name="description" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">বইয়ের ছবি</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">বই যোগ করুন</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
