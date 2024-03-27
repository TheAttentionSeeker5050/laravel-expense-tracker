<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseEntryRequest;
use App\Http\Requests\UpdateExpenseEntryRequest;
use App\Models\ExpenseEntry;

class ExpenseEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // display the view expense.expense-entries
        return view('expense.expense-list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // display the view expense.create-expense-add
        return view('expense.expense-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseEntryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ExpenseEntry $expenseEntry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpenseEntry $expenseEntry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseEntryRequest $request, ExpenseEntry $expenseEntry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpenseEntry $expenseEntry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteForm()
    // public function destroyForm(ExpenseEntry $expenseEntry)
    {
        // display the view expense.expense-delete
        return view('expense.expense-delete');
    }
}
