@extends('layouts.app')

@section('content')
    <h1 id="app-title">
        Delete Expense
    </h1>
    <section id="create-category-expense-main-section">

        <form action="{{ route('expenses.destroy', ['expenseEntry' => $expenseEntry]) }}"
            method="post" id="create-expense-category-form"
            >
            @csrf
            @method('DELETE')

            <a href="{{ route('expenses.index') }}" id="add-button">
                Back to Expenses
            </a>

            <p> Are you sure you want to delete the expense
                < {{ $expenseEntry->description }} - ${{ $expenseEntry->amount }} >
                ? </p>

            <button type="submit">Delete</button>
        </form>

    </section>
@endsection
