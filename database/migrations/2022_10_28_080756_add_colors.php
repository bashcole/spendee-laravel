<?php

use App\Models\Color;
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
        Color::insertOrIgnore(
            [
                ['id' => '1','hex' => '#f5534b'],
                ['id' => '2','hex' => '#b55a42'],
                ['id' => '3','hex' => '#b47b55'],
                ['id' => '4','hex' => '#d35e00'],
                ['id' => '5','hex' => '#de8135'],
                ['id' => '6','hex' => '#df8c29'],
                ['id' => '7','hex' => '#b9965e'],
                ['id' => '8','hex' => '#ffa200'],
                ['id' => '9','hex' => '#ffa800'],
                ['id' => '10','hex' => '#ffcc00'],
                ['id' => '11','hex' => '#bed940'],
                ['id' => '12','hex' => '#71c643'],
                ['id' => '13','hex' => '#18b272'],
                ['id' => '14','hex' => '#5cc5ac'],
                ['id' => '15','hex' => '#60cfcb'],
                ['id' => '16','hex' => '#1eadce'],
                ['id' => '17','hex' => '#1a94ca'],
                ['id' => '18','hex' => '#47a7e6'],
                ['id' => '19','hex' => '#3d75ab'],
                ['id' => '20','hex' => '#659dd6'],
                ['id' => '21','hex' => '#6e8cb1'],
                ['id' => '22','hex' => '#66686b'],
                ['id' => '23','hex' => '#61708c'],
                ['id' => '24','hex' => '#6d6e89'],
                ['id' => '25','hex' => '#7945d0'],
                ['id' => '26','hex' => '#e26beb'],
                ['id' => '27','hex' => '#f963a0'],
                ['id' => '28','hex' => '#e56274'],
                ['id' => '29','hex' => '#5dc6ad'],
                ['id' => '30','hex' => '#b47b55']
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
