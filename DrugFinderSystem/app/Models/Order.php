<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'seller_id', 'total', 'status'
    ];

    // Each order can have multiple order items (drugs and quantities)
    public function items()
    {
        return $this->hasMany(\App\Models\OrderItem::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function seller()
    {
        return $this->belongsTo(\App\Models\Seller::class, 'seller_id');
    }

    // Remove this, as your drugs are accessed via items:
    // public function drug()
    // {
    //     return $this->belongsTo(\App\Models\Drug::class, 'drug_id');
    // }

    // Keep if you use pharmacy on orders
    public function pharmacy()
    {
        return $this->belongsTo(\App\Models\Pharmacy::class, 'pharmacy_id');
    }
}
