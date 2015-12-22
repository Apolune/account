<?php

namespace Apolune\Account\Jobs\Email;

use App\Jobs\Job;
use Apolune\Contracts\Account\Account;
use Apolune\Account\Events\Email\RequestCancelled;

class CancelRequest extends
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
        $this->account->properties->email = null;
        $this->account->properties->email_date = null;
        $this->account->properties->save();

        event(new RequestCancelled($this->account));

        return $this->account;
    }
}
