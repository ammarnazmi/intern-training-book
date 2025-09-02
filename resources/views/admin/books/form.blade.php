@extends('layouts.master')

@section('title',
    match (true) {
    request()->is('*/create') => __('Add Book'),
    request()->is('*/edit') => __('Update Book'),
    })

@section('content')
    <div class="col-md-6">
        <form method="POST"
            action="{{ request()->is('*/create') ? route('books.store') : route('books.update', $book) }}">
            @csrf
            @if (request()->is('*/edit'))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="title" class="form-label">{{ __('Title') }}</label>

                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                    value="{{ old('title', $book->title ?? '') }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isbn" class="form-label">{{ __('isbn') }}</label>

                <input type="text" class="form-control @error('isbn') is-invalid @enderror" name="isbn"
                    value="{{ old('isbn', $book->isbn ?? '') }}">
                @error('isbn')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="author_id" class="form-label">{{ __('Author') }}</label>

                <select class="form-select @error('author_id') is-invalid @enderror" id="author_id" name="author_id">
                    <option value="">{{ __('Select Author') }}</option>

                    @foreach ($authorOptions as $id => $name)
                        <option value="{{ $id }}"
                            {{ old('author_id', $book->author_id ?? '') == $id ? 'selected' : '' }}>
                            {{ $name }}</option>
                    @endforeach
                </select>

                @error('author_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="publisher" class="form-label">{{ __('Publisher') }}</label>

                <input type="text" class="form-control @error('publisher') is-invalid @enderror" name="publisher"
                    value="{{ old('publisher', $book->publisher ?? '') }}">

                @error('publisher')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="published_year" class="form-label">{{ __('Publication Date') }}</label>

                <input type="date" class="form-control @error('published_year') is-invalid @enderror"
                    id="published_year" name="published_year"
                    value="{{ old('published_year', isset($book->published_year) ? $book->published_year->format('Y-m-d') : '') }}">

                    @error('published_year')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                {{ request()->is('*/create') ? __('Create') : __('Update') }}
            </button>
        </form>
    </div>
@endsection
