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
        // get the current month and year from the query string
        // this includes the default values set as the current month and year
        $month = request('month', date('m'));
        $year = request('year', date('Y'));

        // make previous and next month and year
        $prevMonth = $month - 1;
        $prevYear = $year;
        $nextMonth = $month + 1;
        $nextYear = $year;

        // if the prev month is less than 1, set it to 12 and decrement the year
        if ($prevMonth < 1) {
            $prevMonth = 12;
            $prevYear--;
        }

        // if the next month is greater than 12, set it to 1 and increment the year
        if ($nextMonth > 12) {
            $nextMonth = 1;
            $nextYear++;
        }

        // make string Month (January, February) and string Year
        $strMonth = date('F', strtotime($year . '-' . $month . '-01'));
        $strYear = date('Y', strtotime($year . '-' . $month . '-01'));

        // a variable for the current nav opttion category
        $currentNavStatus = 'expense';

        // get a list of expense entries and filter them by the current month and year
        $expenseEntries = ExpenseEntry::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get();

        // build a list of expense entries classifying them by category
        $expenseEntries = $expenseEntries->groupBy('category_id');


        $categorizedExpenseEntries = [];

        // iterate the categories and add to each of the list elements the category name, the budget and the total expenses
        foreach ($expenseEntries as $categoryId => $entries
        ) {

            $category = ExpenseCategory::find($categoryId);
            // add the category name, the budget and the total expenses
            // print in console the entries[0] created_at and updated_at
            // get the date from a carbon object on entries created_at

            $category->categoryName = $category->title;
            $category->totalExpenses = $entries->sum('amount');
            $category->budget = $category->budget;
            $category->entries = $entries;

            // calculate the percentage of the budget used, rounded
            $category->percentageUsed = round(($category->totalExpenses / $category->budget) * 100);

            // append the category to the list
            $categorizedExpenseEntries[] = $category;
        }

        // display the view expense.expense-entries
        return view('expense.expense-list', [
            'currentNavStatus' => $currentNavStatus,
            'categorizedExpenseEntries' => $categorizedExpenseEntries,
            'strMonth' => $strMonth,
            'strYear' => $strYear,
            'prevMonth' => $prevMonth,
            'prevYear' => $prevYear,
            'nextMonth' => $nextMonth,
            'nextYear' => $nextYear,
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
    public function destroy(UpdateExpenseEntryRequest $request, ExpenseEntry $expenseEntry)
    {
        // if no expense entry is found, return 404
        if (!$expenseEntry) {
            return abort(404);
        }

        // get the entry id
        $entryId = $expenseEntry->id;

        try {
            // delete the expense entry
            $expenseEntry->delete();

            return redirect()->route('expenses.index')->with('success', 'Expense entry deleted successfully');

        } catch (\Exception $e) {
            // remain on the same page with an error message
            return redirect()->route('expenses.delete', $entryId)->with('error', 'An error occurred while deleting the expense entry' . $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteForm(ExpenseEntry $expenseEntry)
    // public function destroyForm(ExpenseEntry $expenseEntry)
    {
        // a variable for the current nav opttion category
        $currentNavStatus = 'expense';


        // display the view expense.expense-delete
        return view('expense.expense-delete', [
            'currentNavStatus' => $currentNavStatus,
            'expenseEntry' => $expenseEntry,
        ]);
    }
}
