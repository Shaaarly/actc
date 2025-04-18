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
        static $leases_id = null;

        if ($leases_id === null) {
            $leases_id = Lease::pluck('id')->shuffle()->toArray();
        }

        return [
            'lease_id' => array_shift($leases_id),
            'returned' => fake()->boolean(),
            'description' => fake()->sentence(),
            'amount' => fake()->numberBetween(30, 400)
        ];
    }
}
