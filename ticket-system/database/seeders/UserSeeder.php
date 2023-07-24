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
