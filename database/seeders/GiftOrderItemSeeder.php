<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GiftOrderItem;
use App\Models\GiftOrder;
use App\Models\GiftCatalog;

class GiftOrderItemSeeder extends Seeder
{
    public function run(): void
    {
        $order = GiftOrder::first();
        $catalog = GiftCatalog::first();

        if (!$order || !$catalog) return;

        GiftOrderItem::create([
            'gift_order_id' => $order->id,
            'gift_catalog_id' => $catalog->id,
            'quantity' => 2,
        ]);
    }
}
