<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'drug_id', 'quantity', 'price'
    ];

    public function drug()
    {
        return $this->belongsTo(Drug::class);
    }

    // Add this for easy access to the parent order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
