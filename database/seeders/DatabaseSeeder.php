<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Color;
use App\Models\Currency;
use App\Models\Icon;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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

        Wallet::factory()->create([
            'name' => "Trips",
            'balance' => 0
        ]);

        Wallet::factory()->create([
            'name' => "Fund",
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

        $wallets = Wallet::all();

        Transaction::factory(3)->create([
            'wallet_id' => $wallets[0]
        ]);

        Transaction::factory(3)->create([
            'wallet_id' => $wallets[1]
        ]);

        Transaction::factory(3)->create([
            'wallet_id' => $wallets[2]
        ]);
    }
}
