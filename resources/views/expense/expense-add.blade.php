@extends('layouts.app')

@section('content')
    <h1 id="app-title">
        Create Expense
    </h1>
    <section id="create-category-expense-main-section">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif

        <form action="{{ route('expenses.store') }}"
            method="POST" id="create-expense-category-form">
            @csrf

            <a href="{{ route('expenses.index') }}" id="add-button">
                Back to Expenses
            </a>

            <div class="form-group">
                <label for="description" class="form-label">
                    Description
                </label>
                <input type="text" name="description" id="description" class="budget-input-container form-control">
            </div>

            <div class="form-group">
                <label for="amount" class="form-label">
                    Amount
                </label>
                <div class="budget-input-container input-group">
                    <span class="input-group-text bg-secondary text-light">$</span>
                    <input type="text" name="amount" id="amount" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="category">
                    Category
                </label>
                <select name="category" id="category" class="select-input budget-input-container form-select">
                    <option value="" selected>Please select one...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit">Add</button>
        </form>

    </section>
@endsection
