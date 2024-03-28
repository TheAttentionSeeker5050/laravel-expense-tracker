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
        // add the columns title and budget to the table expense_categories
        Schema::table('expense_categories', function (Blueprint $table) {
            $table->string('title');
            $table->integer('budget');
        });

        // add the columns description, amount, categoryId, and date to the table expense_entries
        Schema::table('expense_entries', function (Blueprint $table) {
            $table->string('description');
            $table->integer('amount');
            $table->integer('categoryId');
            $table->dateTime('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
