<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'province',
        'postal_code',
        'address',
        'city',
    ];
    public function giftOrders()
    {
        return $this->hasMany(\App\Models\GiftOrder::class);
    }

}
