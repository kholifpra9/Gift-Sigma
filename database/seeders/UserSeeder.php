<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ----------------------------
        // Customer Service User
        // ----------------------------
        $cs = User::firstOrCreate(
            ['email' => 'cs@example.com'],
            [
                'name' => 'Customer Service',
                'password' => Hash::make('password'),
            ]
        );
        $cs->assignRole('customer_service');

        // ----------------------------
        // Finance User
        // ----------------------------
        $finance = User::firstOrCreate(
            ['email' => 'finance@example.com'],
            [
                'name' => 'Finance User',
                'password' => Hash::make('password'),
            ]
        );
        $finance->assignRole('finance');
    }
}
