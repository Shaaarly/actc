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

        static $users_id = null;

        if ($users_id === null) {
            $users_id = User::pluck('id')->shuffle()->toArray();
        }

        $payment = Payment::inRandomOrder()->first();

        return [
            'user_id' => array_shift($users_id),
            'payment_id' => $payment->id,
            'price' => $payment->value,
            'detail' => fake()->sentence(),
            'date' => $payment->created_at->format('Y-m-d'),
        ];
    }
}
