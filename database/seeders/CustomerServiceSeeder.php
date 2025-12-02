<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CustomerService;
use App\Models\User;

class CustomerServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user yang punya role CS
        $csUsers = User::role('cs')->get();

        foreach ($csUsers as $user) {
            CustomerService::create([
                'name' => $user->name,
                'user_id' => $user->id,
            ]);
        }
    }
}
