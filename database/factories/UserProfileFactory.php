<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->id,
            'bod' => fake()->date(),
            'nid' => fake()->unique()->numerify('##########'),
            'gender' => fake()->randomElement(['male', 'female']),
            'present_address' => fake()->address(),
            'permanent_address' => fake()->address(),
        ];
    }
}
