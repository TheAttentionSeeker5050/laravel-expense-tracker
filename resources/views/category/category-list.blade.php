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

        <ul id="categories-list">
            <li class="categories-list-header w-100">
                <span >Title</span>
                <span >Budget</span>
                <span ></span>
            </li>
            {{-- for each of the categories, display them in list elements --}}
            @if ($categories->isEmpty())
                <li class="w-100">
                    <span >No categories found</span>
                </li>
            @endif
            @foreach ($categories as $category)
                <li class="w-100">
                    <span >{{ $category->title }}</span>
                    <span >{{ $category->budget }}</span>
                    <a href="{{ route('categories.edit', ['expenseCategory' => $category]) }}">
                        edit
                    </a>
                </li>
            @endforeach

        </ul>

    </section>
@endsection
