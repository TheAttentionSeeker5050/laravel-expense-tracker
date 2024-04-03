<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpensesAndCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // we will create a list of categories, only 10
        $categories = [
            'Food',
            'Transport',
            'Entertainment',
            'Health',
            'Education',
            'Clothing',
            'Utilities',
            'Insurance',
            'Other',
        ];

        // iterate the categories and create a new category
        foreach ($categories as $category) {
            // create a new category
            \App\Models\ExpenseCategory::create([
                'title' => $category,
                'budget' => random_int(100, 300),
            ]);

        }

        // add rent category as 900 budget
        \App\Models\ExpenseCategory::create([
            'title' => 'Rent',
            'budget' => 900,
        ]);

        // we will create a list of expense entries, 100 entries over the last 20 months
        $entries = [];
        for ($i = 0; $i < 100; $i++) {
            $entries[] = [
                'description' => fake()->sentence(6),
                'amount' => fake()->randomFloat(2, 30, 200),
                // random category between 1 and 10
                'category_id' => fake()->numberBetween(1, 10),
                'created_at' => fake()->dateTimeBetween('-20 month', 'now')->format('Y-m-d H:i:s'),
                'updated_at' => fake()->dateTimeBetween('-20 month', 'now')->format('Y-m-d H:i:s'),
            ];

            // create a new entry
            \App\Models\ExpenseEntry::create([
                'description' => $entries[$i]['description'],
                // cast to float
                'amount' => $entries[$i]['amount'],
                'category_id' => $entries[$i]['category_id'],
                'created_at' => $entries[$i]['created_at'],
                'updated_at' => $entries[$i]['updated_at'],
            ]);
        }
    }
}
