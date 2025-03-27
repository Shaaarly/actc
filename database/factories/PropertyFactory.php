<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price' => fake()->numberBetween(12, 600),
            'available' => fake()->boolean(),
            'ocupied' => fake()->boolean(),
            'description' => fake()->sentence(),
            'area' => fake()->numberBetween(12, 120),
            'bathrooms' => fake()->random_digit(),
            'rooms' => fake()->random_digit(),
            'remote' => fake()->boolean(60),
            'keys' => fake()->boolean(100),
            'property_type_id' => fake()->numberBetween(1, 4)
        ];
    }

    public function garage() {
        return $this->state(fn (array $attributes) => [
            'property_type_id' => 1,
            'bathroom' => null,
            'rooms' => null,
        ]);
    }

    public function comercial() {
        return $this->state(fn (array $attributes) => ['property_type_id' => 2]);
    }

    public function storage() {
        return $this->state(fn (array $attributes) => [
            'property_type_id' => 3,
            'bathroom' => null,
            'rooms' => null,
        ]);
    }

    public function house() {
        return $this->state(fn (array $attributes) => ['property_type_id' => 4]);
    }
}
