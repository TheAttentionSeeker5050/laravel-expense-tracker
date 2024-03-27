@extends('layouts.app')

@section('content')
    <h1>Categories</h1>

    <section id="categories-listing-main-section">
        <a href="#" >Add Category</a>

        <ul id="categories-list">
            <li>
                <a href="#">Category 1</a>
                <a href="#">Edit</a>
                <a href="#">Delete</a>
            </li>
            <li>
                <a href="#">Category 2</a>
                <a href="#">Edit</a>
                <a href="#">Delete</a>
            </li>
            <li>
                <a href="#">Category 3</a>
                <a href="#">Edit</a>
                <a href="#">Delete</a>
            </li>
        </ul>

    </section>
@endsection
