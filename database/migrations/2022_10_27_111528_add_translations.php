<?php

use App\Models\Translation;
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
        Translation::insertOrIgnore(
            [
                [
                    'language_id' => 1,
                    'key'         => 'Wallets',
                    'value'       => 'Портфейли'
                ],
                [
                    'language_id' => 1,
                    'key'         => 'Add New Wallet',
                    'value'       => 'Добави нов портфейл'
                ],
                [
                    'language_id' => 1,
                    'key'         => 'Total Balance',
                    'value'       => 'Общо'
                ],
                [
                    'language_id' => 1,
                    'key'         => 'Total Period Change',
                    'value'       => 'Общо промяна за период'
                ],
                [
                    'language_id' => 1,
                    'key'         => 'Total Period Expenses',
                    'value'       => 'Общо разходи за период'
                ],
                [
                    'language_id' => 1,
                    'key'         => 'Total Period Income',
                    'value'       => 'Общо доходи за период'
                ],
                [
                    'language_id' => 1,
                    'key'         => 'Total Change',
                    'value'       => 'Общо промяна'
                ],
                [
                    'language_id' => 1,
                    'key'         => 'Total Expenses',
                    'value'       => 'Общо разходи'
                ],
                [
                    'language_id' => 1,
                    'key'         => 'Total Income',
                    'value'       => 'Общо доходи'
                ],
                [
                    'language_id' => 1,
                    'key'         => 'Overview',
                    'value'       => 'Общ преглед'
                ],
                [
                    'language_id' => 1,
                    'key'         => 'Dashboard',
                    'value'       => 'Дашбоард'
                ],
                [
                    'language_id' => 1,
                    'key'         => 'Graph',
                    'value'       => 'Графика'
                ],
                [
                    'language_id' => 3,
                    'key'         => 'Dashboard',
                    'value'       => 'le Dashboard'
                ],
                [
                    'language_id' => 1,
                    'key'         => 'Email',
                    'value'       => 'Имейл'
                ],
                [
                    'language_id' => 1,
                    'key'         => 'Password',
                    'value'       => 'Парола'
                ],
                [
                    'language_id' => 1,
                    'key'         => 'Remember me',
                    'value'       => 'Запомни ме'
                ],
                [
                    'language_id' => 1,
                    'key'         => 'Forgot your password?',
                    'value'       => 'Забравена парола?'
                ],
                [
                    'language_id' => 1,
                    'key'         => 'Log in',
                    'value'       => 'Вход'
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
