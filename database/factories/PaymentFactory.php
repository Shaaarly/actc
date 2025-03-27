<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PaymentType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $payments_id = PaymentType::pluck('id')->toArray();
        $status = [
            'completed',
            'pending',
            'incompleted'
        ];

        return [
            'payment_type_id' => fake()->randomElement($payments_id),
            'value' => fake()->numberBetween(12, 600),
            'description' => fake()->sentence(),
            'status' => fake()->randomElement($status)
        ];
    }
}
