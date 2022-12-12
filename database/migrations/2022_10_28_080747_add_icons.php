<?php

use App\Models\Icon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Icon::insert(
            [
                [
                    "id"       => 1,
                    "filename" => "car.svg"
                ],
                [
                    "id"       => 2,
                    "filename" => "plane.svg"
                ],
                [
                    "id"       => 3,
                    "filename" => "food.svg"
                ],
                [
                    "id"       => 4,
                    "filename" => "personal.svg"
                ],
                [
                    "id"       => 5,
                    "filename" => "money.svg"
                ],
                [
                    "id"       => 6,
                    "filename" => "entertainment.svg"
                ],
                [
                    "id"       => 7,
                    "filename" => "house.svg"
                ],
                [
                    "id"       => 8,
                    "filename" => "energy.svg"
                ],
                [
                    "id"       => 9,
                    "filename" => "shopping.svg"
                ],
                [
                    "id"       => 11,
                    "filename" => "healthcare.svg"
                ],
                [
                    "id"       => 12,
                    "filename" => "other.svg"
                ],
                [
                    "id"       => 13,
                    "filename" => "clothes.svg"
                ],
                [
                    "id"       => 14,
                    "filename" => "transport.svg"
                ],
                [
                    "id"       => 15,
                    "filename" => "grocery.svg"
                ],
                [
                    "id"       => 16,
                    "filename" => "drinks.svg"
                ],
                [
                    "id"       => 17,
                    "filename" => "sport.svg"
                ],
                [
                    "id"       => 18,
                    "filename" => "pets.svg"
                ],
                [
                    "id"       => 19,
                    "filename" => "education.svg"
                ],
                [
                    "id"       => 20,
                    "filename" => "cinema.svg"
                ],
                [
                    "id"       => 21,
                    "filename" => "love.svg"
                ],
                [
                    "id"       => 22,
                    "filename" => "train.svg"
                ],
                [
                    "id"       => 23,
                    "filename" => "rent.svg"
                ],
                [
                    "id"       => 24,
                    "filename" => "itunes.svg"
                ],
                [
                    "id"       => 25,
                    "filename" => "wallet.svg"
                ],
                [
                    "id"       => 26,
                    "filename" => "gift.svg"
                ],
                [
                    "id"       => 27,
                    "filename" => "business.svg"
                ],
                [
                    "id"       => 28,
                    "filename" => "budget.svg"
                ],
                [
                    "id"       => 29,
                    "filename" => "gym.svg"
                ],
                [
                    "id"       => 30,
                    "filename" => "phone.svg"
                ],
                [
                    "id"       => 31,
                    "filename" => "coffee.svg"
                ],
                [
                    "id"       => 32,
                    "filename" => "gas.svg"
                ],
                [
                    "id"       => 33,
                    "filename" => "parking.svg"
                ],
                [
                    "id"       => 35,
                    "filename" => "cigarets.svg"
                ],
                [
                    "id"       => 36,
                    "filename" => "book.svg"
                ],
                [
                    "id"       => 37,
                    "filename" => "playstore.svg"
                ],
                [
                    "id"       => 38,
                    "filename" => "tools.svg"
                ],
                [
                    "id"       => 39,
                    "filename" => "motorbike.svg"
                ],
                [
                    "id"       => 40,
                    "filename" => "eshopping.svg"
                ],
                [
                    "id"       => 41,
                    "filename" => "computer.svg"
                ],
                [
                    "id"       => 42,
                    "filename" => "haircut.svg"
                ],
                [
                    "id"       => 43,
                    "filename" => "apple.svg"
                ],
                [
                    "id"       => 44,
                    "filename" => "card.svg"
                ],
                [
                    "id"       => 45,
                    "filename" => "subscription.svg"
                ],
                [
                    "id"       => 46,
                    "filename" => "washingmachine.svg"
                ],
                [
                    "id"       => 47,
                    "filename" => "pricetag.svg"
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
