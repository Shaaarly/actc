<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Property;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lease>
 */
class LeaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $properties_id = null;

        if ($properties_id === null) {
            $properties_id = Property::pluck('id')->shuffle()->toArray();
        }

        return [
            'keys_returned'    => fake()->boolean(),
            'remote_returned'    => fake()->boolean(),
            'start_lease' => fake()->date(),
            'end_lease'   => fake()->date(),
            'property_id' => array_shift($properties_id),
            'client_id'   => User::where('role_id', 1)->pluck('id')->random(),
            'owner_id'    => User::where('role_id', 2)->pluck('id')->random(),
        ];
    }
}
