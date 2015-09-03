<?php

namespace Apolune\Account\Events\Player;

use App\Events\Event;
use Apolune\Contracts\Account\Player;
use Apolune\Contracts\Account\Account;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Created extends Event
{
    use SerializesModels;

    /**
     * Holds the player implementation.
     *
     * @var \Apolune\Contracts\Account\Player
     */
    public $player;

    /**
     * Holds the account implementation.
     *
     * @var \Apolune\Contracts\Account\Account
     */
    public $account;

    /**
     * Create a new event instance.
     *
     * @param  \Apolune\Contracts\Account\Player  $player
     * @param  \Apolune\Contracts\Account\Account  $account
     * @return void
     */
    public function __construct(Player $player, Account $account)
    {
        $this->player = $player;
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
