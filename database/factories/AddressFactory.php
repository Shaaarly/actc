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
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $addressable_types = [];
        $addressable_ids = [];
    
        $users_id = User::pluck('id')->unique()->toArray();
        $properties_id = Property::pluck('id')->unique()->toArray();

        static $addressable_options = [];

        foreach ($users_id as $user_id) {
            $addressable_options[] = ['type' => 'user', 'id' => $user_id];
        }
        foreach ($properties_id as $property_id) {
            $addressable_options[] = ['type' => 'property', 'id' => $property_id];
        }

        $option = array_shift($addressable_options);
        $addressable_type = $option['type'];
        $addressable_id = $option['id'];

    
        return [
            'addressable_type' => $addressable_type,
            'addressable_id'   => $addressable_id,
            'postal_code'      => fake()->regexify('[0-9]{5}'),
            'city'             => fake()->city(),
            'province'         => fake()->state(),
            'street_name'      => fake()->streetAddress(),
            'passageway'       => fake()->streetAddress(),
            'entrance_number'  => fake()->numberBetween(1, 255),
            'floor'            => fake()->numberBetween(1, 14),
            'block'            => fake()->regexify('[A-E]{1}'),
            'apartment_number' => fake()->numberBetween(1, 40),
            'country'          => fake()->country()
        ];
    }

}
