<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'value' => fake()->numberBetween(10, 1000),
            'description' => fake()->sentence(),
            'expense_type_id' => fake()->numberBetween(1, 7),
            'property_id' => fake()->numberBetween(1, 18)
        ];
    }
}
