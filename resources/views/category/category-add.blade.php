@extends('layouts.app')

@section('content')
    <h1>
        Create Category
    </h1>
    <section id="create-category-expense-main-section">
        <a href="#">All Categories</a>

        <form action="#" method="post" id="create-expense-category-form">
            <div class="form-group">
                <label for="title">
                    Title
                </label>
                <input type="text" name="title" id="title" >
            </div>

            <div class="form-group">
                <label for="budget">
                    Budget
                </label>
                <input type="text" name="budget" id="budget">
            </div>

            <button type="submit">Create</button>
        </form>

    </section>
@endsection
