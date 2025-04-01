<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Property;
use App\Models\Lease;

/**
 * @extends Factory<Lease>
 */
class LeaseFactory extends Factory
{
    protected static $properties_id;

    public function definition(): array
    {

        if (empty(static::$properties_id)) {
            static::$properties_id = Property::pluck('id')->shuffle()->toArray();
        }

        $property_id = array_shift(static::$properties_id) ?? Property::inRandomOrder()->first()->id;

        $startDate = fake()->dateTimeBetween('-1 year', 'now');
        $endDate = fake()->dateTimeBetween($startDate, '+1 year');

        return [
            'property_id'     => $property_id,
            'client_id' => User::where('role_id', 1)->inRandomOrder()->first()->id ?? User::factory()->create(['role_id' => 1])->id,
            'owner_id' => User::where('role_id', 2)->inRandomOrder()->first()->id ?? User::factory()->create(['role_id' => 2])->id,
            'keys_returned'   => fake()->boolean(30),
            'remote_returned' => fake()->boolean(40),
            'start_lease'     => $startDate,
            'ending_lease'    => $endDate,
            'value'           => fake()->numberBetween(300, 1500),
        ];
    }
}
