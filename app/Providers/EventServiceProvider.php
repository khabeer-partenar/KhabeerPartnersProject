<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use \Modules\Committee\Events\CommitteeCreatedEvent;
use Modules\Committee\Listeners\CommitteeCreatedListener;
use \Modules\Users\Events\DelegateCreatedEvent;
use Modules\Users\Listeners\DelegateCreatedListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CommitteeCreatedEvent::class => [
            CommitteeCreatedListener::class
        ],
        DelegateCreatedEvent::class => [
            DelegateCreatedListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
