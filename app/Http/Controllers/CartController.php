<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $items = Cart::with('book')->where('user_id', Auth::id())->get();

        return view('cart.index', [
            'items' => $items,
        ]);
    }

    public function add(Book $book)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Check if the book is already in user's cart and increase quantity if so, else create new record
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->first();

        if ($cartItem) {
            // Assuming there is a 'quantity' column in the carts table. If not, remove this line.
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'quantity' => 1, // Assumes 'quantity' column exists. If not, remove.
            ]);
        }

        return redirect()->back()->with('success', 'Book added to cart!');
    }

    public function remove(Book $book)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->first();

        if ($cartItem) {
            // If you want to decrease quantity instead of deleting, adjust this accordingly
            // Assuming there is a 'quantity' column
            if (isset($cartItem->quantity) && $cartItem->quantity > 1) {
                $cartItem->quantity -= 1;
                $cartItem->save();
            } else {
                $cartItem->delete();
            }
            return redirect()->back()->with('success', 'Book removed from cart!');
        }

        return redirect()->back()->with('error', 'Book not found in cart.');
    }
}
