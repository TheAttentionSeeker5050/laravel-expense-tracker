<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseCategoryRequest;
use App\Http\Requests\UpdateExpenseCategoryRequest;
use App\Models\ExpenseCategory;

class ExpenseCategoryController extends Controller
{
    // public function __construct()
    // {
    //     // exclude all the views from auth middleware, use wildcard
    //     $this->middleware('auth')->except(['index', 'create', 'store']);
    // }

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


        // display the view category.category-add
        return view('category.category-add', [
            'currentNavStatus' => $currentNavStatus,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseCategoryRequest $request)
    {


        // // get title and budget from the request
        // $title = $request->input('title');
        // $budget = $request->input('budget');

        // validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'budget' => 'required|integer',
        ]);

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseCategoryRequest $request, ExpenseCategory $expenseCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpenseCategory $expenseCategory)
    {
        //
    }
}
