<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Property;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'postal_code'      => fake()->regexify('[0-9]{5}'),
            'city'             => fake()->city(),
            'province'         => fake()->state(),
            'street_name'      => fake()->streetAddress(),
            'passageway'       => fake()->secondaryAddress(),
            'building_number'  => fake()->numberBetween(1, 255),
            'floor'            => fake()->numberBetween(1, 14),
            'block'            => fake()->regexify('[A-E]'),
            'number' => fake()->numberBetween(1, 40),
            'country'          => fake()->country()
        ];
    }

    /**
     * Asigna la dirección a un usuario (relación polimórfica)
     */
    public function forUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'addressable_type' => 'user',
            'addressable_id' => $user->id,
        ]);
    }

    /**
     * Asigna la dirección a una propiedad (relación polimórfica)
     */
    public function forProperty(Property $property): static
    {
        return $this->state(fn (array $attributes) => [
            'addressable_type' => 'property',
            'addressable_id' => $property->id,
        ]);
    }
}
