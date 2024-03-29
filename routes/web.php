<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseEntryController;
use App\Http\Controllers\ExpenseCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// redirect to expenses
Route::redirect('/', 'expenses');
// Route::get('/', [HomeController::class, 'index']) -> name('home');

// the expense routes
Route::get('/expenses', [ExpenseEntryController::class, 'index']) -> name('expenses.index');
Route::get('/expenses/create', [ExpenseEntryController::class, 'create']) -> name('expenses.create');
Route::post('/expenses/create', [ExpenseEntryController::class, 'store']) -> name('expenses.store');
Route::get('/expenses/{expenseEntry}/delete', [ExpenseEntryController::class, 'deleteForm']) -> name('expenses.delete');
Route::delete('/expenses/{expenseEntry}/delete', [ExpenseEntryController::class, 'destroy']) -> name('expenses.destroy');

// the category routes
Route::get('/categories', [ExpenseCategoryController::class, 'index']) -> name('categories.index');
Route::get('/categories/create', [ExpenseCategoryController::class, 'create']) -> name('categories.create');
Route::post('/categories/create', [ExpenseCategoryController::class, 'store']) -> name('categories.store');
Route::get('/categories/{expenseCategory}/edit', [ExpenseCategoryController::class, 'edit']) -> name('categories.edit');
Route::put('/categories/{expenseCategory}/edit', [ExpenseCategoryController::class, 'update']) -> name('categories.update');

