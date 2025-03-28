<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

// use App\Models\User;
// use App\Models\Property;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Picture>
 */
class PictureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $picturable_types = [];
        // $picturable_ids = [];

        // $users_id = User::pluck('id')->unique()->toArray();
        // $properties_id = Property::pluck('id')->unique()->toArray();

        // static $picturable_options = [];

        // foreach ($users_id as $user_id) {
        //     $picturable_options[] = ['type' => 'user', 'id' => $user_id];
        // }
        // foreach ($properties_id as $property_id) {
        //     $picturable_options[] = ['type' => 'property', 'id' => $property_id];
        // }

        // $option = array_shift($picturable_options);
        // $picturable_type = $option['type'];
        // $picturable_id = $option['id'];


        return [
            'source' => fake()->imageUrl()
        ];

        // public function userPicture() {
        //     return $this->state(fn (array $attributes) => [
        //         'picturable_type' => 'user',
        //         'picturable_id' => 
        //     ]);
        // }

        // public function propertyPicture() {
        //     return $this->state(fn (array $attributes) => [
        //         'picturable_type' => 'property',
        //         'picturable_id' => 
        //     ]);
        // }
    }
}
