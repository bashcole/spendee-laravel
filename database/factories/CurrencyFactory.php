<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Currency>
 */
class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $items = [
            [
                'name' => 'Bulgarian Lev',
                'symbol' => 'лв',
                'alphabeticCode' => 'BGN',
            ],
            [
                'name' => 'Euro',
                'symbol' => '€',
                'alphabeticCode' => 'EUR',
            ],
            [
                'name' => 'US Dollar',
                'symbol' => '$',
                'alphabeticCode' => 'USD',
            ]
        ];

        $item = $items[array_rand($items)];

        return [
            'name' => $item['name'],
            'symbol' => $item['symbol'],
            'alphabeticCode' => $item['alphabeticCode']
        ];
    }
}
