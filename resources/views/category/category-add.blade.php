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
            action="{{ isset($currentMethod) && $currentMethod === 'PUT' ? route('categories.update', ['expenseCategory' => $category]) : route('categories.store') }}"
            method="post"
            id="create-expense-category-form">

            @csrf
            @if (isset($currentMethod) && $currentMethod === 'PUT' && isset($category))
                <input type="hidden" name="id" value="{{ $category->id }}">
                @method('PUT')
            @endif

            <a href="{{ route('categories.index') }}" id="add-button">All Categories</a>

            <div class="form-group">
                <label for="title" class="form-label">
                    Title
                </label>
                <input class="budget-input-container form-control"
                    type="text" name="title" id="title"
                    value="{{ $category->title ?? old('title') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="budget" class="form-label">
                    Budget
                </label>
                <div class="input-group">
                    <span class="input-group-text bg-secondary text-light" id="basic-addon1">$</span>
                    <input
                        type="number" name="budget" id="budget" class="form-control"
                        value="{{ $category->budget ?? old('budget') }}"
                        required>
                </div>

            </div>
            @if (isset($currentMethod) && $currentMethod === 'PUT')
                <button type="submit">Update</button>
            @else
                <button type="submit">Create</button>
            @endif
        </form>

    </section>
@endsection
