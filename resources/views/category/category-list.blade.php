@extends('layouts.app')

@section('content')
    <h1 id="app-title">Categories</h1>

    <section id="categories-listing-main-section">
        <a href="{{ route('categories.create') }}" id="add-button">Add Category</a>

        <ul id="categories-list">
            <li>
                <a href="#">Category 1</a>
                <a href="#">Delete</a>
            </li>
            <li>
                <a href="#">Category 2</a>
                <a href="#">Delete</a>
            </li>
            <li>
                <a href="#">Category 3</a>
                <a href="#">Delete</a>
            </li>
        </ul>

    </section>
@endsection
