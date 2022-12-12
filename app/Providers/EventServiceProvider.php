<?php

namespace App\Providers;

use App\Events\TransactionCreatedEvent;
use App\Listeners\TransactionCreatedListener;
use App\Models\Transaction;
use App\Observers\TransactionObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        TransactionCreatedEvent::class => [
            TransactionCreatedListener::class
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * The model observers for your application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $observers = [
        Transaction::class => [
            TransactionObserver::class
        ]
    ];

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
