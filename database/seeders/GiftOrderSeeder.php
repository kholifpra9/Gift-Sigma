<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GiftOrder;
use App\Models\Customer;
use App\Models\CustomerService;

class GiftOrderSeeder extends Seeder
{
    public function run(): void
    {
        $customer = Customer::first();
        $cs = CustomerService::first();

        if (!$customer || !$cs) return;

        GiftOrder::create([
            'customer_id' => $customer->id,
            'customer_service_id' => $cs->id,
            'status' => 1, // Pending
        ]);
    }
}
