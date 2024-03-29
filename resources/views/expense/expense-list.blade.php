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

        {{-- print the amount of expense entries --}}
        <p class="alert alert-success">
            You have {{ $expenseEntries->count() }} expense entries
        </p>

        <ul class="expenses-list">
            <li class="expense-list-header">
                <span>Category 1</span>
                <span>$400.00 of $600.00/month</span>
            </li>
            <li class="budget-consumption-bar"
            style="width: 60%; border-color: var(--outline-green);"
            >

            </li>
            <li class="expense-list-item">
                <span>Expense 1 - $100.00</span>
                |
                <a href="{{ route('expenses.delete', ['expenseEntry' => 1]) }}">Delete</a>
            </li>
            <li class="expense-list-item">
                <span>Expense 2 - $200.00</span>
                |
                <a href="{{ route('expenses.delete', ['expenseEntry' => 1]) }}">Delete</a>
            </li>

            <li class="expense-list-item">
                <span>Expense 3 - $100.00</span>
                |
                <a href="{{ route('expenses.delete', ['expenseEntry' => 1]) }}">Delete</a>
            </li>

            <li class="expense-list-item">
                <span>Expense 4 - $200.00</span>
                |
                <a href="{{ route('expenses.delete', ['expenseEntry' => 1]) }}">Delete</a>
            </li>
        </ul>

    </section>
@endsection
