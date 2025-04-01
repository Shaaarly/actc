<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Payment;

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

        static $payments_id = null;

        if ($payments_id === null) {
            $payments_id = Payment::pluck('id')->shuffle()->toArray();
        }

        return [ 
            'payment_id' => array_shift($payments_id),
            'source' => fake()->imageUrl()
        ];
    }
}
