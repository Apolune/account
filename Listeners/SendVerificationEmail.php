<?php

namespace Apolune\Account\Listeners;

use Apolune\Account\Events\Email;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
     * @param  mixed  $event
     * @return void
     */
    public function handle($event)
    {
        $account = $event->account;
        $account->load('properties');

        $this->mailer->send('theme::_emails.verification', compact('account'), function ($message) use ($account) {
            $message->to($account->email());
            $message->subject('Testing');
        });
    }
}
