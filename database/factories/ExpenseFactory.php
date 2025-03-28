<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Property;
use App\Models\PropertyType;

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

        $properties_id = Property::pluck('id')->toArray();
        $types_id = PropertyType::pluck('id')->toArray();

        return [
            'value' => fake()->numberBetween(10, 1000),
            'description' => fake()->sentence(),
            'expense_type_id' => fake()->randomElement($types_id),
            'property_id' => fake()->randomElement($properties_id)
        ];
    }
}
