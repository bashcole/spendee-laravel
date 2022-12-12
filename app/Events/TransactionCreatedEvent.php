<?php

namespace App\Events;

use App\Models\Transaction;
use Illuminate\Foundation\Events\Dispatchable;

class TransactionCreatedEvent
{
    use Dispatchable;

    public Transaction $transaction;

    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }
}
