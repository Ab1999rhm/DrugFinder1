<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DrugRating extends Model
{
    protected $fillable = ['user_id', 'drug_id', 'rating'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }
}
