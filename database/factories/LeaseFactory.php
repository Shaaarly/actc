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
        $client_id = User::where('role_id', 1)->pluck('id')->toArray();
        $owner_id = User::where('role_id', 2)->pluck('id')->toArray();
        $property_id = Property::pluck('id')->toArray();

        return [
            'keys_returned' => fake()->boolean(),
            'remote_returned' => fake()->boolean(),
            'description' => fake()->sentence(),
            'amount' => fake()->numberBetween(12, 600),
            'client_id' => fake()->randomElement($client_id),
            'owner_id' => fake()->randomElement($owner_id),
            'property_id' => fake()->unique()->randomElement($property_id),
            'start_date' => fake()->date(),
            'end_date' => fake()->date()
        ];
    }
}
