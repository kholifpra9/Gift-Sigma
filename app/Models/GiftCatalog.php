<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftCatalog extends Model
{
    protected $fillable = ['name', 'link', 'platform'];

    public function orderItems()
    {
        return $this->hasMany(GiftOrderItem::class);
    }
}
