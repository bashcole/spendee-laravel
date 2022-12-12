<?php

use App\Models\Currency;
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
    public function up(): void
    {
        Currency::insertOrIgnore(
            [
                [
                    'alphabeticCode' => 'BGN',
                    'name'           => 'Bulgarian Lev',
                    'symbol'         => 'лв'
                ],
                [
                    'alphabeticCode' => 'EUR',
                    'name'           => 'Euro',
                    'symbol'         => '€'
                ],
                [
                    'alphabeticCode' => 'USD',
                    'name'           => 'US Dollar',
                    'symbol'         => '$'
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        //
    }
};
