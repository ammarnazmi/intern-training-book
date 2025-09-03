@extends('layouts.master')

@section('title', __('List of Books'))

@section('content')
    <div class="col-md-12" x-data="listPage()">
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
                        <template x-for="book in books" :key="book.id">
                            <tr>
                                <td x-text="book.id"></td>
                                <td x-text="book.title"></td>
                                <td x-text="book.isbn"></td>
                                <td x-text="book.author?.name ?? ''"></td>
                                <td x-text="book.publisher"></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-secondary" :href="`/books/${book.id}`">
                                        <span class="bi bi-eye"></span>
                                    </a>
                                    <a class="btn btn-sm btn-primary" :href="`/books/${book.id}/edit`">
                                        <span class="bi bi-pencil-square"></span>
                                    </a>
                                    <form :action="`/books/${book.id}`" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('{{ __('Are you sure you want to delete this book?') }}')">
                                            <span class="bi bi-trash"></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function listPage() {
            return {
                books: @json($books),
            }
        }
    </script>
@endpush
