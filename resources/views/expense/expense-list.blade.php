@extends('layouts.app')

@section('content')

    <section id="expense-month-navigation-buttons-section">
        <h1>
            Expenses - March 2024
        </h1>

        <p>
            <a href="#" >
                Previous Month
            </a>

            <a href="#" >
                Next Month
            </a>
        </p>
    </section>

    <section id="expense-listing-main-section">
        <a href="{{ route('expenses.create') }}" id="add-button">
            Add Expense
        </a>

        <ul id="category-expense-list">
            <li class="category-expense-list-header">
                <span>Category 1</span>
                <span>$400.00 of $600.00</span>
            </li>
            <li class="category-expense-list-item">
                <a href="#">Expense 1 - $100.00</a>
                |
                <a href="#">Delete</a>
            </li>
            <li class="category-expense-list-item">
                <a href="#">Expense 2 - $200.00</a>
                |
                <a href="#">Delete</a>
            </li>

            <li class="category-expense-list-item">
                <a href="#">Expense 3 - $100.00</a>
                |
                <a href="#">Delete</a>
            </li>

            <li class="category-expense-list-item">
                <a href="#">Expense 4 - $200.00</a>
                |
                <a href="#">Delete</a>
            </li>
        </ul>

        <ul id="category-expense-list">
            <li class="category-expense-list-header">
                <span>Category 1</span>
                <span>$400.00 of $600.00</span>
            </li>
            <li class="category-expense-list-item">
                <a href="#">Expense 1 - $100.00</a>
                |
                <a href="#">Delete</a>
            </li>
            <li class="category-expense-list-item">
                <a href="#">Expense 2 - $200.00</a>
                |
                <a href="#">Delete</a>
            </li>

            <li class="category-expense-list-item">
                <a href="#">Expense 3 - $100.00</a>
                |
                <a href="#">Delete</a>
            </li>

            <li class="category-expense-list-item">
                <a href="#">Expense 4 - $200.00</a>
                |
                <a href="#">Delete</a>
            </li>
        </ul>

    </section>
@endsection
