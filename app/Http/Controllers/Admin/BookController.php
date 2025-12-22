<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    /**
     * Display a listing of all books (Admin view)
     */
    public function index()
    {
        $books = Book::latest()->paginate(10); 
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new book
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Store a newly created book in storage
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category'    => 'required|string|max:100',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
            $data['image'] = $imagePath;
        }

        Book::create($data);

        return redirect()->route('admin.books.index')
                         ->with('success', 'বই সফলভাবে যোগ করা হয়েছে!');
    }

    /**
     * Display the specified book details
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified book
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        return view('admin.books.edit', compact('book'));
    }

    /**
     * Update the specified book in storage
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category'    => 'required|string|max:100',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {

            if ($book->image && file_exists(public_path('storage/' . $book->image))) {
                unlink(public_path('storage/' . $book->image));
            }

            $imagePath = $request->file('image')->store('books', 'public');
            $data['image'] = $imagePath;
        }

        $book->update($data);

        return redirect()->route('admin.books.index')
                         ->with('success', 'বই সফলভাবে আপডেট করা হয়েছে!');
    }

    /**
     * Remove the specified book from storage
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);


        if ($book->image && file_exists(public_path('storage/' . $book->image))) {
            unlink(public_path('storage/' . $book->image));
        }

        $book->delete();

        return redirect()->route('admin.books.index')
                         ->with('success', 'বই সফলভাবে ডিলিট করা হয়েছে!');
    }
}
