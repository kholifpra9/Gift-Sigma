<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GiftCatalog;

class GiftCatalogSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'Mug Eksklusif', 'link' => null, 'platform' => 'Internal'],
            ['name' => 'Kaos Merchandise', 'link' => null, 'platform' => 'Internal'],
            ['name' => 'Voucher Belanja 50K', 'link' => null, 'platform' => 'Tokopedia'],
            ['name' => 'Voucher Belanja 100K', 'link' => null, 'platform' => 'Shopee'],
        ];

        foreach ($items as $i) {
            GiftCatalog::create($i);
        }
    }
}
