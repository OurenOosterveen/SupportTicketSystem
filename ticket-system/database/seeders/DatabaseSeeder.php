<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'password' => bcrypt('0TicketSystem0'),
            'is_admin' => true,
            'telephone_number' => '0123456789',
        ]);

        User::factory(20)->create();
    }
}
