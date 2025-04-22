<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\InsuranceType;
use App\Models\Property;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Insurance>
 */
class InsuranceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $owner = User::where('role_id', 2)->inRandomOrder()->first()->id;

        $types_id = InsuranceType::pluck('id')->toArray();

        $properties_id = Property::pluck('id')->toArray();


        return [
            'name' => fake()->name(),
            'phone' => fake()->unique()->regexify('[67][0-9]{8}'),
            'price' => fake()->numberBetween(100, 800),
            'policy' => fake()->numberBetween(100000, 999999),
            'owner' => $owner,
            'description' => fake()->sentence(),
            'property_id' => fake()->randomElement($properties_id),
            'insurance_type_id' => fake()->randomElement($types_id),
        ];
    }
}
