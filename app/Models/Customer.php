<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function giftOrders()
    {
        return $this->hasMany(\App\Models\GiftOrder::class);
    }

}
