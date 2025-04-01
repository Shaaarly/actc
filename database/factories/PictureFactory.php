<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Property;

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
        
        return [
            'source' => fake()->imageUrl()
        ];

    }
    
}
