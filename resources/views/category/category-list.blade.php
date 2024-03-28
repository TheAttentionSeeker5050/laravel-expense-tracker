@extends('layouts.app')

@section('content')
    <h1 id="app-title">Categories</h1>

    <section id="categories-listing-main-section">
        <a href="{{ route('categories.create') }}" id="add-button">Add Category</a>

        @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif

        <ul id="categories-list">
            <li class="categories-list-header">
                <span >Title</span>
                <span >Budget</span>
                <span ></span>
            </li>
            {{-- for each of the categories, display them in list elements --}}
            @foreach ($categories as $category)
                <li>
                    <span >{{ $category->title }}</span>
                    <span >{{ $category->budget }}</span>
                    <a href="{{ route('categories.edit', ['expenseCategory' => $category->id]) }}">edit</a>
                </li>
            @endforeach

            <li>
                <span >Category 1</span>
                <span >400</span>
                <a href="{{ route('categories.edit', ['expenseCategory' => 1]) }}">edit</a>
            </li>
            <li>
                <span >Category 2</span>
                <span >600</span>
                <a href="{{ route('categories.edit', ['expenseCategory' => 2]) }}">edit</a>
            </li>
            <li>
                <span >Category 3</span>
                <span >300</span>
                <a href="{{ route('categories.edit', ['expenseCategory' => 1]) }}">edit</a>
            </li>
        </ul>

    </section>
@endsection
