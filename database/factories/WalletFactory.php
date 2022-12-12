<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wallet>
 */
class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => \Str::ucfirst(fake()->word()),
            'user_id' => User::inRandomOrder()->first()->id,
            'currency_id' => Currency::inRandomOrder()->first()->id,
            'sort' => fake()->randomDigit(),
            'balance' => fake()->randomNumber(),
            'status' => 'active',
        ];
    }
}
