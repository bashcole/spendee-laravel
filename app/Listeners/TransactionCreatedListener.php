<?php

namespace App\Listeners;

use App\Events\TransactionCreatedEvent;
use Log;

class TransactionCreatedListener
{
    public function __construct()
    {
    }

    public function handle(TransactionCreatedEvent $event): void
    {
        Log::info($event->transaction);
    }
}
