@extends('layouts.master')

@section('title',
    match (true) {
    request()->is('*/create') => __('Add Author'),
    request()->is('*/edit') => __('Update Author'),
    })

@section('content')
    <div class="col-md-6">
        <form method="POST"
            action="{{ request()->is('*/create') ? route('authors.store') : route('authors.update', $author) }}">
            @csrf
            @if (request()->is('*/edit'))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $author->name ?? '') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bio" class="form-label">{{ __('Biography') }}</label>
                <textarea class="form-control @error('bio') is-invalid @enderror" name="bio" rows="4">{{ old('bio', $author->bio ?? '') }}</textarea>
                @error('bio')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="birth_date" class="form-label">{{ __('Birth Date') }}</label>
                <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date"
                    name="birth_date"
                    value="{{ old('birth_date', isset($author->birth_date) ? $author->birth_date->format('Y-m-d') : '') }}">
                @error('birth_date')
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
