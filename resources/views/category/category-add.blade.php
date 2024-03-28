@extends('layouts.app')

@section('content')
    <h1 id="app-title">
        Create Category
    </h1>
    <section id="create-category-expense-main-section">

        {{-- post to category.store route and pass the request  --}}
        <form action="{{ route('categories.store') }}"
            method="post"
            id="create-expense-category-form">

            <a href="{{ route('categories.index') }}" id="add-button">All Categories</a>

            <div class="form-group">
                <label for="title" class="form-label">
                    Title
                </label>
                <input class="budget-input-container form-control" type="text" name="title" id="title" >
            </div>

            <div class="form-group">
                <label for="budget" class="form-label">
                    Budget
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-secondary text-light" id="basic-addon1">$</span>
                    <input type="number" name="budget" id="budget" class="form-control">
                </div>

            </div>

            <button type="submit">Create</button>
        </form>

    </section>
@endsection
