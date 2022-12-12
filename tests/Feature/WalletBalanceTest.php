<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use App\Services\TransactionService;
use Database\Seeders\TestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class WalletBalanceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var bool
     */
    protected bool $seed = true;

    /**
     * @var string
     */
    protected $seeder = TestSeeder::class;

    /**
     * @return void
     */
    public function test_wallet_balance_with_income_transaction()
    {
        $wallets = Wallet::all();

        $transactionService = new TransactionService();

        $transactionService->create([
            'amount' => 100,
            'note' => "",
            'wallet_id' => $wallets[0]->id,
            'category_id' => Category::where('type', 'income')->first()->id,
            'created_at' => now(),
        ]);

        $wallet = Wallet::find($wallets[0]->id);
        $this->assertEquals(100, $wallet->balance);

    }

    /**
     * @return void
     */
    public function test_wallet_balance_with_expense_transaction()
    {

        $wallets = Wallet::all();

        $transactionService = new TransactionService();

        $transactionService->create([
            'amount' => 100,
            'note' => "",
            'wallet_id' => $wallets[0]->id,
            'category_id' => Category::where('type', 'expense')->first()->id,
            'created_at' => now(),
        ]);

        $wallet = Wallet::find($wallets[0]->id);
        $this->assertEquals(-100, $wallet->balance);

    }

    /**
     * @return void
     */
    public function test_wallet_balance_with_mix_transaction()
    {

        $wallets = Wallet::all();

        $transactionService = new TransactionService();

        $transaction = $transactionService->create([
            'amount' => 400,
            'note' => "",
            'wallet_id' => $wallets[0]->id,
            'category_id' => Category::where('type', 'income')->first()->id,
            'created_at' => now(),
        ]);

        $transactionService->update([
            'id' => $transaction->id,
            'amount' => 100,
            'note' => "",
            'category_id' => Category::where('type', 'expense')->first()->id,
            'created_at' => now()
        ]);

        $wallet = Wallet::find($wallets[0]->id);
        $this->assertEquals(-100, $wallet->balance);

    }
}
