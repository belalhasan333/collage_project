<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::where('seller_id', Auth::id())->get();
        return view('seller.books.index', compact('books'));
    }

    public function create()
    {
        return view('seller.books.create');
    }

    public function store(Request $request)
    {
        Book::create([
            'title' => $request->title,
            'price' => $request->price,
            'seller_id' => Auth::id(),
        ]);

        return redirect()->route('seller.books.index');
    }
}
