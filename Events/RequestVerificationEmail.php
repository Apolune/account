<?php

namespace Apolune\Account\Events;

use App\Events\Event;
use Apolune\Contracts\Account\Account;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RequestVerificationEmail extends Event
{
    use SerializesModels;

    /**
     * Holds the account implementation.
     *
     * @var \Apolune\Contracts\Account\Account
     */
    protected $account;

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
     * Retrieve the account implementation.
     *
     * @return \Apolune\Contracts\Account\Account
     */
    public function account()
    {
        return $this->account;
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
