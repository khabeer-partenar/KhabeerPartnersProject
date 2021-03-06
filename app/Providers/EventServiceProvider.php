<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use \Modules\Committee\Events\CommitteeCreatedEvent;
use Modules\Committee\Events\NominationDoneEvent;
use Modules\Committee\Listeners\CommitteeCreatedListener;
use Modules\Committee\Listeners\NominationDoneListener;
use \Modules\Users\Events\DelegateCreatedEvent;
use Modules\Users\Events\DelegateDeletedEvent;
use Modules\Users\Events\DelegateUpdatedEvent;
use Modules\Users\Listeners\DelegateCreatedListener;
use Modules\Users\Listeners\DelegateDeletedListener;
use Modules\Users\Listeners\DelegateDepartmentChangedListener;
use Modules\Users\Notifications\DelegateDepartmentChangedNotification;
use Aacotroneo\Saml2\Events\Saml2LoginEvent;
use Aacotroneo\Saml2\Events\Saml2LogoutEvent;
use App\Listeners\Saml2LoginListener;
use App\Listeners\Saml2LogoutListener;

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
        ],
        DelegateUpdatedEvent::class => [
            DelegateDepartmentChangedListener::class
        ],
        DelegateDeletedEvent::class => [
            DelegateDeletedListener::class
        ],
        Saml2LoginEvent::class => [
            Saml2LoginListener::class,
        ],
        Saml2LogoutEvent::class => [
            Saml2LogoutListener::class,
        ],
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
