<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->paginate(10);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::all();
        return view('books.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'author_id' => 'required|exists:authors,id',
            'published_year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'description' => 'nullable|string',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        $book->load('author');
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('books.edit', compact('book', 'authors'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'author_id' => 'required|exists:authors,id',
            'published_year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'description' => 'nullable|string',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}