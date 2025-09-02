@extends('layouts.master')

@section('title', __('View Book'))

@section('content')
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>{{ __('Title') }}</th>
                        <td>{{ $book->title }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('ISBN') }}</th>
                        <td>{{ $book->isbn }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Author') }}</th>
                        <td>
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Biography') }}</th>
                                        <th>{{ __('Birth Date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $book->author->name }}</td>
                                        <td>{{ $book->author->bio }}</td>
                                        <td>{{ $book->author->birth_date ? $book->author->birth_date->format('Y-m-d') : '' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Publisher') }}</th>
                        <td>{{ $book->publisher }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('Publication Date') }}</th>
                        <td>{{ $book->published_year ? $book->published_year->format('Y-m-d') : '' }}</td>
                </tbody>
            </table>
        </div>
        <a class="btn btn-secondary" href="{{ route('books.index') }}">{{ __('Back to List') }}</a>
    </div>
@endsection
