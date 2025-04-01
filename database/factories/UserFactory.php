<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Name;
use App\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names_id = Name::pluck('id')->toArray();
        $roles_id = Role::pluck('id')->toArray();

        return [
            'dni' => fake()->regexify('[0-9]{8}[A-Z]{1}'),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'phone' => fake()->unique()->regexify('[67][0-9]{8}'),
            'role_id' => fake()->randomElement($roles_id),
            'name_id' => fake()->unique()->randomElement($names_id),
            'description' => fake()->sentence()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function client() {
        return $this->state(fn (array $attributes) => ['role_id' => 1]);
    }

    public function owner() {
        return $this->state(fn (array $attributes) => ['role_id' => 2]);
    }

    public function admin() {
        return $this->state(fn (array $attributes) => ['role_id' => 3]);
    }
}
