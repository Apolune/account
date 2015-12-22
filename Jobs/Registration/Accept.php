<?php

namespace Apolune\Account\Jobs\Registration;

use App\Jobs\Job;
use Apolune\Contracts\Account\Account;
use Apolune\Account\Events\Registration\Accepted;

class Accept extends Job
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
        $this->account->load('registration');

        $firstname  = $this->account->registration->requestFirstname();
        $surname    = $this->account->registration->requestSurname();
        $country    = $this->account->registration->requestCountryCode();

        $this->account->registration->firstname         = $firstname;
        $this->account->registration->surname           = $surname;
        $this->account->registration->country           = $country;
        $this->account->registration->request_date      = null;
        $this->account->registration->request_firstname = null;
        $this->account->registration->request_surname   = null;
        $this->account->registration->request_country   = null;

        $this->account->registration->save();

        event(new Accepted($this->account));

        return $this->account;
    }
}
