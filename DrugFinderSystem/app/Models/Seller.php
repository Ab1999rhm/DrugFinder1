<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Seller extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'shop_name',
        'latitude',
        'longitude',
        'location_coordinates', // Added based on your DB error
        'contact_number',
        'phone',
        'address',
        'company_name',
        'website',
        'profile_image',
        'bank_account',
        'tax_id',
        'bio',
        'date_of_birth',
        'city',
        'state',
        'country',
        'postal_code',
        'emergency_contact',
        'orders_seen_at',
    ];

    /**
     * The attributes that should be hidden for arrays (e.g., JSON serialization).
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'orders_seen_at' => 'datetime',
        'date_of_birth' => 'date',
    ];

    /**
     * Automatically hash the password when it is set.
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        if ($value && \Illuminate\Support\Facades\Hash::needsRehash($value)) {
            $this->attributes['password'] = bcrypt($value);
        } else {
            $this->attributes['password'] = $value;
        }
    }

    /**
     * Get the drugs associated with the seller.
     */
    public function drugs()
    {
        return $this->hasMany(\App\Models\Drug::class);
    }

    /**
     * Get the orders associated with the seller.
     */
    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }

    /**
     * Count unread pending orders since last seen.
     *
     * @return int
     */
    public function unreadOrdersCount()
    {
        return \App\Models\Order::where('seller_id', $this->id)
            ->where('status', 'pending')
            ->where(function ($query) {
                $query->whereNull('created_at')
                    ->orWhere('created_at', '>', $this->orders_seen_at);
            })
            ->count();
    }
}
