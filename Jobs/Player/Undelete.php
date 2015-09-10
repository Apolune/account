<?php

namespace Apolune\Account\Jobs\Player;

use App\Jobs\Job;
use Apolune\Contracts\Account\Player;
use Illuminate\Contracts\Bus\SelfHandling;
use Apolune\Account\Events\Player\Undeleted;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Apolune\Account\Jobs\Action\UnterminateAccount;

class Undelete extends Job implements SelfHandling
{
    use DispatchesJobs;

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
        $this->player->load('account', 'account.properties');

        $this->player->properties->deletion = null;
        $this->player->properties->save();

        if ($account = $this->player->account and $account->isDeleted()) {
            $this->dispatch(
                new UnterminateAccount($account)
            );
        }

        event(new Undeleted($this->player));

        return $this->player;
    }
}
