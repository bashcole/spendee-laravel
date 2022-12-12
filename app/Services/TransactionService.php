<?php

namespace App\Services;

use App\Events\TransactionCreatedEvent;
use App\Models\Transaction;

class TransactionService
{

    /**
     * @param array $data
     * @return Transaction
     */
    public function create(array $data): Transaction
    {
        $transaction = Transaction::create(
            [
                'amount' => $data["amount"],
                'note' => $data["note"],
                'wallet_id' => $data["wallet_id"],
                'category_id' => $data["category_id"],
                'created_at' => $data["created_at"],
            ]
        );
        TransactionCreatedEvent::dispatch($transaction);
        return $transaction;
    }

    /**
     * @param array $data
     * @return void
     */
    public function update(array $data): void
    {
        Transaction::find($data["id"])->update(
            [
                'amount' => $data["amount"],
                'note' => $data["note"],
                'category_id' => $data["category_id"],
                'created_at' => $data["created_at"]
            ]
        );
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        Transaction::find($id)->delete();
    }

}
