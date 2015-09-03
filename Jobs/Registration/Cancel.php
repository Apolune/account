<?php

namespace Apolune\Account\Jobs\Registration;

use App\Jobs\Job;
use Apolune\Contracts\Account\Account;
use Illuminate\Contracts\Bus\SelfHandling;
use Apolune\Account\Events\Registration\Cancelled;

class Cancel extends Job implements SelfHandling
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
        $this->account->registration->request_date      = null;
        $this->account->registration->request_firstname = null;
        $this->account->registration->request_surname   = null;
        $this->account->registration->request_country   = null;

        $this->account->registration->save();

        event(new Cancelled($this->account));

        return $this->account;
    }
}
