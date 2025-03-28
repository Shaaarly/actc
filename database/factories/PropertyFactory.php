<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\PropertyType;

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

        $types_id = PropertyType::pluck('id')->toArray();

        return [
            'price' => fake()->numberBetween(12, 600),
            'available' => fake()->boolean(),
            'ocupied' => fake()->boolean(),
            'description' => fake()->sentence(),
            'area' => fake()->numberBetween(12, 120),
            'bathrooms' => fake()->randomDigit(),
            'rooms' => fake()->randomDigit(),
            'remote' => fake()->boolean(60),
            'keys' => fake()->boolean(100),
            'property_type_id' => fake()->randomElement($types_id)
        ];
    }
    
    public function garage() {
        return $this->state(fn (array $attributes) => [
            'property_type_id' => 1,
            'bathrooms' => null,
            'rooms' => null,
        ]);
    }

    public function comercial() {
        return $this->state(fn (array $attributes) => ['property_type_id' => 2]);
    }

    public function storage() {
        return $this->state(fn (array $attributes) => [
            'property_type_id' => 3,
            'bathrooms' => null,
            'rooms' => null,
        ]);
    }

    public function house() {
        return $this->state(fn (array $attributes) => ['property_type_id' => 4]);
    }
}
