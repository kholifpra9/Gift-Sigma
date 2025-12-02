<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\CustomerAddress;

class CustomerAddressSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Customer::all() as $customer) {
            CustomerAddress::create([
                'customer_id' => $customer->id,
                'location' => "Alamat utama untuk {$customer->name}",
            ]);
        }
    }
}
