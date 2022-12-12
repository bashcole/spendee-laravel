<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Services\TransactionService;
use Database\Seeders\TestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionAmountTest extends TestCase
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
    public function test_transaction_amount_with_income_type()
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

        $transaction = Transaction::first();
        $this->assertEquals(100, $transaction->amount);
    }

    /**
     * @return void
     */
    public function test_transaction_amount_with_expense_type()
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

        $transaction = Transaction::first();
        $this->assertEquals(100, $transaction->amount);
    }

    /**
     * @return void
     */
    public function test_transaction_amount_with_mix_type()
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

        $transaction = Transaction::first();
        $this->assertEquals(100, $transaction->amount);
    }
}
