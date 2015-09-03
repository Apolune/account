<?php

namespace Apolune\Account\Events\Player;

use App\Events\Event;
use Apolune\Contracts\Account\Player;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Deleted extends Event
{
    use SerializesModels;

    /**
     * Holds the player implementation.
     *
     * @var \Apolune\Contracts\Account\Player
     */
    public $player;

    /**
     * Create a new event instance.
     *
     * @param  \Apolune\Contracts\Account\Player  $player
     * @return void
     */
    public function __construct(Player $player)
    {
        $this->player = $player;
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
