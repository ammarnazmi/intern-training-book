<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController
{
    /**
     * Display a listing of the authors.
     */
    public function index(Request $request)
    {
        $query = Author::query();

        $columns = ['id', 'name', 'bio', 'birth_date'];

        $authors = $query->select($columns)->get();

        return $request->wantsJson()
            ? $authors
            : view('admin.authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new author.
     */
    public function create()
    {
        return $this->edit(new Author());
    }

    /**
     * Store a newly created author in storage.
     */
    public function store(AuthorRequest $request)
    {
        $data = $request->validated();

        $author = Author::create($data);

        return redirect()
            ->route('authors.index', $author)
            ->with('success', __('Author :name created successfully.', ['name' => $author->name]));
    }

    /**
     * Show the form for editing the specified author.
     */
    public function edit(Author $author)
    {
        return view('admin.authors.form', compact('author'));
    }

    /**
     * Update the specified author in storage.
     */
    public function update(AuthorRequest $request, Author $author)
    {
        $data = $request->validated();

        $author->update($data);

        return redirect()
            ->route('authors.index', $author)
            ->with('success', __('Author :name updated successfully.', ['name' => $author->name]));
    }

    /**
     * Remove the specified author from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()
            ->route('authors.index')
            ->with('success', __('Author :name deleted successfully.', ['name' => $author->name]));
    }
}
