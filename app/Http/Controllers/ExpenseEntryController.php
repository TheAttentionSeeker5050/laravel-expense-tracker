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

        // get a list of categories
        $categories = ExpenseCategory::all();

        // create a list of categorized expense entries
        $categorizedExpenseEntries = [];

        // iterate the categories and add to each of the list elements the category name, the budget and the total expenses
        foreach ($expenseEntries as $categoryId => $entries
        ) {

            $category = ExpenseCategory::find($categoryId);
            // add the category name, the budget and the total expenses
            // print in console the entries[0] created_at and updated_at
            // get the date from a carbon object on entries created_at
            $category->categoryID = $category->id;
            $category->categoryName = $category->title;
            $category->totalExpenses = round($entries->sum('amount'));
            $category->budget = $category->budget;
            $category->entries = $entries;

            // calculate the percentage of the budget used, rounded
            $category->percentageUsed = round(($category->totalExpenses / $category->budget) * 100);

            // append the category to the list
            $categorizedExpenseEntries[] = $category;
        }

        // fill the remaining categories with no expenses, just title and budget ----------------
        // --------------------------------------------------------------------------------------

        // first filter out the categories array that have already been added
        $categories = $categories->filter(function ($category) use ($categorizedExpenseEntries) {
            foreach ($categorizedExpenseEntries as $categorizedExpenseEntry) {
                // if it is already in the list, return false
                if ($category->id == $categorizedExpenseEntry->categoryID) {
                    return false;
                }
            }
            return true;
        });


        // iterate the remaining categories and add to each of the list elements the category name, the budget and the total expenses
        foreach ($categories as $category) {
            // add the category name, the budget and the total expenses
            $category->categoryID = $category->id;
            $category->categoryName = $category->title;
            $category->totalExpenses = 0;
            $category->budget = $category->budget;
            $category->entries = [];
            $category->percentageUsed = 0;

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
            'month' => $month,
            'year' => $year,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // get month and year from the query string
        $month = request('month', date('m'));
        $year = request('year', date('Y'));

        // a variable for the current nav opttion category
        $currentNavStatus = 'expense';

        // get a list of categories
        $categories = ExpenseCategory::all();

        // display the view expense.create-expense-add
        return view('expense.expense-add', [
            'currentNavStatus' => $currentNavStatus,
            'categories' => $categories,
            'month' => $month,
            'year' => $year,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseEntryRequest $request)
    {
        // get the year and month from the request body
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));
        // create custom created_at date
        $customCreatedAt = $year . '-' . $month . '-01 00:00:00';


        // validate the request fields
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            // amount must be a float
            'amount' => 'required|numeric',
            'category' => 'required|integer|min:1',
        ]);

        if (!$validated) {
            // remain on the same page with an error message
            return redirect()->route('expenses.create')->with('error', 'An error occurred while creating the expense entry');
        }

        try {
            // create a new expense entry
            ExpenseEntry::createEntry($validated['description'], round($validated['amount'], 2), $validated['category'], $customCreatedAt);

            // redirect to expense entries list with a success message
            return redirect()->route('expenses.index', ['month' => $month, 'year' => $year])->with('success', 'Expense entry created successfully');

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
        // // get month and year from the query string
        // $month = request('month', date('m'));
        // $year = request('year', date('Y'));

        // get month and year from the expense entry created_at
        $month = date('m', strtotime($expenseEntry->created_at));
        $year = date('Y', strtotime($expenseEntry->created_at));

        // get the fields from the expense entry
        $description = $expenseEntry->description;
        $amount = $expenseEntry->amount;
        $category = $expenseEntry->category_id;

        // a variable for the current nav opttion category
        $currentNavStatus = 'expense';

        // get a list of categories
        $categories = ExpenseCategory::all();

        // display the view expense.create-expense-add
        return view('expense.expense-add', [
            'currentNavStatus' => $currentNavStatus,
            'categories' => $categories,
            'month' => $month,
            'year' => $year,
            'description' => $description,
            'amount' => $amount,
            'selectedCategory' => $category,
            'isEdit' => true,
            'expenseEntry' => $expenseEntry,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseEntryRequest $request, ExpenseEntry $expenseEntry)
    {
        // get the year and month from the request body
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));


        // validate the request fields
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'category' => 'required|integer|min:1',
        ]);

        if (!$validated) {
            // remain on the same page with an error message
            return redirect()->route('expenses.edit', $expenseEntry->id)->with('error', 'An error occurred while updating the expense entry');
        }

        try {
            // create a new expense entry
            ExpenseEntry::editEntry($expenseEntry->id, $validated['description'], $validated['amount'], $validated['category']);

            // redirect to expense entries list with a success message
            return redirect()->route('expenses.index', ['month' => $month, 'year' => $year])->with('success', 'Expense entry created successfully');

        } catch (\Exception $e) {
            // remain on the same page with an error message
            return redirect()->route('expenses.edit', $expenseEntry->id)->with('error', 'An error occurred while updating the expense entry' . $e->getMessage());
        }
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

        // get the month and year from the expense entry created_at
        $month = date('m', strtotime($expenseEntry->created_at));
        $year = date('Y', strtotime($expenseEntry->created_at));

        try {
            // delete the expense entry
            $expenseEntry->delete();

            return redirect()->route('expenses.index', ['month' => $month, 'year' => $year])->with('success', 'Expense entry deleted successfully');

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
