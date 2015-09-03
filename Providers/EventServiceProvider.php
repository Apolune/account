<?php

namespace Apolune\Account\Providers;

use Apolune\Account\Events;
use Apolune\Account\Listeners;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Events\Auth\Created::class => [
            Listeners\SendVerificationEmail::class,
        ],
        Events\Email\UnconfirmedAccount::class => [
            Listeners\SendVerificationEmail::class,
        ],
        Events\Email\VerificationCodeRequested::class => [
            Listeners\SendVerificationEmail::class,
        ],
        Events\Email\RequestAccepted::class => [
            Listeners\SendNewEmailConfirmation::class,
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
