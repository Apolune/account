<?php

namespace Apolune\Account\Jobs\Player;

use App\Jobs\Job;
use Illuminate\Http\Request;
use Apolune\Contracts\Account\Player;
use Apolune\Account\Events\Player\Edited;
use Illuminate\Contracts\Bus\SelfHandling;

class Edit extends Job implements SelfHandling
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Apolune\Contracts\Account\Player|null
     */
    public function handle(Request $request)
    {
        $this->player->properties->hide       = (boolean) $request->get('hide');
        $this->player->properties->comment    = $request->get('comment');
        $this->player->properties->signature  = $request->get('signature');
        $this->player->properties->save();

        event(new Edited($this->player));

        return $this->player;
    }
}
