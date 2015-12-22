<?php

namespace Apolune\Account\Jobs\Action;

use App\Jobs\Job;
use Apolune\Contracts\Account\Account;
use Apolune\Account\Events\Action\UnterminatedAccount;
use Apolune\Account\Jobs\Player\Delete as DeletePlayer;

class UnterminateAccount extends Job
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
     * @return \Apolune\Contracts\Account\Account|null
     */
    public function handle()
    {
        $this->account->properties->deleted = '0000-00-00 00:00:00';
        $this->account->properties->save();

        event(new UnterminatedAccount($this->account));

        return $this->account;
    }
}
