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

        {{-- iterate the categorized entries --}}
        @foreach ($categorizedExpenseEntries as $expenseEntryCategory)
            <ul class="expenses-list">
                <li class="expense-list-header">
                    <span>{{ $expenseEntryCategory['categoryName'] }}</span>
                    <span>${{ $expenseEntryCategory['totalExpenses'] }} of ${{ $expenseEntryCategory['budget'] }}/month</span>
                </li>

                {{-- consumption bar --}}
                <li class="budget-consumption-bar"
                    style="width: {{
                        $expenseEntryCategory['percentageUsed'] > 100 ? '100%' : $expenseEntryCategory['percentageUsed'] . '%'
                    }};
                    border-color: {{
                        $expenseEntryCategory['percentageUsed'] > 100 ? 'var(--outline-red)' : (
                            $expenseEntryCategory['percentageUsed'] == 100 ? 'var(--outline-yellow)' : 'var(--outline-green)'
                        )
                    }};"
                    >
                </li>

                @foreach ($expenseEntryCategory['entries'] as $expenseEntry)
                    <li class="expense-list-item">
                        <span>{{ $expenseEntry->description }} - ${{ $expenseEntry->amount }}</span>
                        |
                        <a href="{{ route('expenses.delete', ['expenseEntry' => $expenseEntry]) }}">Delete</a>
                    </li>

                @endforeach
            </ul>
        @endforeach

    </section>
@endsection
