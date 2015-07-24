<?php

namespace Apolune\Account\Listeners;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Apolune\Account\Events\RequestVerificationEmail;

class SendVerificationEmail
{
    /**
     * Holds the mailer implementation.
     *
     * @var \Illuminate\Contracts\Mail\Mailer
     */
    protected $mailer;

    /**
     * Create the event listener.
     *
     * @param  \Illuminate\Contracts\Mail\Mailer  $mailer
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  \Apolune\Account\Events\RequestVerificationEmail  $event
     * @return void
     */
    public function handle(RequestVerificationEmail $event)
    {
        $account = $event->account();

        $this->mailer->send('theme::emails.verification', compact('account'), function ($message) use ($account) {
            $message->to($account->email());
            $message->subject('Testing');
        });
    }
}
