<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('0TicketSystem0'),
            'is_admin' => true,
            'telephone_number' => '0123456789',
        ]);

        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'user@test.com',
            'password' => bcrypt('0TicketSystem0'),
            'is_admin' => false,
            'telephone_number' => '9876543210',
        ]);

        User::factory(20)->create();
    }
}
