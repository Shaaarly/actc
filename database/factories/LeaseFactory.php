<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Property;
use App\Models\Lease;
use App\Models\PaymentType;
use Carbon\Carbon;

/**
 * @extends Factory<Lease>
 */
class LeaseFactory extends Factory
{
    protected static $properties;

    public function definition(): array
    {
        $payments_id = PaymentType::pluck('id')->toArray();

        if (static::$properties === null) {
            static::$properties = Property::with(['address', 'type'])
                                         ->get()
                                         ->shuffle()
                                         ->all();
        }

        $property = array_shift(static::$properties)
                  ?? Property::with(['address', 'type'])
                             ->inRandomOrder()
                             ->first();

        $startDate = $this->faker->dateTimeBetween('-1 year', 'now');
        $endDate   = $this->faker->dateTimeBetween($startDate, '+1 year');
        $active    = ! $property->available;

        return [
            'property_id'      => $property->id,
            'client_id'        => User::where('role_id', 1)->inRandomOrder()->first()->id,
            'owner_id'         => User::where('role_id', 2)->inRandomOrder()->first()->id,
            'original_lease_id'=> null,
            'keys_returned'    => $this->faker->boolean(30),
            'remote_returned'  => $this->faker->boolean(40),
            'active'           => $active,
            'renewal'          => false,
            'start_lease'      => $startDate,
            'ending_lease'     => $endDate,
            'value'            => $this->faker->numberBetween(300, 1500),
            'payment_type_id'  => $this->faker->randomElement($payments_id),
        ];
    }

    /**
     * Crea un lease que sea renovación de otro.
     *
     * @param  Lease  $parent
     * @return static
     */
    public function renewalOf(Lease $parent)
    {
        return $this->state(function () use ($parent) {
            $start = Carbon::parse($parent->ending_lease)->addDay();
            $end = Carbon::parse($start)->addMonths(rand(1, 12));

            return [
                'property_id'      => $parent->property_id,
                'client_id'        => $parent->client_id,
                'owner_id'         => $parent->owner_id,
                'original_lease_id'=> $parent->id,
                'renewal'          => true,
                'start_lease'      => $start,
                'ending_lease'     => $end,
                'value'            => $parent->value,
                'payment_type_id'  => $parent->payment_type_id,
                'keys_returned'    => false,
                'remote_returned'  => false,
                'active'           => true,
            ];
        });
    }
}
