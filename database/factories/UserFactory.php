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
         $regions = ['north_gaza', 'gaza', 'central', 'khan_younis', 'rafah'];
        
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'whatsapp' => $this->faker->randomElement(['059', '056']) . $this->faker->numerify('#######'),
            'region' => $this->faker->randomElement($regions),
            'university' => $this->faker->optional()->company(),
            'remember_token' => Str::random(10),
        ];
    }
}