<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class UpdateCustomerFieldsSeeder extends Seeder
{
    public function run(): void
    {
        // Contoh dummy data untuk 6 customer awal
        $dummy = [
            [
                'phone' => '081234567001',
                'address' => 'Jalan Melati No. 10',
                'city' => 'Jakarta',
                'province' => 'DKI Jakarta',
                'postal_code' => '10110',
            ],
            [
                'phone' => '081234567002',
                'address' => 'Jalan Mawar No. 21',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
                'postal_code' => '40121',
            ],
            [
                'phone' => '081234567003',
                'address' => 'Jalan Kenanga No. 5',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'postal_code' => '60233',
            ],
            [
                'phone' => '081234567004',
                'address' => 'Jalan Anggrek No. 8',
                'city' => 'Medan',
                'province' => 'Sumatera Utara',
                'postal_code' => '20111',
            ],
            [
                'phone' => '081234567005',
                'address' => 'Jalan Cempaka No. 19',
                'city' => 'Denpasar',
                'province' => 'Bali',
                'postal_code' => '80114',
            ],
            [
                'phone' => '081234567006',
                'address' => 'Jalan Flamboyan No. 3',
                'city' => 'Semarang',
                'province' => 'Jawa Tengah',
                'postal_code' => '50134',
            ],
        ];

        $customers = Customer::orderBy('id')->take(6)->get();

        foreach ($customers as $i => $cust) {
            $cust->update($dummy[$i]);
        }
    }
}
