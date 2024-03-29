@extends('layouts.app')

@section('content')
    <h1 id="app-title">Categories</h1>

    <section id="categories-listing-main-section">
        <a href="{{ route('categories.create') }}" id="add-button">Add Category</a>

        @if (Session::has('success'))
            <div class="alert alert-success w-100 text-center" id="success-message">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger w-100 text-center" id="error-message">
                {{ Session::get('error') }}
            </div>
        @endif

        <table id="categories-list">
            {{-- table header --}}
            <thead >
                <tr class="categories-list-header" >
                    <th scope="col">Title</th>
                    <th scope="col">Budget</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody>
                {{-- display categories list empty message --}}
                @if ($categories->isEmpty())
                <tr >
                    <td>No categories found</td>
                    <td></td>
                    <td></td>
                </tr>
                @endif

                {{-- for each of the categories, display them in list elements --}}
                @foreach ($categories as $category)
                    <tr class="w-100">
                        <td >{{ $category->title }}</td>
                        <td >{{ $category->budget }}</td>
                        <td>
                            <a href="{{ route('categories.edit', ['expenseCategory' => $category]) }}">
                                edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </section>
@endsection
