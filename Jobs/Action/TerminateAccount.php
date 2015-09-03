<?php

namespace Apolune\Account\Jobs\Action;

use App\Jobs\Job;
use Carbon\Carbon;
use Apolune\Contracts\Account\Account;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Apolune\Account\Events\Action\TerminatedAccount;
use Apolune\Account\Jobs\Player\Delete as DeletePlayer;

class TerminateAccount extends Job implements SelfHandling
{
    use DispatchesJobs;
    
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
     * @return \Apolune\Contracts\Account\Account|null
     */
    public function handle()
    {
        $this->account->load('players');
        
        $this->account->properties->deleted = Carbon::now();
        $this->account->properties->save();

        foreach ($this->account->players as $player) {
            $this->dispatch(
                new DeletePlayer($player)
            );
        }

        event(new TerminatedAccount($this->account));

        return $this->account;
    }
}
