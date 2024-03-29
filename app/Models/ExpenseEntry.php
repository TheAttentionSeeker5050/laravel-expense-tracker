<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseEntry extends Model
{
    use HasFactory;

    // data definition methods and properties -------------------------

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'description' => '',
        'amount' => 0,
        'category_id' => 0,
    ];

    protected $fillable = ['description', 'amount', 'category_id'];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }


    /**
     * The attributes that are mass assignable.
     */
    protected $casts = [
        'description' => 'string',
        'amount' => 'integer',
        'category_id' => 'integer',
    ];


    public function definition(): array
    {
        return [
            'description' => fake()->sentence(6),
            'amount' => fake()->numberBetween(10, 100),
            'category_id' => ExpenseCategory::factory(),
        ];
    }

    // public crud methods --------------------------------------------

    // create entry
    public static function createEntry($description, $amount, $categoryId)
    {
        $entry = new ExpenseEntry();
        $entry->description = $description;
        $entry->amount = $amount;
        $entry->category_id = $categoryId;

        // the timestamps
        $entry->created_at = date('Y-m-d H:i:s');
        $entry->updated_at = date('Y-m-d H:i:s');

        $entry->save();
        return $entry;
    }

    // get entry by id
    public static function getEntryById($id)
    {
        return ExpenseEntry::find($id);
    }

    // get entries by month and year
    public static function getEntriesByMonthYear($month, $year)
    {
        return ExpenseEntry::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get();
    }

    // edit entry by id
    public static function editEntry($id, $description, $amount, $categoryId)
    {
        $entry = ExpenseEntry::find($id);
        $entry->description = $description;
        $entry->amount = $amount;
        $entry->category_id = $categoryId;
        $entry->save();
        return $entry;
    }

    // delete entry by id
    public static function deleteEntry($id)
    {
        $entry = ExpenseEntry::find($id);
        $entry->delete();
    }



}
