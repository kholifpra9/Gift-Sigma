<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftOrderItem extends Model
{
    protected $fillable = [
        'gift_order_id',
        'gift_catalog_id',
        'quantity',
    ];

    public function order()
    {
        return $this->belongsTo(GiftOrder::class, 'gift_order_id');
    }

    public function catalog()
    {
        return $this->belongsTo(GiftCatalogs::class, 'gift_catalog_id');
    }
}
