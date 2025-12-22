<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::where('user_id', Auth::id())->get();
        return view('cart.index', compact('items'));
    }

    public function add(Book $book)
    {
        Cart::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
        ]);

        return redirect()->back();
    }
}
