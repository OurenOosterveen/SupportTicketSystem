<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random(),
            'assignee_id' => User::where('is_admin', true)->get()->random(),
            'status_id' => Status::all()->random(),
            'category_id' => Category::all()->random(),
            'title' => fake()->realText(50),
            'content' => fake()->realText(500),
        ];
    }
}
