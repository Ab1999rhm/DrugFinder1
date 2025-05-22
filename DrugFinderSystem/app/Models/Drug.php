<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'name',
        'brand',
        'category',
        'dosage_form',
        'strength',
        'quantity',
        'price',
        'expiry_date',
        'description',
        'rating', // Add this if you want to store rating per drug offer
    ];

    public function seller()
    {
        return $this->belongsTo(\App\Models\Seller::class);
    }
    public function orderItems()
{
    return $this->hasMany(\App\Models\OrderItem::class);
}
public function wishlists()
{
    return $this->hasMany(\App\Models\Wishlist::class);
}
// In Drug.php
public function ratings()
{
    return $this->hasMany(\App\Models\DrugRating::class);
}

}
