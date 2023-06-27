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
    public function definition()
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'family_name' => fake()->lastName(),
            'given_name' => fake()->firstName(),
            'family_name_kana' => fake()->lastKanaName(),
            'given_name_kana' => fake()->firstKanaName(),
            'birthday' => fake()->dateTimeBetween('-80 years', '-20years')->format('Y-m-d'),
            'phone_number' => '0300000000',
            'zip_code' => fake()->postcode(),
            'prefecture' => fake()->prefecture(),
            'city' => fake()->city(),
            'block' => fake()->streetAddress(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
