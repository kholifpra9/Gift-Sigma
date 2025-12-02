<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleAndUserSeeder::class,
            CustomerSeeder::class,
            CustomerAddressSeeder::class,
            CustomerServiceSeeder::class,
            GiftCatalogSeeder::class,
            GiftOrderSeeder::class,
            GiftOrderItemSeeder::class,
            UpdateCustomerFieldsSeeder::class
        ]);
    }
}
