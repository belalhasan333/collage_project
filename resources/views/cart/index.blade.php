@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">আমার কার্ট</h4>
                        <a href="{{ route('books.index') }}" class="btn btn-light btn-sm">
                            <i class="mdi mdi-arrow-left"></i> আরও বই দেখুন
                        </a>
                    </div>

                    <div class="card-body">
                        @php
                            // Controller may supply $cartItems and $subtotal, if not protect
                            $cartItems = isset($cartItems) ? $cartItems : (isset($items) ? $items : collect([]));
                            $subtotal = isset($subtotal) ? $subtotal : $cartItems->sum(function($i){
                                return ($i->book->price ?? 0) * ($i->quantity ?? 1);
                            });
                        @endphp
                        @if($cartItems->isEmpty())
                            <!-- খালি কার্ট -->
                            <div class="text-center py-5">
                                <i class="mdi mdi-cart-outline mdi-48px text-muted mb-3"></i>
                                <h5 class="text-muted">আপনার কার্ট খালি আছে!</h5>
                                <p class="text-muted">আপনার পছন্দের বইগুলো এখানে যোগ করুন</p>
                                <a href="{{ route('cart.add') }}" class="btn btn-primary btn-lg mt-3">
                                    বই দেখতে শুরু করুন
                                </a>
                            </div>
                        @else
                            <!-- কার্টে আইটেম থাকলে -->
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width: 40%">বইয়ের বিবরণ</th>
                                            <th style="width: 15%">দাম</th>
                                            <th style="width: 15%">পরিমাণ</th>
                                            <th style="width: 20%">সাবটোটাল</th>
                                            <th style="width: 10%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cartItems as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $item->book->cover_image ?? asset('images/book-placeholder.jpg') }}"
                                                             alt="{{ $item->book->title ?? 'No Title' }}"
                                                             class="me-3 rounded"
                                                             style="width: 60px; height: 90px; object-fit: cover;">
                                                        <div>
                                                            <h6 class="mb-1">{{ $item->book->title ?? 'শিরোনাম নেই' }}</h6>
                                                            <small class="text-muted">লেখক: {{ $item->book->author ?? 'অজানা' }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <strong>{{ number_format($item->book->price ?? 0) }} ৳</strong>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <button class="btn btn-sm btn-outline-secondary qty-decrease"
                                                                data-id="{{ $item->id }}">-</button>
                                                        <input type="number" class="form-control mx-2 text-center qty-input"
                                                               value="{{ $item->quantity ?? 1 }}" min="1"
                                                               style="width: 70px;" readonly>
                                                        <button class="btn btn-sm btn-outline-secondary qty-increase"
                                                                data-id="{{ $item->id }}">+</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <strong class="subtotal" data-price="{{ $item->book->price ?? 0 }}">
                                                        {{ number_format(($item->book->price ?? 0) * ($item->quantity ?? 1)) }} ৳
                                                    </strong>
                                                </td>
                                                <td>
                                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('আপনি কি এই আইটেমটি মুছতে চান?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- সামারি সেকশন -->
                            <div class="row justify-content-end mt-4">
                                <div class="col-lg-5 col-md-7">
                                    <div class="card bg-light border-0 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title">কার্ট সামারি</h5>
                                            <hr>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>সাবটোটাল:</span>
                                                <strong id="cart-subtotal">{{ number_format($subtotal) }} ৳</strong>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span>ডেলিভারি চার্জ:</span>
                                                <span class="text-success">৳০ (ফ্রি)</span>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between mb-3">
                                                <h5>মোট:</h5>
                                                <h5 id="cart-total" class="text-primary">{{ number_format($subtotal) }} ৳</h5>
                                            </div>

                                            <a href="{{ route('checkout') }}" class="btn btn-primary btn-block btn-lg w-100">
                                                চেকআউট করুন <i class="mdi mdi-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.qty-increase, .qty-decrease').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.qty-input');
            const itemId = this.dataset.id;
            let qty = parseInt(input.value);

            if (this.classList.contains('qty-increase')) qty++;
            if (this.classList.contains('qty-decrease') && qty > 1) qty--;

            input.value = qty;

            // সাবটোটাল আপডেট (ফ্রন্টএন্ডে)
            const price = parseFloat(this.closest('tr').querySelector('.subtotal').dataset.price);
            this.closest('tr').querySelector('.subtotal').textContent = (price * qty).toLocaleString() + ' ৳';

            updateGrandTotal();

            // কার্টে কোয়ান্টিটি পরিবর্তনের সময় AJAX বোঝাতে নিচের অংশ যুক্ত করুন (সার্ভারেও আপডেট করতে চাইলে):
            /*
            fetch('{{ url('cart/update') }}/' + itemId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantity: qty })
            })
            .then(res => res.json())
            .then(data => {
                // optionally handle server response
            });
            */
        });
    });

    function updateGrandTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(el => {
            total += parseFloat(el.textContent.replace(/[^\d]/g, '')) || 0;
        });
        document.getElementById('cart-total').textContent = total.toLocaleString() + ' ৳';
        document.getElementById('cart-subtotal').textContent = total.toLocaleString() + ' ৳';
    }
</script>
@endpush
