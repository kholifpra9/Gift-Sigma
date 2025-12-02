<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        // --- Create Roles ---
        $roles = ['cs', 'finance'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // --- Create Users ---
        $cs = User::firstOrCreate(
            ['email' => 'cs@example.com'],
            [
                'name' => 'Customer Service 1',
                'password' => Hash::make('password'),
            ]
        );
        $cs->assignRole('cs');

        $finance = User::firstOrCreate(
            ['email' => 'finance@example.com'],
            [
                'name' => 'Finance Admin',
                'password' => Hash::make('password'),
            ]
        );
        $finance->assignRole('finance');
    }
}
