@extends('layouts.master')

@section('title', __('List of Books'))

@section('content')
    <div class="col-md-12">
        <div class="row mb-3">
            <div class="col-md-6">
                <a class="btn btn-outline-dark" href="{{ route('books.create') }}">
                    <span class="fa-solid fa-plus"></span>
                    {{ __('Add Book') }}
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('ISBN') }}</th>
                            <th>{{ __('Author') }}</th>
                            <th>{{ __('Publisher') }}</th>
                            <th width="10%">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->isbn }}</td>
                                <td>{{ $book->author->name ?? '' }}</td>
                                <td>{{ $book->publisher }}</td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-secondary" href="{{ route('books.show', $book) }}">
                                        <span class="bi bi-eye"></span>
                                    </a>
                                    <a class="btn btn-sm btn-primary" href="{{ route('books.edit', $book) }}">
                                        <span class="bi bi-pencil-square"></span>
                                    </a>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('{{ __('Are you sure you want to delete this book?') }}')">
                                            <span class="bi bi-trash"></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
@endsection
