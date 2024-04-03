@extends('layouts.app')

@section('content')
    <h1 id="app-title">
        Create Expense
    </h1>
    <section id="create-category-expense-main-section">

        <form action="{{ $isEdit ? route('expenses.update', ['month' => $month, 'year' => $year, 'expenseEntry' => $expenseEntry]) : route('expenses.store', ['month' => $month, 'year' => $year]) }}"
            method="POST" id="create-expense-category-form">
            @csrf

            @if ($isEdit)
                @method('PUT')
            @endif

            <a href="{{ route('expenses.index') }}" id="add-button">
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
                @if ($description !== null)
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
                    @if ($amount !== null)
                        <input type="number" name="amount" id="amount" class="form-control"
                            value="{{ $amount }}" required>
                    @else
                        <input type="number" name="amount" id="amount" class="form-control"
                            required>
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
                        @if ($selectedCategory !== null && $selectedCategory == $category->id)
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

            @if ($isEdit)
                <button type="submit">Update</button>
            @else
                <button type="submit">Add</button>
            @endif
        </form>

    </section>
@endsection
