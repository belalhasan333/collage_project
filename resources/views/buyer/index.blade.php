@extends('master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($books as $book)
                                    <tr>
                                        <td>
                                            @if (!empty($book->image))
                                                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}"
                                                    width="60" class="rounded" style="height:80px;object-fit:cover;">
                                            @else
                                                <div class="bg-secondary rounded" style="width:60px;height:80px;"></div>
                                            @endif
                                        </td>
                                        <td><strong>{{ $book->title }}</strong></td>
                                        <td>{{ $book->author }}</td>
                                        <td>৳{{ number_format((float) $book->price, 2) }}</td>
                                        <td>
                                            <span class="badge {{ $book->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $book->stock > 0 ? $book->stock : 'Out of stock' }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('cart.index', $book->id) }}"
                                                class="btn btn-sm btn-info">View</a>
                                            @if ($book->stock > 0)
                                                <form action="{{ route('cart.add', $book->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">Add to
                                                        Cart</button>
                                                </form>
                                            @else
                                                <button class="btn btn-sm btn-secondary" disabled>Out of Stock</button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">No books found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
