<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Payment;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Detail>
 */
class DetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $payment = Payment::inRandomOrder()->first();

        return [
            'user_id' => fake()->randomElement($users_id),
            'payment_id' => $payment->_id,
            'price' => $payment->value,
            'detail' => fake()->sentence(),
            'date' => $payment->created_at->format('Y-m-d'),
        ];
    }
}
