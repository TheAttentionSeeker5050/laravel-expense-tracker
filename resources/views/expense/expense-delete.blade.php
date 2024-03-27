@extends('layouts.app')

@section('content')
    <h1 id="app-title">
        Delete Expense
    </h1>
    <section id="create-category-expense-main-section">
        <a href="{{ route('expenses.index') }}" id="add-button">
            Back to Expenses
        </a>

        <form action="#" method="post" id="create-expense-category-form">
            <p>
                Are you sure you want to delete the
                < test 2 >
                expense?
            </p>

            <button type="submit">Delete</button>
        </form>

    </section>
@endsection
