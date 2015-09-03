<?php

namespace Apolune\Account\Jobs\Player;

use App\Jobs\Job;
use Carbon\Carbon;
use Apolune\Contracts\Account\Player;
use Apolune\Account\Events\Player\Deleted;
use Illuminate\Contracts\Bus\SelfHandling;

class Delete extends Job implements SelfHandling
{
    /**
     * Holds the player implementation.
     *
     * @var \Apolune\Contracts\Account\Player
     */
    protected $player;

    /**
     * Create a new job instance.
     *
     * @param  \Apolune\Contracts\Account\Player  $player
     * @return void
     */
    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    /**
     * Execute the job.
     *
     * @return \Apolune\Contracts\Account\Player|null
     */
    public function handle()
    {
        $this->player->properties->deletion = Carbon::now();
        $this->player->properties->save();

        event(new Deleted($this->player));

        return $this->player;
    }
}
