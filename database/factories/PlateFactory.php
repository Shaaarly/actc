<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plate>
 */
class PlateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users_id = User::pluck('id')->toArray();

        return [
            'plate' => fake()->regexify('[0-9]{4}[A-Z]{3}'),
            'user_id' => fake()->randomElement($users_id)
        ];
    }
}
