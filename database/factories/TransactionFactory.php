<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Currency;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'wallet_id' => Wallet::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'amount' => rand(2,100)
        ];
    }
}
