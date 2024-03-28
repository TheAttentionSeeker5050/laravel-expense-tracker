@extends('layouts.app')

@section('content')
    <h1 id="app-title">
        Create Category
    </h1>
    <section id="create-category-expense-main-section">

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

        {{-- post to category.store route and pass the request  --}}
        <form
            action="{{ route('categories.store') }}"
            method="post"
            id="create-expense-category-form">

            @csrf

            <a href="{{ route('categories.index') }}" id="add-button">All Categories</a>

            <div class="form-group">
                <label for="title" class="form-label">
                    Title
                </label>
                <input class="budget-input-container form-control" type="text" name="title" id="title"
                value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="budget" class="form-label">
                    Budget
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-secondary text-light" id="basic-addon1">$</span>
                    <input type="number" name="budget" id="budget" class="form-control"
                    value="{{ old('budget') }}" required>
                </div>

            </div>

            <button type="submit">Create</button>
        </form>

    </section>
@endsection
