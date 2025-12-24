<?php


namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('buyer.index', compact('books'));
    }
    public function add(Book $book)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Check if book already in cart (optional challenge, can add more logic if cart stores duplicates)
        $user->cart()->updateOrCreate(
            ['book_id' => $book->id],
            ['quantity' => \DB::raw('quantity + 1')]
        );

        return redirect()->back()->with('success', 'Book added to cart!');
    }

    public function remove(Book $book)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $cartItem = $user->cart()->where('book_id', $book->id)->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Book removed from cart!');
        }

        return redirect()->back()->with('error', 'Book not found in your cart.');
    }
}

