<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    use HasFactory;

    // data definition methods and properties -------------------------
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'title' => '',
        'budget' => 0,
    ];

    // protected $fillable = ['title', 'budget'];

    public function entries()
    {
        return $this->hasMany(ExpenseEntry::class, 'category_id');
    }

    /**
     * The attributes that are mass assignable.
     */
    protected $casts = [
        'title' => 'string',
        'budget' => 'integer',
    ];

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'budget' => fake()->numberBetween(100, 1000),
        ];
    }

    // public crud methods --------------------------------------------
    // create category
    public static function createCategory($title, $budget)
    {
        $category = new ExpenseCategory();
        $category->title = $title;
        $category->budget = $budget;
        $category->save();
        return $category;
    }

    // read category
    public static function readCategory($id)
    {
        return ExpenseCategory::find($id);
    }

    // update category
    public static function updateCategory($id, $title, $budget)
    {
        $category = ExpenseCategory::find($id);
        $category->title = $title;
        $category->budget = $budget;
        $category->save();
        return $category;
    }

    // delete category
    public static function deleteCategory($id)
    {
        $category = ExpenseCategory::find($id);
        $category->delete();
    }
}
