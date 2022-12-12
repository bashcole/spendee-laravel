<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\Log;

class TransactionObserver
{
    /**
     * Handle the Transaction "creating" event.
     *
     * @param Transaction $transaction
     * @return void
     */
    public function creating(Transaction $transaction): void
    {
        $query = Wallet::find($transaction->wallet_id);

        if ($transaction->category->type === 'income') {
            $query->increment('balance', $transaction->amount);
        } else {
            $query->decrement('balance', $transaction->amount);
        }

    }

    /**
     * Handle the Transaction "updated" event.
     *
     * @param  Transaction $transaction
     * @return void
     */
    public function updated(Transaction $transaction): void
    {
        $query = Wallet::find($transaction->wallet_id);

        $old = $transaction->getOriginal();
        $oldCategory = Category::find($old['category_id']);

        if ($oldCategory->type === 'income') {
            $query->decrement('balance', $old['amount']);
        } else {
            $query->increment('balance', $old['amount']);
        }

        $newCategory = Category::find($transaction->category_id);

        if ($newCategory->type === 'income') {
            $query->increment('balance', $transaction->amount);
        } else {
            $query->decrement('balance', $transaction->amount);
        }
    }

    /**
     * Handle the Transaction "deleted" event.
     *
     * @param  Transaction $transaction
     * @return void
     */
    public function deleted(Transaction $transaction): void
    {
        $query = Wallet::find($transaction->wallet_id);

        if ($transaction->category->type === 'income') {
            $query->decrement('balance', $transaction->amount);
        } else {
            $query->increment('balance', $transaction->amount);
        }
    }
}
