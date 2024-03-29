<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // create table ExpenseEntry
        Schema::create('expense_entries', function (Blueprint $table) {
            $table->id();
            $table->string('description')->default('');
            $table->integer('amount')->default(0);
            $table->integer('categoryId')->default(0);
            $table->dateTime('date')->default(date('Y-m-d H:i:s'));
            $table->timestamps();
        });


        // create table ExpenseCategory
        Schema::create('expense_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('');
            $table->integer('budget')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables_expense');
    }
};
