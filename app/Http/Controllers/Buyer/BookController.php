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
}

