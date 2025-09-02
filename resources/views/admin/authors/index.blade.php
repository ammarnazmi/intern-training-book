@extends('layouts.master')

@section('title', __('List of Authors'))

@section('content')
    <div class="col-md-12">
        <div class="row mb-3">
            <div class="col-md-6">
                <a class="btn btn-outline-dark" href="{{ route('authors.create') }}">
                    <span class="fa-solid fa-plus"></span>
                    {{ __('Add Authors') }}
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Biography') }}</th>
                            <th>{{ __('Birth Date') }}</th>
                            <th width="10%">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($authors as $author)
                            <tr>
                                <td>{{ $author->id }}</td>
                                <td>{{ $author->name }}</td>
                                <td>{{ $author->bio }}</td>
                                <td>{{ $author->birth_date ? $author->birth_date->format('Y-m-d') : '' }}</td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary" href="{{ route('authors.edit', $author) }}">
                                        <span class="bi bi-pencil-square"></span>
                                    </a>
                                    <form action="{{ route('authors.destroy', $author) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('{{ __('Are you sure you want to delete this author?') }}')">
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
    </div>
@endsection
