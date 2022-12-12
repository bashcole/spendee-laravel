<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'email' => 'me@gmail.com',
            'password' => Hash::make('123456')
        ]);

        Wallet::factory()->create([
            'name' => "Bills",
            'balance' => 0
        ]);

        Category::factory()->create([
            'type' => 'income',
            'name' => 'Salary'
        ]);
        Category::factory()->create([
            'type' => 'income',
            'name' => 'Lottery'
        ]);
        Category::factory()->create([
            'type' => 'expense',
            'name' => 'Bills'
        ]);
        Category::factory()->create([
            'type' => 'expense',
            'name' => 'Trips'
        ]);
    }
}
