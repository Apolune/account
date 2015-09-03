<?php

namespace Apolune\Account\Jobs\Email;

use App\Jobs\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Apolune\Contracts\Account\Account;
use Illuminate\Contracts\Bus\SelfHandling;
use Apolune\Account\Events\Email\ChangeRequested;

class ChangeRequest extends Job implements SelfHandling
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
        $this->account->load('properties');

        $this->account->properties->email = $request->get('email');
        $this->account->properties->email_date = Carbon::now();
        $this->account->properties->save();

        event(new ChangeRequested($this->account));

        return $this->account;
    }
}
