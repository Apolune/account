<?php

namespace Apolune\Account\Jobs\Registration;

use App\Jobs\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Apolune\Contracts\Account\Account;
use Apolune\Account\Events\Registration\Edited;

class Edit extends Job
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
     * @return \Apolune\Contracts\Account\Account|null
     */
    public function handle(Request $request)
    {
        $this->account->registration->request_date         = Carbon::now();
        $this->account->registration->request_firstname    = $request->get('firstname');
        $this->account->registration->request_surname      = $request->get('surname');
        $this->account->registration->request_country      = $request->get('country');

        $this->account->registration->save();

        event(new Edited($this->account));

        return $this->account;
    }
}
