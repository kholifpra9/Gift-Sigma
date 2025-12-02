<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            'Andi Wijaya',
            'Budi Santoso',
            'Citra Lestari',
            'Dewi Anggraini',
            'Eko Prasetyo',
            'Fiona Maharani',
        ];

        foreach ($customers as $name) {
            Customer::create(['name' => $name]);
        }
    }
}
