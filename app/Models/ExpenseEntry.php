<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseEntry extends Model
{
    use HasFactory;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'description' => '',
        'amount' => 0,
        'categoryId' => 0,
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->attributes['date'] = date('Y-m-d H:i:s');
    }
    /**
     * The attributes that are mass assignable.
     */
    protected $casts = [
        'description' => 'string',
        'amount' => 'integer',
        'categoryId' => 'integer',
        'date' => 'datetime',
    ];

    // define relationships
    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'categoryId');
    }

    // public crud methods --------------------------------------------
    public function definition(): array
    {
        return [
            'description' => fake()->sentence(6),
            'amount' => fake()->numberBetween(10, 100),
            'categoryId' => ExpenseCategory::factory(),
            'date' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }

    // public crud methods --------------------------------------------

    // create entry
    public static function createEntry($description, $amount, $categoryId, $date)
    {
        $entry = new ExpenseEntry();
        $entry->description = $description;
        $entry->amount = $amount;
        $entry->categoryId = $categoryId;
        $entry->date = $date;
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
        return ExpenseEntry::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->get();
    }

    // edit entry by id
    public static function editEntry($id, $description, $amount, $categoryId, $date)
    {
        $entry = ExpenseEntry::find($id);
        $entry->description = $description;
        $entry->amount = $amount;
        $entry->categoryId = $categoryId;
        $entry->date = $date;
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
