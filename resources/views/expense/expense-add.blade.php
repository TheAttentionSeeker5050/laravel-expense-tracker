@extends('layouts.app')

@section('content')
    <h1 id="app-title">
        Create Expense
    </h1>
    <section id="create-category-expense-main-section">

        <form action="{{ isset($isEdit) && $isEdit === true ? route('expenses.update', ['month' => $month, 'year' => $year, 'expenseEntry' => $expenseEntry]) : route('expenses.store', ['month' => $month, 'year' => $year]) }}"
            method="POST" id="create-expense-category-form">
            @csrf

            @if (isset($isEdit) && $isEdit === true)
                @method('PUT')
            @endif

            <a href="{{ isset($month) && isset($year) ? route('expenses.index', ['month' => $month, 'year' => $year]) : route('expenses.index') }}" >
                Back to Expenses
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

            {{-- hidden month and year number --}}
            <input type="hidden" name="month" value="{{ $month }}">
            <input type="hidden" name="year" value="{{ $year }}">

            <div class="form-group">
                <label for="description" class="form-label">
                    Description
                </label>
                @if (isset($description))
                    <input type="text" name="description" id="description" class="budget-input-container form-control"
                        value="{{ $description }}" required>
                @else
                <input type="text" name="description" id="description" class="budget-input-container form-control"
                    required>
                @endif
            </div>

            <div class="form-group">
                <label for="amount" class="form-label">
                    Amount
                </label>
                <div class="budget-input-container input-group">
                    <span class="input-group-text bg-secondary text-light">$</span>
                    @if (isset($amount))
                    {{-- input 2 decimal places --}}
                        <input type="number" name="amount" id="amount" class="form-control"
                            value="{{ $amount }}" required step="0.01">
                    @else
                        <input type="number" name="amount" id="amount" class="form-control"
                            required step="0.01">
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="category">
                    Category
                </label>
                <select name="category" id="category" class="select-input budget-input-container form-select"
                    required>
                    <option value='{{null}}'>Please select one...</option>
                    @foreach($categories as $category)
                        @if (isset($selectedCategory) && $selectedCategory === $category->id)
                            <option value="{{ $category->id }}" selected>
                                {{ $category->title }}
                            </option>
                        @else
                            <option value="{{ $category->id }}">
                                {{ $category->title }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            @if (isset($isEdit) && $isEdit)
                <button type="submit">Update</button>
            @else
                <button type="submit">Add</button>
            @endif
        </form>

    </section>
@endsection
