@extends('layouts.app')

@section('content')
    <h1 id="app-title">Categories</h1>

    <section id="categories-listing-main-section">
        <a href="{{ route('categories.create') }}" id="add-button">Add Category</a>

        <ul id="categories-list">
            <li class="categories-list-header">
                <span >Title</span>
                <span >Budget</span>
                <span ></span>
            </li>
            <li>
                <span >Category 1</span>
                <span >400</span>
                <a href="#">edit</a>
            </li>
            <li>
                <span >Category 2</span>
                <span >600</span>
                <a href="#">edit</a>
            </li>
            <li>
                <span >Category 3</span>
                <span >300</span>
                <a href="#">edit</a>
            </li>
        </ul>

    </section>
@endsection
