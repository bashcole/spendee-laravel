<?php

use App\Models\Language;
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

        Language::insertOrIgnore(
            [
                [
                    'id'   => 1,
                    'abbr' => 'bg'
                ],
                [
                    'id'   => 2,
                    'abbr' => 'en'
                ],
                [
                    'id'   => 3,
                    'abbr' => 'fr'
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
