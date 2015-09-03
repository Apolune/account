<?php

namespace Apolune\Account\Listeners;

use Apolune\Account\Events\Email;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewEmailConfirmation
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
     * @param  \Apolune\Account\Events\Email\RequestAccepted  $event
     * @return void
     */
    public function handle(Email\RequestAccepted $event)
    {
        list($account, $password) = [$event->account, $event->password];

        $this->mailer->send('theme::_emails.new-email', compact('account', 'password'), function ($message) use ($account) {
            $message->to($account->email());
            $message->subject(
                trans('theme::_emails/new-email.title', ['server' => server()->name()])
            );
        });
    }
}
