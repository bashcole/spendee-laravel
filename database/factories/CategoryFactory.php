<?php

namespace Database\Factories;

use App\Models\Color;
use App\Models\Icon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $types = [
            0 => [
                "names" => [
                    "Подаръци", "Заплата"
                ],
                "type" => "income"
            ],
            1 => [
                "names" => ["Храна",
                    "Забавления",
                    "Транспорт",
                    "Сметки",
                    "Заведения",
                ],
                 "type" => "expense"
            ]
        ];

        $type = $types[array_rand($types)];

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'color_id' => Color::inRandomOrder()->first()->id,
            'icon_id' => Icon::inRandomOrder()->first()->id,
            'name' => fake()->randomElement($type["names"]),
            'type' => $type["type"],
        ];
    }
}
