<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'role' => fake()->randomElement(['superAdmin','admin','user','editor']),
            'image' => fake()->imageUrl(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->streetAddress(),
            'gender' => fake()->randomElement(['male' , 'female']),
            'date_of_birth' => fake()->date(),
            'password' => 'password',
            'following' => fake()->numberBetween(2,99999),
            'followers' => fake()->numberBetween(2,99999),
            'following_privacy' =>fake()->boolean(),
            'email_verified_at' => now(),
            'slug' => fake()->unique()->slug()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
