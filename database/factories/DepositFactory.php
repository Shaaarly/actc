<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Lease;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deposit>
 */
class DepositFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $lease_id = Lease::pluck('id')->toArray();

        return [
            'returned' => fake()->boolean(),
            'description' => fake()->sentence(),
            'amount' => fake()->numberBetween(30, 400),
            'leases_id' => fake()->unique()->randomElement($lease_id)
        ];
    }
}
