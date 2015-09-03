<?php

namespace Apolune\Account\Events\Email;

use App\Events\Event;
use Apolune\Contracts\Account\Account;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UnconfirmedAccount extends Event
{
    use SerializesModels;

    /**
     * Holds the account implementation.
     *
     * @var \Apolune\Contracts\Account\Account
     */
    public $account;

    /**
     * Create a new event instance.
     *
     * @param  \Apolune\Contracts\Account\Account  $account
     * @return void
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
