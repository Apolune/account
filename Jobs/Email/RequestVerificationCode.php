<?php

namespace Apolune\Account\Jobs\Email;

use App\Jobs\Job;
use Apolune\Contracts\Account\Account;
use Illuminate\Contracts\Bus\SelfHandling;
use Apolune\Account\Events\Email\VerificationCodeRequested;

class RequestVerificationCode extends Job implements SelfHandling
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
        $this->account->load('properties');

        if ($this->account->properties->emailRequests() >= 2) {
            return null;
        }

        $this->account->properties->email_requests += 1;
        $this->account->properties->save();

        event(new VerificationCodeRequested($this->account));

        return $this->account;
    }
}
