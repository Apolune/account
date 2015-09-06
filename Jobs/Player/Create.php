<?php

namespace Apolune\Account\Jobs\Player;

use App\Jobs\Job;
use Illuminate\Http\Request;
use Apolune\Contracts\Account\Account;
use Apolune\Account\Events\Player\Created;
use Illuminate\Contracts\Bus\SelfHandling;

class Create extends Job implements SelfHandling
{
    /**
     * Holds the account implementation.
     *
     * @var \Apolune\Contracts\Account\Account
     */
    protected $account;

    /**
     * Create a new job instance.
     *
     * @param  \Apolune\Contracts\Account\Account  $account
     * @return void
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    /**
     * Execute the job.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Apolune\Contracts\Account\Player|null
     */
    public function handle(Request $request)
    {
        $player = app('player');

        $player->name       = ucwords(strtolower($request->get('player')));
        $player->account_id = $this->account->id();
        $player->vocation   = $request->get('vocation', vocations(true)->first()->id());
        $player->town_id    = $request->get('town', towns(true)->first()->id());
        $player->world_id   = $request->get('world', worlds()->first()->id());
        $player->sex        = $request->get('sex', genders()->first()->id());
        $player->conditions = '';
        
        $player->save();

        event(new Created($player, $this->account));

        return $player;
    }
}
