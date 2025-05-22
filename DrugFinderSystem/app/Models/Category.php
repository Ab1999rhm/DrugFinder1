<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // If your table is not named 'categories', uncomment and set the table name:
    // protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
        // add other fields as needed
    ];

    /**
     * Get the drugs for this category.
     */
    public function drugs()
    {
        return $this->hasMany(Drug::class);
    }
}
