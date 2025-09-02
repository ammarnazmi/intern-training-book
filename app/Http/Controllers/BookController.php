<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController
{
    /**
     * Display a listing of the book.
     */
    public function index(Request $request)
    {
        $query = Book::query();

        $columns = ['id', 'title', 'isbn', 'author_id', 'publisher', 'published_year'];

        $books = $query->select($columns)->get();

        return $request->wantsJson()
            ? $books
            : view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new book.
     */
    public function create()
    {
        return $this->edit(new Book());
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(BookRequest $request)
    {
        $data = $request->validated();

        $book = Book::create($data);

        return redirect()
            ->route('books.index', $book)
            ->with('success', __('Book :name created successfully.', ['name' => $book->title]));
    }

    /**
     * Display the specified book.
     */
    public function show(Book $book)
    {
        return view('admin.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified book.
     */
    public function edit(Book $book)
    {
        $authorOptions = Author::pluck('name', 'id');

        return view('admin.books.form', compact('book', 'authorOptions'));
    }

    /**
     * Update the specified book in storage.
     */
    public function update(BookRequest $request, Book $book)
    {
        $data = $request->validated();

        $book->update($data);

        return redirect()
            ->route('books.index', $book)
            ->with('success', __('Book :name updated successfully.', ['name' => $book->title]));
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', __('Book :name deleted successfully.', ['name' => $book->title]));
    }
}
