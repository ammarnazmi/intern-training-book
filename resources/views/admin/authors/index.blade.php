@extends('layouts.master')

@section('title', __('List of Authors'))

@section('content')
    <div class="col-md-12" x-data="authorList()">
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
                        <template x-for="author in authors" :key="author.id">
                            <tr>
                                <td x-text="author.id"></td>
                                <td x-text="author.name"></td>
                                <td x-text="author.bio"></td>
                                <td x-text="author.birth_date ? author.birth_date.substring(0,10) : ''"></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary" :href="`/authors/${author.id}/edit`">
                                        <span class="bi bi-pencil-square"></span>
                                    </a>
                                    <form :action="`/authors/${author.id}`" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('{{ __('Are you sure you want to delete this author?') }}')">
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

        <div>{{ $authors->links('pagination::bootstrap-5-limited') }}</div>
    </div>
@endsection

@push('js')
    <script>
        function authorList() {
            return {
                authors: @json($authors->items()),
            }
        }
    </script>
@endpush
