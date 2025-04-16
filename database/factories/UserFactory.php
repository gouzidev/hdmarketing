<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'verified_at' => fake()->boolean(75) ? now() : null, // 75% chance of being verified
            'remember_token' => Str::random(10),
            'phone' => fake()->phoneNumber(),
            'city' => fake()->city(),
            'country' => fake()->countryCode(),
            'is_admin' => fake()->boolean(10) ? true : false,
            'verified' => fake()->boolean(),
        ];
    }

    // State for admin users
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_admin' => true,
        ]);
    }

    // State for unverified users
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'verified' => false,
            'verified_at' => null,
        ]);
    }
}
