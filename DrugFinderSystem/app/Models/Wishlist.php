<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['user_id', 'drug_id', 'prescription_note'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }
}
