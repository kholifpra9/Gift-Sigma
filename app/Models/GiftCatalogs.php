<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftCatalogs extends Model
{
    protected $fillable = ['name', 'link', 'platform'];

    public function orderItems()
    {
        return $this->hasMany(GiftOrderItem::class);
    }
}
