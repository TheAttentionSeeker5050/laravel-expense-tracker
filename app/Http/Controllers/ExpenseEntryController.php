<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseEntryRequest;
use App\Http\Requests\UpdateExpenseEntryRequest;
use App\Models\ExpenseEntry;
use App\Models\ExpenseCategory;

class ExpenseEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // a variable for the current nav opttion category
        $currentNavStatus = 'expense';

        // get a list of expense entries
        $expenseEntries = ExpenseEntry::all();

        // display the view expense.expense-entries
        return view('expense.expense-list', [
            'currentNavStatus' => $currentNavStatus,
            'expenseEntries' => $expenseEntries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // a variable for the current nav opttion category
        $currentNavStatus = 'expense';

        // get a list of categories
        $categories = ExpenseCategory::all();

        // display the view expense.create-expense-add
        return view('expense.expense-add', [
            'currentNavStatus' => $currentNavStatus,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseEntryRequest $request)
    {
        // validate the request fields
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|integer',
            'category' => 'required|integer|min:1',
        ]);

        if (!$validated) {
            // remain on the same page with an error message
            return redirect()->route('expenses.create')->with('error', 'An error occurred while creating the expense entry');
        }

        try {
            // create a new expense entry
            ExpenseEntry::createEntry($validated['description'], $validated['amount'], $validated['category']);

            // redirect to expense entries list with a success message
            return redirect()->route('expenses.index')->with('success', 'Expense entry created successfully');

        } catch (\Exception $e) {
            // remain on the same page with an error message
            return redirect()->route('expenses.create')->with('error', 'An error occurred while creating the expense entry' . $e->getMessage());
        }
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
        // a variable for the current nav opttion category
        $currentNavStatus = 'expense';
        // display the view expense.expense-delete
        return view('expense.expense-delete', [
            'currentNavStatus' => $currentNavStatus,
        ]);
    }
}
