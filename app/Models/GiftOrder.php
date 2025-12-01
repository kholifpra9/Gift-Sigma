<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftOrder extends Model
{
    protected $fillable = [
        'customer_id',
        'customer_service_id',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function customerService()
    {
        return $this->belongsTo(CustomerService::class);
    }

    public function items()
    {
        return $this->hasMany(GiftOrderItem::class);
    }
}
