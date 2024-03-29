<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseCategoryRequest;
use App\Http\Requests\UpdateExpenseCategoryRequest;
use App\Models\ExpenseCategory;

class ExpenseCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // a variable for the current nav opttion category
        $currentNavStatus = 'category';


        // get the categories
        $categories = ExpenseCategory::all();

        // display the view category.category-list
        return view('category.category-list', [
            'currentNavStatus' => $currentNavStatus,
            'categories' => $categories,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // a variable for the current nav opttion category
        $currentNavStatus = 'category';
        // $currentMethod = 'POST';




        // display the view category.category-add
        return view('category.category-add', [
            'currentNavStatus' => $currentNavStatus,
            // 'currentMethod' => $currentMethod,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseCategoryRequest $request)
    {

        // validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'budget' => 'required|integer',
        ]);

        if (!$validated) {
            return redirect()->back()->with('error', 'An error occurred. Please try again. Title: ' . $validated['title'] . '  | Budget: ' . $validated['budget']);
        }

        try {
            // create a new category
            ExpenseCategory::createCategory($validated['title'], $validated['budget']);

            // redirect to the category list
            return redirect()->route('categories.index') -> with('success', 'Category created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred. Please try again. Title: ' . $validated['title'] . '  | Budget: ' . $validated['budget'] . ' | Error: ' . $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(ExpenseCategory $expenseCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpenseCategory $expenseCategory)
    {
        // if expense category is not found, redirect to 404
        if (!$expenseCategory) {
            abort(404);
        }

        // a variable for the current nav opttion category
        $currentNavStatus = 'category';
        $currentMethod = 'PUT';

        // display add view
        return view('category.category-add', [
            'category' => $expenseCategory,
            'currentNavStatus' => $currentNavStatus,
            'currentMethod' => $currentMethod,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseCategoryRequest $request, ExpenseCategory $expenseCategory)
    {
        // if expense category is not found, redirect to 404
        if (!$expenseCategory) {
            abort(404);
        }

        // validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'budget' => 'required|integer',
        ]);

        try {
            // update the category
            $expenseCategory->updateCategory($request->id, $validated['title'], $validated['budget']);

            // redirect to the category list
            return redirect()->route('categories.index') -> with('success', 'Category updated successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred. Please try again. Title: ' . $validated['title'] . '  | Budget: ' . $validated['budget'] . ' | Error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpenseCategory $expenseCategory)
    {
        //
    }
}
