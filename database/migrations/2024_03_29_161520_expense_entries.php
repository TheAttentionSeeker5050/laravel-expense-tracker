<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('expense_entries', function (Blueprint $table) {
            $table->id();
            $table->string('description')->default('');
            // float with 2 decimals
            $table->decimal('amount', 10, 2)->default(0);
            $table->unsignedBigInteger('category_id')->default(0);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('expense_categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('expense_entries');
    }
};
