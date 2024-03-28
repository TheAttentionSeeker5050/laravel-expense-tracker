@extends('layouts.app')

@section('content')
    <h1 id="app-title">
        Create Expense
    </h1>
    <section id="create-category-expense-main-section">

        <form action="#" method="post" id="create-expense-category-form">
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
                    <option value="1">Category 1</option>
                    <option value="2">Category 2</option>
                    <option value="3">Category 3</option>
                </select>
            </div>

            <button type="submit">Add</button>
        </form>

    </section>
@endsection
