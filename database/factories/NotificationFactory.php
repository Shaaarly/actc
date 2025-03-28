<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\NotificationType;
use App\Models\Payment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
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
        
        $notifications_type_id = NotificationType::pluck('id')->toArray();

        return [
            'notification_type_id' => fake()->randomElement($notifications_type_id),
            'payment_id' => array_shift($payments_id)
        ];
    }
}
