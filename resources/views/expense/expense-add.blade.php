@extends('layouts.app')

@section('content')
    <h1>
        Create Expense
    </h1>
    <section id="create-category-expense-main-section">
        <a href="#">
            Back to Expenses
        </a>

        <form action="#" method="post" id="create-expense-category-form">
            <div class="form-group">
                <label for="description">
                    Description
                </label>
                <input type="text" name="description" id="description" >
            </div>

            <div class="form-group">
                <label for="amount">
                    Amount
                </label>
                <input type="text" name="amount" id="amount">
            </div>

            <div class="form-group">
                <label for="category">
                    Category
                </label>
                <select name="category" id="category">
                    <option value="">
                        Please select one...
                    </option>
                    <option value="1">Category 1</option>
                    <option value="2">Category 2</option>
                    <option value="3">Category 3</option>
                </select>

            <button type="submit">Add</button>
        </form>

    </section>
@endsection
