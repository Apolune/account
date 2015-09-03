<?php

namespace Apolune\Account\Events\Email;

use App\Events\Event;
use Apolune\Contracts\Account\Account;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RequestAccepted extends Event
{
    use SerializesModels;

    /**
     * Holds the account implementation.
     *
     * @var \Apolune\Contracts\Account\Account
     */
    public $account;

    /**
     * Holds the new password.
     *
     * @var string
     */
    public $password;

    /**
     * Create a new event instance.
     *
     * @param  \Apolune\Contracts\Account\Account  $account
     * @param  string  $password
     * @return void
     */
    public function __construct(Account $account, $password)
    {
        $this->account = $account;
        $this->password = $password;
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
