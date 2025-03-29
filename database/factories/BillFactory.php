<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Detail;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        static $details_id = null;

        if ($details_id === null) {
            $details_id = Detail::pluck('id')->shuffle()->toArray();
        }

        return [ 
            'detail_id' => array_shift($details_id),
            'source' => fake()->imageUrl()
        ];
    }
}
